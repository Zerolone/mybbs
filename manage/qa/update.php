<?php
/**
 * QA添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-12-4 14:15:29
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';
$refresh_txt	= '失败';

$mode			= Request('mode');			//提交方式， add为添加， edit为修改
$id				= Request('id',0);			//编号
$title		= Request('title');			//标题
$active		= Request('active',1);	//active
$order		= Request('order');			//顺序
$pagenum	= Request('pagenum',1);	//pagenum
$content	= Request('content'); 	//
$cateid		= Request('cateid'); 		//

//跳转url
$refresh_url  = 'qa.php?pagenum='.$pagenum;

//---------------标题----启用-----顺序-------内容
$ArrField=array('title','active','order', 'content', 'cateid');
$ArrValue=array($title,	$active, $order,  $content, $cateid);

if($mode=='add'){
	if($MyDatabase->Insert('qa', $ArrField, $ArrValue)){
		$refresh_txt	= '成功';
	}
	
	$refresh_msg	= 'QA：[<font color=red>'.$title.'</font>]，添加'.$refresh_txt.'，点击关闭。';
	$log_content			= 'QA &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('qa', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= 'QA：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，点击返回。';
	$log_content			= 'QA &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
//删除广告
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('qa', '`id`='.$_POST["del"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '删除QA[<font color=red>'.$refresh_txt.'</font>]，返回QA显示页面。';
	$log_content			= 'QA &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)	{
		if($MyDatabase->Update('qa', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= 'QA顺序：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= 'QA顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>