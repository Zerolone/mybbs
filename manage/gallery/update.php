<?php
/**
 * 添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-8-20 15:05:19
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';

$mode			= Request('mode');			//提交方式， add为添加， edit为修改
$id				= Request('id',0);			//编号
$title		= Request('title');			//标题
$parentid	= Request('parentid',1);//上级id
$hits			= Request('hits',0);		//hits
$width		= Request('width',0);		//width
$height		= Request('height',0);	//height
$active		= Request('active',1);	//active
$order		= Request('order');			//顺序
$url			= Request('url');				//url
$color		= Request('color');			//color
$content	= Request('content');		//内容
$pagenum	= Request('pagenum',1);	//pagenum

//跳转url
$refresh_url  = 'gallery.php?pagenum='.$pagenum.'&parentid='.$parentid;

//---------------标题----上级-------点击---宽度----高度-----启用-----地址--颜色----内容------顺序
$ArrField=array('title','parentid','hits','width','height','active','url','color','content','order');
$ArrValue=array($title,	$parentid, $hits, $width, $height, $active, $url, $color, $content, $order);

if($mode=='add'){
	if($MyDatabase->Insert('gallery', $ArrField, $ArrValue)){
		$refresh_msg	= '相册：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';

		//管理员日志
		$log_content			= '相册 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】成功';	
	}else{
		$refresh_msg	= '相册：[<font color=red>'.$title.'</font>]，添加失败，点击关闭。';

		//管理员日志
		$log_content			= '相册 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】失败';	
	}
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('gallery', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_msg	= '相册：[<font color=red>'.$title.'</font>]，修改成功，点击关闭。';

		//管理员日志
		$log_content			= '相册 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';	
	}else{
		$refresh_msg	= '相册：[<font color=red>'.$title.'</font>]，添加失败，点击关闭。';

		//管理员日志
		$log_content			= '相册 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';	
	}
}
//删除相册
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('gallery', '`id`='.$_POST["del"][$i])){			
			$refresh_msg	= '删除相册[<font color=red>成功</font>]，返回相册显示页面。';
		
			//管理员日志
			$log_content			= '相册 &gt;&gt; 删除 &gt;&gt; 成功';
		}else {
			$refresh_msg	= '删除相册[<font color=red>失败</font>]，返回相册显示页面。';
		
			//管理员日志
			$log_content			= '相册 &gt;&gt; 删除 &gt;&gt; 失败';
		}
	}
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)	{
		if($MyDatabase->Update('gallery', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_msg	= '相册顺序：[<font color=red>'.$title.'</font>]，修改成功，点击关闭。';
	
			//管理员日志
			$log_content			= '相册顺序 &gt;&gt; 修改 &gt;&gt; 成功';	
		}else{
			$refresh_msg	= '相册顺序：[<font color=red>'.$title.'</font>]，添加失败，点击关闭。';
	
			//管理员日志
			$log_content			= '相册顺序 &gt;&gt; 修改 &gt;&gt; 失败';	
		}		
	}
}

require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>