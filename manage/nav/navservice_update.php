<?php
/**
 * 可提供服务|编辑添加、修改
 * 
 * @version 2009-3-2 22:29:56
*/

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';

$mode		=	Request('mode');		//提交方式，add为添加，edit为修改
$id			= Request('id',0);		//编号
$pid		= Request('pid',0);		//上级编号
$order	= Request('order',1);	//顺序
$title	= Request('title');		//标题
$url		= Request('url');			//地址
$active	= Request('active',0);//

$refresh_url	= 'navservice.php?pid='.$pid;

$ArrField=array('order','title','url','pid','active');
$ArrValue=array($order,	$title,	$url,	$pid,	$active);

if($mode=='add'){
	$MyDatabase->Insert('navservice',$ArrField,$ArrValue);

	$refresh_msg	= $title.'，添加成功，返回可提供服务列表页面。';

	//管理员日志
	$log_content			= '可提供服务'.$title.' &gt;&gt; 添加 &gt;&gt; 成功';

}
elseif ($mode=='edit')
{
	$MyDatabase->Update('navservice',$ArrField,$ArrValue,'`id`=' . $id);

	$refresh_msg	= $title.'，修改成功，返回可提供服务列表页面。';

	//管理员日志
	$log_content			= '可提供服务'.$title.' &gt;&gt; 修改 &gt;&gt; 成功';
}
elseif (isset($_POST['s_list_del']))
{
	for($i = 0;$i<sizeof( $_POST["del"] );$i++)
	{
		$MyDatabase->Delete('navservice','`id`='. $_POST["del"][$i]);
	}
	$refresh_msg	= '批量删除可提供服务[<font color=red>成功</font>]，返回可提供服务列表页面。';
	
	//管理员日志
	$log_content			= '批量删除可提供服务 &gt;&gt; 成功';
}
elseif (isset($_POST['s_list_order']))
{
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)
	{
		$MyDatabase->Update('	',array('order'),array($_POST["order"][$i]),'`id`='. $_POST["id"][$i]);
	}
	$refresh_msg	= '批量修改可提供服务顺序[<font color=red>成功</font>]，返回可提供服务列表显示页面。';

	//管理员日志
	$log_content			= '可提供服务'.$title.' &gt;&gt; 修改 &gt;&gt; 成功';
}

require($page_name.'.php');

require('../../include/debug.php');

//管理员日志
require('../../include/log.php');
?>