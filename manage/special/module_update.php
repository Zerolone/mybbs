<?php
/**
 * 模块添加、修改
 * 
 * @author 			Zerolone
 * @version 			2009-8-17 17:18:21
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';

$mode							=	Request('mode');				//提交方式， add为添加， edit为修改
$id								= Request('id',0);				//编号
$title						= Request('title');				//标题
$kind							= Request('kind');				//kind
$parentid					= Request('parentid',1);	//上级id

$kind1_count			= Request('kind1_count');	//kind1_
$kind1_perline		= Request('kind1_perline',0);
$kind1_cateid			= '';

if (isset($_POST['kind1_cateid'])){
	for($i = 0;$i<sizeof( $_POST["kind1_cateid"] );$i++){
		if ($i==0) {
			$kind1_cateid			= $_POST['kind1_cateid'][0];
		}else{
			$kind1_cateid			.= ','. $_POST['kind1_cateid'][$i];			
		}
	}
}

$kind1_txt				= Request('kind1_txt');
$kind1_orderby		= Request('kind1_orderby');		//排序
$kind1_ordersort	=	Request('kind1_ordersort');	//排序方式

$kind2_url				=	Request('kind2_url');//kind2_

$kind3_id			= Request('kind3_id');//kind3_
$kind4_id			= Request('kind4_id');//kind4_
$kind5_id			= Request('kind5_id');//kind5_
$kind6_id			= Request('kind6_id');//kind6_

$pagenum			=	Request('pagenum',1);	//接受pagenum
$order				= Request('order');			//顺序
$pic					=	Request('pic');				//图片
$url					= Request('url');//对应地址

//跳转url
$refresh_url  = 'module.php?pagenum='.$pagenum.'&parentid='.$parentid;

//---------------标题----kind--上级--------图片-地址--kind1_记录数--每行显示条数----字数--------栏目编号--------排序字段--------排序方式---------kind2_地址--kind3_文章编号-kind4_投票编号--kind5_留言编号--kind6_轮显编号---顺序
$ArrField=array('title','kind','parentid','pic','url','kind1_count','kind1_perline','kind1_txt','kind1_cateid','kind1_orderby','kind1_ordersort','kind2_url','kind3_id',		'kind4_id',			'kind5_id',			'kind6_id',			'order');
$ArrValue=array($title, $kind, $parentid, $pic, $url, $kind1_count, $kind1_perline, $kind1_txt, $kind1_cateid, $kind1_orderby, $kind1_ordersort, $kind2_url, $kind3_id,			$kind4_id,			$kind5_id,			$kind6_id,			$order);

if($mode=='add'){
	if($MyDatabase->Insert('special_module',$ArrField,$ArrValue)){
		$refresh_msg	= '模块：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';
	
		//管理员日志
		$log_content			= '模块 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】成功';		
	}else{
		$refresh_msg	= '模块：[<font color=red>'.$title.'</font>]，添加失败，点击关闭。';
	
		//管理员日志
		$log_content			= '模块 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】失败';		
	}
}elseif ($mode=='edit'){
	if($MyDatabase->Update('special_module',$ArrField,$ArrValue, '`id`='.$id)){
		$refresh_msg	= '模块：[<font color=red>'.$title.'</font>]，修改成功，点击返回。';
	
		//管理员日志
		$log_content			= '模块 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';		
	}else{
		$refresh_msg	= '模块：[<font color=red>'.$title.'</font>]，修改失败，点击返回。';
			
		//管理员日志
		$log_content			= '模块 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';		
	}
}
//删除模块
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++)	{
		if ($MyDatabase->Delete('special_module', '`id`='.$_POST["del"][$i])){
			$refresh_msg	= '删除模块[<font color=red>成功</font>]，返回专题显示页面。';
		
			//管理员日志
			$log_content			= '模块 &gt;&gt; 删除 &gt;&gt; 成功';			
		}else{
			$refresh_msg	= '删除模块[<font color=red>失败</font>]，返回专题显示页面。';
		
			//管理员日志
			$log_content			= '模块 &gt;&gt; 删除 &gt;&gt; 失败';			
		}
	}
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if($MyDatabase->Update('special_module', array('order'),array($_POST["order"][$i]),'`id`='. $_POST["id"][$i])){
			$refresh_msg	= '修改模块列表顺序[<font color=red>成功</font>]，返回专题列表显示页面。';	
			
			//管理员日志
			$log_content			= '模块列表 &gt;&gt; 批量修改顺序 &gt;&gt; 成功';			
		}else{
			$refresh_msg	= '修改模块列表顺序[<font color=red>失败</font>]，返回专题列表显示页面。';	
			
			//管理员日志
			$log_content			= '模块列表 &gt;&gt; 批量修改顺序 &gt;&gt; 失败';			
		}
	}
}


require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>