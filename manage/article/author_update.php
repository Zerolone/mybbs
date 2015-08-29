<?php
/**
 * Author, From添加、修改
 * 
 * @author Zerolone
 * @version 2009-12-8 15:33:48
 */

require ('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt	= '失败';

$mode			= Request('mode');			//提交方式， add为添加， edit为修改
$id				= Request('id',0);			//编号
$name			= Request('name');			//标题
$order		= Request('order', 1);	//顺序
$kind			= Request('kind', 1);			//kind
$pagenum	= Request('pagenum',1);	//pagenum

$refresh_url	= 'author.php?kind='.$kind.'&pagenum='.$pagenum;	

//---------------标题----顺序
$ArrField=array('name', 'order');
$ArrValue=array($name,	$order);

if($mode=='add'){
	if($MyDatabase->Insert('article_'.$kind, $ArrField, $ArrValue)){
		$refresh_msg	= '[<font color=red>'.$kind.'</font>]，添加成功，点击关闭。';
		$refresh_txt	= '成功';
		
		$page_name	= '../../include/refreshno.php';		
	}else {
		$refresh_msg	= '[<font color=red>'.$kind.'</font>]，添加失败，点击返回。';

		$page_name	= '../../include/refreshback.php';
	}
	//管理员日志
	$log_content			= '添加 &gt;&gt; 【'. $kind .'】'.$refresh_txt;			
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('article_'.$kind, $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '[<font color=red>'.$kind.'</font>]，修改'.$refresh_txt.'，点击返回。';
	$log_content			= '修改 &gt;&gt; 【'. $kind .'】'.$refresh_txt;	
}
//如果是删除的话
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('article_'.$kind, '`id`='.$_POST["del"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '[<font color=red>'.$refresh_txt.'</font>]，返回列表显示页面。';
	$log_content			= '删除 &gt;&gt; '.$refresh_txt;
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>