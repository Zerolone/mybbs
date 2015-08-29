<?php
require('common.php');
$page_name	= 'refresh.php';
$refresh_msg	= '置顶列表[<font color=blue>不成功</font>]，返回置顶列表显示页面。';

//接受pagenum
$pagenum=1;
if (isset($_POST['pagenum']))
{
	$pagenum=$_POST['pagenum'];
}

if( isset($_POST['s_list_del']) )
{
	for($i = 0;$i<sizeof( $_POST["del"] );$i++)
	{
		$SqlStr = 'DELETE FROM `'. table_pre .'new` WHERE `id`='. $_POST["del"][$i];
		query($SqlStr);
	}
	$refresh_msg	= '删除置顶列表[<font color=red>成功</font>]，返回置顶列表显示页面。';
}

if( isset($_POST['s_list_order']) )
{
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)
	{
		$SqlStr = 'UPDATE `'. table_pre .'new` SET `order`= '.$_POST["order"][$i].' WHERE `id`='. $_POST["id"][$i];
		query($SqlStr);
	}
	$refresh_msg	= '修改置顶列表[<font color=red>成功</font>]，返回置顶列表显示页面。';
}


$refresh_url	= 'article_top.php?pagenum='.$pagenum;

require($page_name.'.php');
require('../include/debug.inc.php');
?>