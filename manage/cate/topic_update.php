<?php
/**
 * 主贴修改
 * 
 * @author Zerolone
 * @version 2010-3-16 14:44:40
 */
require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt = '失败';
$mode					=	Request('mode');			//提交方式， add为添加， edit为修改
$fid					= Request('fid',0);			//栏目编号
$page					= Request('page', 1);
$refresh_url	= Request('refresh_url','topic.php?fid='.$fid.'&page='.$page);
$logo					=	Request('logo');			//Logo
$content			=	Request('content');		//说明
$title				=	Request('title');			//标题
$forumadmin		= Request('forumadmin');
$post_check		= Request('post_check', 0);
$reply_check	= Request('reply_check', 0);

//---------------logo---帮助---------说明-------发帖审核------回复审核
$ArrField=array('logo','forumadmin','content', 'post_check', 'reply_check');
$ArrValue=array($logo, $forumadmin, $content,  $post_check,  $reply_check);

//添加
if($mode=='add'){
	if ($MyDatabase->Insert('forums',$ArrField,$ArrValue)){
		$refresh_txt = '成功';
	}

	$page_name	= '../../include/refreshno.php';
	$refresh_msg	= '栏目：[<font color=red>'.$title.'</font>]添加'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
	
}elseif ($mode=='edit'){
	//判断$dir是否重复
	if ($MyDatabase->Update('forums', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '栏目：[<font color=red>'.$title.'</font>]修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}

//删除一个帖子，包括回复
elseif ($mode=="del"){
	$tid=Request('tid');

	//回复数
	$posts=0;
	$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `tid`='.$tid;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$posts = $MyDatabase->ResultArr [0]['count'] + 1;		
	}
	
	//更新forums数据
	$SqlStr='UPDATE `'.DB_TABLE_PRE.'forums` SET `topic`= `topic`-1, `post`=`post`-'.$posts.'   WHERE `fid`='.$fid;
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->ExecuteQuery()){
	}else {
		DebugStr($MyDatabase->SqlStr);
		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('更新首页显示栏目统计！');
	}	
		
	
	if ($MyDatabase->Delete('topics', '`tid`='.$tid) && $MyDatabase->Delete('topics_ext', '`tid`='.$tid) && $MyDatabase->Delete('posts', '`tid`='.$tid)){
		$refresh_txt = '成功';
	}
	
	$refresh_msg	= '帖子：删除'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;		
}elseif ($mode=="unite"){
	$cate1		= $_POST['cate1'];
	$cate2		= $_POST['cate2'];

	$SqlL = 'UPDATE `'.table_pre.'article` SET';

	//标题
	$SqlL .= '`cateid`=';
	$SqlL .= '\'' . $cate2 . '\'';

	$SqlL.=  ' WHERE `cateid`=' . $cate1;

	query($SqlL);

	$refresh_msg	= '文章分类：[<font color=red>合并</font>]成功，跳转到合并后的页面。';

	$refresh_url	= 'article.php?cateid='.$cate2;

	//管理员日志
	$log_content			= '文章栏目 &gt;&gt; 合并 &gt;&gt; 成功';
}
//修改顺序
elseif( isset($_POST['s_list_level']) ){
	for($i = 0;$i<sizeof( $_POST["level"] );$i++)	{
		if($MyDatabase->Update('forums', array('level'), array($_POST["level"][$i]), '`fid`='.$_POST["fid"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '栏目顺序：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//修改栏目名
elseif( isset($_POST['s_list_title']) ){
	for($i = 0;$i<sizeof( $_POST["title"] );$i++)	{
		if($MyDatabase->Update('topics', array('title'), array($_POST["title"][$i]), '`tid`='.$_POST["tid"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '栏目名：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目名 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//修改置顶
elseif( isset($_POST['s_list_top']) ){
	for($i = 0;$i<sizeof( $_POST["top"] );$i++)	{
		$top=$_POST["top"][$i];
		
		if($MyDatabase->Update('topics', array('top'), array($top), '`tid`='.$_POST["tid"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '主贴置顶：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '主贴置顶 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//锁定操作
elseif( isset($_POST['s_list_lock']) ){
	//锁定
	if(isset($_POST["lock"])){
		for($i = 0;$i<sizeof( $_POST["lock"] );$i++)	{
			$tid=$_POST["lock"][$i];		
			if($MyDatabase->Update('topics', array('lock'), array('1'), '`tid`='.$tid)) $refresh_txt = '成功';
		}
	}

	//锁定取消
	if(isset($_POST["unlock"])){
		for($i = 0;$i<sizeof( $_POST["unlock"] );$i++)	{
			$tid=$_POST["unlock"][$i];		
			if($MyDatabase->Update('topics', array('lock'), array('0'), '`tid`='.$tid)) $refresh_txt = '成功';
		}
	}

	$refresh_msg	= '主贴锁定：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '主贴锁定 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//修改帖子栏目
elseif( isset($_POST['s_list_fid']) ){
	for($i = 0;$i<sizeof( $_POST["ffid"] );$i++)	{
		$ffid=$_POST["ffid"][$i];
		if($MyDatabase->Update('topics', array('fid'), array($ffid), '`tid`='.$_POST["tid"][$i])){
			$refresh_txt = '成功';
		}

		$SqlStr='UPDATE `'.DB_TABLE_PRE.'forums` SET `topic`=`topic`-1 WHERE `fid`='.$fid;
		$MyDatabase->SqlStr=$SqlStr;
		if ($MyDatabase->ExecuteQuery()){
		}else {
			echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';DebugStr($MyDatabase->SqlStr);
		}

		$SqlStr='UPDATE `'.DB_TABLE_PRE.'forums` SET `topic`=`topic`+1 WHERE `fid`='.$ffid;
		$MyDatabase->SqlStr=$SqlStr;
		if ($MyDatabase->ExecuteQuery()){
		}else {
			echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';DebugStr($MyDatabase->SqlStr);
		}

	}

	$refresh_msg	= '帖子栏目：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '帖子栏目 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
require($page_name.'.php');
require('../../include/debug.php');
?>