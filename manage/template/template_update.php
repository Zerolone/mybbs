<?php
/**
 * 模板添加、修改
 * 
 * @author Zerolone
 * @version 2009-8-14 15:18:10
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';

$mode		= Request('mode','add');//提交方式， add为添加， edit为修改,del为删除
$id			= Request('id',0);			//模板编号
$title	= Request('title');			//标题
$order	= Request('order');			//顺序
$html		= Request('html');			//html
$js			= Request('js');				//js
$css		= Request('css');				//css
$pagenum= Request('pagenum',1);	//接受pagenum

$refresh_url	= 'template.php?pagenum='.$pagenum;

$ArrField=array('title','order','html','css','js');
$ArrValue=array($title,	$order, $html, $css, $js);

if($mode=='add'){
	if($MyDatabase->Insert('article_template', $ArrField, $ArrValue)){
		$refresh_msg	= '模板：[<font color=red>'.$title.'</font>]，添加成功。';
	
		//管理员日志
		$log_content			= '模板 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】成功';
	}else{
		$refresh_msg	= '模板：[<font color=red>'.$title.'</font>]，添加失败。';
	
		//管理员日志
		$log_content			= '模板 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】失败';
	}	
	$page_name	= '../include/refreshno.php';
	
}elseif ($mode=='edit'){
	if($MyDatabase->Update('article_template', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_msg	= '模板：[<font color=red>'.$title.'</font>]，修改成功，返回列表页面。';
	
		//管理员日志
		$log_content			= '模板 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';
	}else{
		$refresh_msg	= '模板：[<font color=red>'.$title.'</font>]，修改失败，返回列表页面。';
	
		//管理员日志
		$log_content			= '模板 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';
	}
}
//如果是删除的话
elseif ($mode=='del'){
	if( isset($_POST['s_list_del']) ){
		for($i = 0;$i<sizeof( $_POST["del"] );$i++){
			
			
			$SqlStr = 'DELETE FROM `'. table_pre .'article_template` WHERE `id`='. $_POST["del"][$i];
			query($SqlStr);
		}
		$refresh_msg	= '删除模板[<font color=red>成功</font>]，返回列表页面。';

	//管理员日志
	$log_content			= '模板 &gt;&gt; 删除 &gt;&gt; 成功';		
	}
}

//管理员日志
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>