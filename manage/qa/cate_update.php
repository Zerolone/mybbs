<?php
/**
 * QA分类添加、修改
 * 
 * @author Zerolone
 * @version 2009-12-4 14:49:19
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';
$refresh_txt	= '失败';

$mode					=	Request('mode');					//提交方式， add为添加， edit为修改
$id						= Request('id',0);					//编号
$title				= Request('title');					//标题
$pagenum			=	Request('pagenum', 1);		//接受pagenum
$order				= Request('order');					//顺序
$refresh_url  = 'cate.php?pagenum='.$pagenum;//跳转链接

//---------------标题----顺序
$ArrField=array('title','order');
$ArrValue=array($title,	$order);

if($mode=='add'){
	if($MyDatabase->Insert('qa_cate', $ArrField, $ArrValue)){
		$refresh_msg	= 'QA分类：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';
		$refresh_txt	= '成功';
		
		$page_name	= '../../include/refreshno.php';
	}else{
		$refresh_msg	= 'QA分类：[<font color=red>'.$title.'</font>]，添加失败，点击返回。';

		$page_name	= '../../include/refreshback.php';
	}
	
	//管理员日志
	$log_content			= 'QA分类 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('qa_cate', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= 'QA分类：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，点击返回。';
	$log_content			= 'QA分类 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
//删除广告
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('qa_cate', '`id`='.$_POST["del"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '删除QA分类[<font color=red>'.$refresh_txt.'</font>]，返回QA分类显示页面。';
	$log_content			= 'QA分类 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)	{
		if($MyDatabase->Update('qa_cate', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= 'QA分类顺序：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= 'QA分类顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>