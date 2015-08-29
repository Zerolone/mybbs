<?php
/**
 * 网址添加、修改
 * 
 * @version 2009-5-6 10:12:09
*/

require('../include/common.php');

$page_name	= '../include/refresh.php';

$refresh_msg	= '[<font color=blue>操作不成功</font>]，请关闭。';

$mode		=	Request('mode');			//提交方式，add为添加，edit为修改
$id			= Request('id',0);			//编号
$order	= Request('order',1);		//顺序
$title	= Request('title');			//标题
$content= Request('content');		//说明
$cateid	= Request('cateid',0);	//栏目编号
$active	= Request('active',0);	//是否使用
$url		= Request('url');				//Url
$pagenum= Request('pagenum',1);	//页数
$pagesize=Request('pagesize',1);//分页数
$level	= Request('level',0);		//是否首页显示

$refresh_url	= 'nav.php?cateid='.$cateid;

$ArrField=array('order','title','content','active','cateid','url','level','userid');
$ArrValue=array($order,	$title,	$content,	$active, $cateid, $url,	$level,$userid);

if($mode=='add'){
	if ($MyDatabase->Insert('nav',$ArrField,$ArrValue)){
		$refresh_msg	= $title.'，添加成功。';
		$refresh_id		= 'navadd';
		
		//管理员日志
		$log_content			= '网址'.$title.' &gt;&gt; 添加 &gt;&gt; 成功';

		$page_name='../include/refreshno.php';
	}
}
if($mode=='addbatch'){
	//批量添加
	//获取titleurl
	$titleurl=Request('titleurl');
	$titleurlarr=explode(chr(10),$titleurl);
	$titleurllen=count($titleurlarr);
	
	$succeed=TRUE;
	
//	echo print_r($titleurlarr);die();
	for ($i=0;$i<$titleurllen;$i+=2){
		$titleurlarr_arr=explode('http',$titleurlarr[$i]);
		$title		=	$titleurlarr_arr[0];
		$url			=	'http' .$titleurlarr_arr[1];
		$content	=	$titleurlarr[$i+1];
		
		$ArrValue=array($order,	$title,	$content,	$active, $cateid, $url,	$level,$userid);		
		
		if ($MyDatabase->Insert('nav',$ArrField,$ArrValue)){
			$log_content			= '网址'.$title.' &gt;&gt; 添加 &gt;&gt; 成功';
		}else{
			$log_content			= '网址'.$title.' &gt;&gt; 添加 &gt;&gt; 失败';
			$succeed=FALSE;
		}
		
		//echo $MyDatabase->SqlStr;		die();
		
		if ($succeed){
			$refresh_msg	= '网址批量添加成功。';
		}else{
			$refresh_msg	= '网址批量添加失败。';
		}
	
		
		$page_name='../include/refreshno.php';
		$refresh_id		= 'navaddbatch';		
	}	
	
}elseif ($mode=='edit'){
	//全修改
	$MyDatabase->Update('nav',$ArrField,$ArrValue,'`id`=' . $id . ' AND `userid`='.$userid);

	$refresh_msg	= $title.'，修改成功，请返回列表页面。';

	//管理员日志
	$log_content			= '网址'.$title.' &gt;&gt; 修改 &gt;&gt; 成功';
}elseif ($mode=='editone'){
//单修改
//	$code		= Request('code');	
//	$aaa=array_keys($_REQUEST);
	$aaa=array_keys($_POST);
	/*
	echo '<PRE>';
	print_r($aaa );
	echo '<hr>'.$aaa[1];
	*/
	$ArrField=array($aaa[1]);
	$ArrValue=array(Request($aaa[1]));
		
//	echo $ArrField;	
	
	if ($MyDatabase->Update('nav',$ArrField,$ArrValue,'`id`=' . $id . ' AND `userid`='.$userid)){
		$log_content			= '网址 &gt;&gt; 修改 &gt;&gt; 成功';		
		echo 'true';
	}else {
		$log_content			= '网址 &gt;&gt; 修改 &gt;&gt; 失败';
		echo 'false';
	}		
}elseif (isset($_POST['s_list_del'])){
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++){
		$MyDatabase->Delete('nav','`id`='. $_POST["selectid"][$i]);
	}
	$refresh_msg	= '批量删除网址[<font color=red>成功</font>]，返回列表页面。';
	
	$log_content			= '批量删除网址 &gt;&gt; 成功';
}elseif (isset($_POST['s_list_order'])){
	//修改顺序
	$id=explode('|',$_POST['sort_id']);
	for($i = 1;$i<sizeof($id);$i++){
		$order=$pagesize*($pagenum-1)+$i;
		$MyDatabase->Update('nav',array('order'),array($order),'`id`='. $id[$i-1]);		
	}
	$refresh_msg	= '批量修改网址顺序[<font color=red>成功</font>]，返回列表显示页面。';

	$log_content			= '网址顺序'.$title.' &gt;&gt; 修改 &gt;&gt; 成功';
}elseif (isset($_POST['s_list_lorder'])){
	//修改顺序
	$id=explode('|',$_POST['sort_id']);
	for($i = 1;$i<sizeof($id);$i++){
		$order=$pagesize*($pagenum-1)+$i;
		$MyDatabase->Update('nav',array('lorder'),array($order),'`id`='. $id[$i-1]);		
	}
	$refresh_msg	= '批量修改首页网址顺序[<font color=red>成功</font>]，返回列表显示页面。';
	$refresh_url	= 'navorder.php?cateid='.$cateid;	
	
	$log_content			= '网址首页顺序'.$title.' &gt;&gt; 修改 &gt;&gt; 成功';
	
}elseif ( isset($_POST['s_move']) ){
	//移动分类
	$changecateid=$_POST['changecateid'];

	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++){
		$moveid=$_POST["selectid"][$i];
		$MyDatabase->Update('nav',array('cateid'),array($changecateid),'`id`='. $moveid);
	}
	$refresh_msg	= '修改网址[<font color=red>成功</font>]，返回网址显示页面。';

	$log_content			= '网址 &gt;&gt; 发布 &gt;&gt; 成功';
}

require($page_name.'.php');

require('../../include/debug.php');

//管理员日志
require('../../include/log.php');
?>