<?php
/**
 * 管理组|编辑添加、修改
 * 
 * @version 2009-12-2 11:24:44
 * @author Zerolone
*/

require('../include/common.php');

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';

$page_name	= '../../include/refresh.php';

$refresh_url	= 'group.php';
$refresh_txt	= '失败';

$mode		=	Request('mode');		//提交方式， add为添加， edit为修改
$id			= Request('id',0);		//编号
$title	= Request('title');		//标题
$order	= Request('order',1);	//顺序

//权限
$permission=0;
if(isset($_POST['permission'])){
	for($i = 0;$i<sizeof( $_POST['permission'] );$i++){
		$permission+= $_POST["permission"][$i];
	}
}

$ArrField=array('title','order','permission');
$ArrValue=array($title,$order,$permission);

//添加
if ($mode == 'add') {
	if ($MyDatabase->Insert ( 'admin_group', $ArrField, $ArrValue )){
		$refresh_txt='成功';	
	}
	
	$refresh_msg = '管理员组：[<font color=red>' . $title . '</font>]，添加'.$refresh_txt.'，点击关闭。';	
	$log_content = '管理员组 &gt;&gt; 添加 &gt;&gt; 【' . $title . '】'.$refresh_txt;
	$page_name = '../include/refreshno.php';
} 
//修改
elseif ($mode == 'edit') {
	if($MyDatabase->Update ( 'admin_group', $ArrField, $ArrValue, '`id`=' . $id )){	
		$refresh_txt='成功';
	}
	
	$refresh_msg = '管理员组：[<font color=red>' . $title . '</font>]，修改'.$refresh_txt;
	$log_content = '管理员组 &gt;&gt; 修改 &gt;&gt; 【' . $title . '】'.$refresh_txt;
}
//删除
elseif (isset ( $_POST ['s_list_del'] )) {
	for($i = 0; $i < sizeof ( $_POST ["del"] ); $i ++) {
		$MyDatabase->Delete ( 'admin_group', '`id`=' . $_POST ["del"] [$i] );
	}
	$refresh_msg = '管理员组[<font color=red>成功</font>]，返回管理员组显示页面。';
	
	//管理员日志
	$log_content = '管理员组 &gt;&gt; 删除 &gt;&gt; 成功';	
}

require($page_name.'.php');

require('../../include/debug.php');
require('../../include/log.php');
?>