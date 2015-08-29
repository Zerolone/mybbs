<?php
/**
 * 用户操作
 * 
 * @version 2010-3-25 21:18:49
 * @author Zerolone
*/

require('../include/common.php');

$page_name	= '../../include/refresh.php';
$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt	= '失败';
$pagenum=Request('pagenum',1);
$gid			= Request('gid');
$username	= Request('username');

$refresh_url	= 'user.php?pagenum='.$pagenum;
if($gid){
	$refresh_url.= '&gid='.$gid;
}

if($username){
	$refresh_url.= '&username='.$username;
}

$mode			=	Request('mode');		//提交方式， add为添加， edit为修改
$uid			=	Request('uid',0);		//用户编号
$password	= Request('password');		//密码
$groupid	= Request('groupid');
$email		= Request('email');
$rvrc			= Request('rvrc');
$money		= Request('money');

if($mode == 'edit') {
	$ArrField	= array('password',			'groupid','email');
	$ArrValue	=	array(md5($password),	$groupid,	$email);	
	if ($password==''){
		$ArrField	= array('groupid','email');
		$ArrValue	=	array($groupid,	$email);	
	}
	
	//修改users
	if ($MyDatabase->Update('users',$ArrField,$ArrValue,'`uid`=' . $uid)){
		$refresh_txt	= '成功';
	}

	//修改user_ext
	$ArrField	= array('rvrc','money');
	$ArrValue	=	array($rvrc, $money);	
	if ($MyDatabase->Update('user_ext',$ArrField,$ArrValue,'`uid`=' . $uid)){
		$refresh_txt	= '成功';
	}

	$refresh_msg = '用户修改'.$refresh_txt.'，点击返回。';	
	$log_content = '用户修改 &gt;&gt; 修改 '.$refresh_txt;

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
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		$uid=$_POST["del"][$i];

		//用户表
		$MyDatabase->Delete('users',			'`uid`='. $uid);
		//用户表-扩展
		$MyDatabase->Delete('users_ext',	'`uid`='. $uid);
		//删除用户发贴
		$MyDatabase->Delete('topics',			'`authorid`='. $uid);		
		//删除用户发帖-扩展
		$MyDatabase->Delete('topics_ext',	'`authorid`='. $uid);
		//删除用户回帖
		$MyDatabase->Delete('posts',			'`authorid`='. $uid);
	}



	$refresh_msg	= '删除用户各个数据[<font color=red>成功</font>]，请更新论坛信息，返回用户显示页面。';

	//管理员日志
	$log_content			= '用户 &gt;&gt; 删除 &gt;&gt; 成功';
}

//更新用户组
elseif( isset($_POST['s_usergroup']) ){
	for($i = 0;$i<sizeof( $_POST["groupid"] );$i++){
		if($MyDatabase->Update('users',array('groupid'),array($_POST["groupid"][$i]),'`uid`='. $_POST["uid"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '用户所属组修改：[<font color=red>'.$refresh_txt.'</font>]，点击返回。';
	$log_content	= '用户所属组 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}

require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>