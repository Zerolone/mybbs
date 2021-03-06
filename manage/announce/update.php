<?php
/**
 * 公告添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-11-30 21:57:34
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';
$refresh_txt	= '失败';

$mode			= Request('mode');				//提交方式， add为添加， edit为修改
$id				= Request('id',0);				//编号
$title		= Request('title');				//标题
$level		= Request('level',0);
$order		= Request('order');				//顺序
$pagenum	= Request('pagenum',1);		//pagenum
$content	= Request('content', 0); 	//

//跳转url
$refresh_url  = 'announce.php?pagenum='.$pagenum;

//---------------标题----所属栏目-顺序------内容----------
$ArrField=array('title','level',	'order', 'content', 'startdate');
$ArrValue=array($title,	$level, 	$order,  $content, TIMESTAMP);

if($mode=='add'){
	if($MyDatabase->Insert('announce', $ArrField, $ArrValue)){
		$refresh_msg	= '公告：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';
		$refresh_txt	= '成功';
		
		$page_name	= '../../include/refreshno.php';
	}else{
		$refresh_msg	= '公告：[<font color=red>'.$title.'</font>]，添加失败，点击返回。';

		$page_name	= '../../include/refreshback.php';
	}
	
	//管理员日志
	$log_content			= '公告 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('announce', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '公告：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，点击返回。';
	$log_content			= '公告 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
//删除公告
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('announce', '`id`='.$_POST["del"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '删除公告[<font color=red>'.$refresh_txt.'</font>]，返回公告显示页面。';
	$log_content			= '公告 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)	{
		if($MyDatabase->Update('announce', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '公告顺序：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '公告顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//修改所属栏目
elseif( isset($_POST['s_list_level']) ){
	for($i = 0;$i<sizeof( $_POST["level"] );$i++)	{
		if($MyDatabase->Update('announce', array('level'), array($_POST["level"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '公告所属栏目：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '公告所属栏目 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>