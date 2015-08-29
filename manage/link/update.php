<?php
/**
 * 友情链接添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-11-30 21:57:34
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';
$refresh_txt	= '失败';

$mode			= Request('mode');			//提交方式， add为添加， edit为修改
$id				= Request('id',0);			//编号
$title		= Request('title');			//标题
$order		= Request('order');			//顺序
$pic			= Request('pic');				//图片
$url			= Request('url');				//url
$pagenum	= Request('pagenum',1);	//pagenum

//跳转url
$refresh_url  = 'link.php?pagenum='.$pagenum;

//---------------标题----地址--图片--顺序
$ArrField=array('title','url','pic','order');
$ArrValue=array($title,	$url, $pic, $order);

if($mode=='add'){
	if($MyDatabase->Insert('link', $ArrField, $ArrValue)){
		$refresh_msg	= '友情链接：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';
		$refresh_txt	= '成功';
		
		$page_name	= '../../include/refreshno.php';
	}else{
		$refresh_msg	= '友情链接：[<font color=red>'.$title.'</font>]，添加失败，点击返回。';

		$page_name	= '../../include/refreshback.php';
	}
	
	//管理员日志
	$log_content			= '友情链接 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('link', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '友情链接：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，点击返回。';
	$log_content			= '友情链接 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
}
//删除友情链接
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('link', '`id`='.$_POST["del"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '删除友情链接[<font color=red>'.$refresh_txt.'</font>]，返回友情链接显示页面。';
	$log_content			= '友情链接 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)	{
		if($MyDatabase->Update('link', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '友情链接顺序：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '友情链接顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>