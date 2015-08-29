<?php
/**
 * 留言簿添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-12-4 21:28:39
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';
$refresh_txt	= '失败';

$mode			= Request('mode');			//提交方式， add为添加， edit为修改
$id				= Request('id',0);			//编号
$name			= Request('name');			//标题
$active		= Request('active',1);	//active
$order		= Request('order', 1);			//顺序
$pagenum	= Request('pagenum',1);	//pagenum
$content	= Request('content'); 	//内容
$recontent= Request('recontent'); //回复
$homepage	= Request('homepage'); 	//主页
$mail			= Request('mail'); 			//邮箱

//跳转url
$refresh_url  = 'guestbook.php?pagenum='.$pagenum;

//---------------标题----启用-----顺序-------内容
$ArrField=array('name','active','order', 'content', 'recontent', 'homepage', 'mail');
$ArrValue=array($name,	$active, $order,  $content, $recontent,	$homepage, $mail);

if ($mode=='edit'){
	if($MyDatabase->Update('guestbook', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '留言簿修改'.$refresh_txt.'，点击返回。';
	$log_content			= '留言簿 &gt;&gt; 修改 &gt;&gt;'.$refresh_txt;	
}
//删除
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('guestbook', '`id`='.$_POST["del"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '删除留言簿[<font color=red>'.$refresh_txt.'</font>]，返回留言簿显示页面。';
	$log_content			= '留言簿 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>