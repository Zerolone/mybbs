<?php
/**
 * 课程添加、修改
 * 
 * @author Zerolone
 * @version 2009-12-7 17:25:41
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
$cycle		= Request('cycle');				//学习周期
$soft			= Request('soft');				//学习软件
$pic1			= Request('pic1');				//对应图片1-3
$pic2			= Request('pic2');				//
$pic3			= Request('pic3');				//
$teacher	= Request('teacher');			//主讲老师
$study		= Request('study');				//学习目标
$intro		= Request('intro');				//课程介绍
$object		= Request('object');			//招生对象
$works1		= Request('works1');			//讲师作品1-2
$works2		= Request('works2');			//
$works1s	= Request('works1s');			//讲师作品s1-2
$works2s	= Request('works2s');			//
$articleid= Request('articleid');		//

$refresh_url  = 'class.php?pagenum='.$pagenum;

$ArrField=array('title','order','cycle','soft','pic1','pic2','pic3','teacher','study','intro','object','works1','works2','works1s','works2s', 'articleid');
$ArrValue=array($title,	$order, $cycle, $soft, $pic1, $pic2, $pic3, $teacher, $study, $intro, $object, $works1, $works2, $works1s, $works2s, $articleid);

//2009-12-7 17:31:29

if($mode=='add'){
	if($MyDatabase->Insert('class', $ArrField, $ArrValue)){
		$refresh_txt = '成功';
		$page_name	= '../../include/refreshno.php';
	}else{
		$page_name	= '../../include/refreshback.php';
	}

	$refresh_msg	= '课程：[<font color=red>'.$title.'</font>]，添加'.$refresh_txt;
	$log_content			= '课程 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}

//修改
elseif ($mode=='edit'){
	if($MyDatabase->Update('class', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt	= '成功';
	}	
	
	$refresh_msg	= '课程：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，跳转到列表页面。';
	$log_content			= '课程 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;
}
//删除
elseif (isset($_POST['s_list_del'])){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('class', '`id`='.$_POST["del"][$i])){
			$refresh_txt	= '成功';
		}else {
			$refresh_txt	= '失败';
		}
	}
	$refresh_msg	= '删除课程[<font color=red>'.$refresh_txt.'</font>]，返回列表页面。';
	$log_content			= '课程 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if($MyDatabase->Update('class', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt	= '成功';
		}else {
			$refresh_txt	= '失败';
		}
	}
	$refresh_msg	= '修改课程列表顺序[<font color=red>'.$refresh_txt.'</font>]，返回课程列表显示页面。';	
	
	//管理员日志
	$log_content			= '课程列表 &gt;&gt; 批量修改顺序 &gt;&gt; '.$refresh_txt;
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>