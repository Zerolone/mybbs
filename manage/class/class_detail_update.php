<?php
/**
 * 课程模块添加、修改
 * 
 * @author Zerolone
 * @version 2009-12-8 10:18:28
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt	= '失败';

$pagenum	=	Request('pagenum', 1);	//接受pagenum
$mode			=	Request('mode');				//提交方式， add为添加， edit为修改

$id				= Request('id' , 1);			//编号
$title		= Request('title');				//标题
$order		= Request('order', 1);		//顺序
$cycle		= Request('cycle');				//课时
$parentid	= Request('parentid');		//上级
$pic			= Request('pic');					//课程描述
$content	= Request('content');			//课程内容
$homework	= Request('homework');		//课下作业

$refresh_url  = 'class_detail.php?pagenum='.$pagenum.'&parentid='.$parentid;

$ArrField=array('title','order','cycle','parentid','pic','content','homework');
$ArrValue=array($title,	$order, $cycle, $parentid, $pic, $content, $homework);


if($mode=='add'){
	if($MyDatabase->Insert('class_detail', $ArrField, $ArrValue)){
		$refresh_txt = '成功';
	}else{
		$page_name	= '../../include/refreshback.php';
	}

	$refresh_msg	= '课程模块：[<font color=red>'.$title.'</font>]，添加'.$refresh_txt;
	$log_content			= '课程模块 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}

//修改
elseif ($mode=='edit'){
	if($MyDatabase->Update('class_detail', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt	= '成功';
	}	
	
	$refresh_msg	= '课程模块：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，跳转到列表页面。';
	$log_content			= '课程模块 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;
}
//删除
elseif (isset($_POST['s_list_del'])){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('class_detail', '`id`='.$_POST["del"][$i])){
			$refresh_txt	= '成功';
		}else {
			$refresh_txt	= '失败';
		}
	}
	$refresh_msg	= '删除课程模块[<font color=red>'.$refresh_txt.'</font>]，返回列表页面。';
	$log_content			= '课程模块 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if($MyDatabase->Update('class_detail', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt	= '成功';
		}else {
			$refresh_txt	= '失败';
		}
	}
	$refresh_msg	= '修改课程模块列表顺序[<font color=red>'.$refresh_txt.'</font>]，返回课程模块列表显示页面。';	
	
	//管理员日志
	$log_content			= '课程模块列表 &gt;&gt; 批量修改顺序 &gt;&gt; '.$refresh_txt;
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>