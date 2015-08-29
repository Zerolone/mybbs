<?php
/**
 * 管理员|编辑添加、修改
 * 
 * @version 2009-12-2 11:43:13
 * @author Zerolone
*/

require('../include/common.php');

$page_name	= '../../include/refresh.php';
$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_url	= 'admin.php';

$mode			=	Request('mode');		//提交方式， add为添加， edit为修改
$id				=	Request('id',0);		//用户编号
$user			= Request('user');		//用户
$pass			= Request('pass');		//密码
$groupid	= Request('groupid');	//权限
$order		=	Request('order',1);	//顺序

$ArrField	= array('user',	'pass',	'groupid','order');
$ArrValue	=	array($user,	md5($pass),	$groupid,	$order);
if($mode=='add'){
	//判断用户名是否存在
	$SqlStr	= 'Select `user` From `' .DB_TABLE_PRE. 'admin` WHERE `user`=\''.$user . '\' limit 1';
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->Query ()) {
		$refresh_msg	= '用户：[<font color=red>'.$user.'</font>]，存在，返回添加页面。';

		//管理员日志
		$log_content			= '用户 &gt;&gt; 【'. $user .'】存在';

		$page_name='../include/refreshback.php';
	} else {
		$MyDatabase->Insert('admin',$ArrField,$ArrValue);

		$refresh_msg	= '用户：[<font color=red>'.$user.'</font>]，添加成功。';
		
		//管理员日志
		$log_content			= '用户 &gt;&gt; 添加 &gt;&gt; 【'. $user .'】成功';
	}
}elseif($mode == 'edit') {
	$ArrField	= array('pass',	'groupid','order');
	$ArrValue	=	array(md5($pass),	$groupid,	$order);	
	if ($pass==''){
		$ArrField	= array('groupid','order');
		$ArrValue	=	array($groupid,	$order);			
	}
	
	if ($MyDatabase->Update('admin',$ArrField,$ArrValue,'`id`=' . $id)){
		$refresh_msg	= '用户：[<font color=red>'.$user.'</font>]，修改成功。';
		
		$log_content			= '用户 &gt;&gt; 修改 &gt;&gt; 【'. $user .'】成功';		
	}else{
		$refresh_msg	= '用户：[<font color=red>'.$user.'</font>]，修改不成功，返回修改页面。';

		$log_content			= '用户 &gt;&gt; 修改 &gt;&gt; 【'. $user .'】不成功';
		
		$page_name='../include/refreshback.php';
	}
}elseif($mode == 'editone') {
	$ArrField	= array('title1',	'title2','title3','copyright');
	$ArrValue	= array(Request('title1'),	Request('title2'),Request('title3'),Request('copyright'));
		
	if ($MyDatabase->Update('admin',$ArrField,$ArrValue,'`id`=' . $userid)){
		$refresh_msg	= '用户：[<font color=red>'.$userid.'</font>]，修改成功。';
		
		$log_content			= '用户 &gt;&gt; 修改 &gt;&gt; 【'. $userid .'】成功';
	}else{
		$refresh_msg	= '用户：[<font color=red>'.$user.'</font>]，修改不成功，返回修改页面。';

		$log_content			= '用户 &gt;&gt; 修改 &gt;&gt; 【'. $userid .'】不成功';
		
		$refresh_url	= 'admininfo.php';
		$page_name='../include/refreshback.php';
	}
}
elseif( isset($_POST['s_list_del']) )
{
	for($i = 0;$i<sizeof( $_POST["del"] );$i++)
	{
		$MyDatabase->Delete('admin','`id`='. $_POST["del"][$i]);
	}
	$refresh_msg	= '删除用户[<font color=red>成功</font>]，返回用户显示页面。';

	//管理员日志
	$log_content			= '用户 &gt;&gt; 删除 &gt;&gt; 成功';
}

require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>