<?php
require('common.php');
$page_name	= 'refresh.php';
$refresh_msg	= '文章[<font color=blue>不成功</font>]，返回文章显示页面。';

//接受cateid
$cateid=0;
if (isset($_POST['cateid']))
{
	$cateid=$_POST['cateid'];
}

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
		$SqlStr = 'DELETE FROM `'. table_pre .'article` WHERE `id`='. $_POST["del"][$i];
		query($SqlStr);
	}
	$refresh_msg	= '删除文章[<font color=red>成功</font>]，返回文章显示页面。';
}

if( isset($_POST['s_issue']) )
{
	for($i = 0;$i<sizeof( $_POST["issue"] );$i++)
	{
		$SqlStr = 'UPDATE `'. table_pre .'article` SET flag = 2 WHERE `id`='. $_POST["issue"][$i];
		query($SqlStr);
	}
	$refresh_msg	= '发布文章[<font color=red>成功</font>]，返回文章显示页面。';
}

$refresh_url	= 'article_unissue.php?cateid='.$cateid.'&pagenum='.$pagenum;

require($page_name.'.php');
require('../include/debug.inc.php');
?>