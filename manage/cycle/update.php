<?php
/**
 * 轮显添加、修改
 * 
 * @author Zerolone
 * @version 2009-12-2 14:44:47
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt	= '失败';

$pagenum	=	Request('pagenum', 1);	//接受pagenum
$mode			=	Request('mode');				//提交方式， add为添加， edit为修改
$id				= Request('id' , 1);			//编号
$title		= Request('title');				//标题
$title_sub= Request('title_sub');		//标题说明
$order		= Request('order', 1);		//顺序
$pic			=	Request('pic');					//图片
$url			=	Request('url');					//跳转地址

$refresh_url  = 'cycle.php?pagenum='.$pagenum;

//---------------标题----标题说明----图片--地址---顺序
$ArrField=array('title','title_sub','pic','url','order');
$ArrValue=array($title,	$title_sub, $pic, $url, $order);

if($mode=='add'){
	if($MyDatabase->Insert('cycle', $ArrField, $ArrValue)){
		$refresh_txt = '成功';
		$page_name	= '../../include/refreshno.php';
	}else{
		$page_name	= '../../include/refreshback.php';
	}

	$refresh_msg	= '轮显：[<font color=red>'.$title.'</font>]，添加'.$refresh_txt;
	$log_content			= '轮显 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}

//修改
elseif ($mode=='edit'){
	if($MyDatabase->Update('cycle', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt	= '成功';
	}	
	
	$refresh_msg	= '轮显：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，跳转到列表页面。';
	$log_content			= '轮显 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;
}
//删除
elseif (isset($_POST['s_list_del'])){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('cycle', '`id`='.$_POST["del"][$i])){
			$refresh_txt	= '成功';
		}else {
			$refresh_txt	= '失败';
		}
	}
	$refresh_msg	= '删除轮显[<font color=red>'.$refresh_txt.'</font>]，返回列表页面。';
	$log_content			= '轮显 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if($MyDatabase->Update('cycle', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt	= '成功';
		}else {
			$refresh_txt	= '失败';
		}
	}
	$refresh_msg	= '修改轮显列表顺序[<font color=red>'.$refresh_txt.'</font>]，返回轮显列表显示页面。';	
	
	//管理员日志
	$log_content			= '轮显列表 &gt;&gt; 批量修改顺序 &gt;&gt; '.$refresh_txt;
}

require($page_name.'.php');

//管理员日志
require('../../include/log.inc.php');

require('../../include/debug.inc.php');
?>