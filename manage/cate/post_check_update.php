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
$refresh_url	= Request('refresh_url','post_check.php?page='.$page);
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
}elseif ($mode=="del"){
	//删除栏目
	//------------------0---------1----------2--------3
	$SqlStr	= 'Select `title`, `level` From `' .DB_TABLE_PRE. 'article_cate` WHERE `id`= ' . $id;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$title	= $DB_Record[0];
		$level	= $DB_Record[1];
	}

	//level长度
	$level_len	= strlen($level);

	
		$refresh_msg	= '文章栏目删除失败，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章栏目删除失败';
	
	//删除当前编号记录//删除当前编号记录下面的记录
	if(	$MyDatabase->Delete('article_cate','`id`='.$id) &&	$MyDatabase->Delete('article_cate','left(`level`, '.$level_len.') = '. $level)){
	//删除所有属于该类的文章
	//$SqlStr = 'DELETE FROM `'.table_pre.'article` WHERE left(`level`, '.$level_len.') = '. $level ;
	//query($SqlStr);
		$refresh_msg	= '文章栏目删除成功，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章栏目删除成功';		
	}
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
		
		if($MyDatabase->Update('threads', array('top'), array($top), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '主贴置顶：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '主贴置顶 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//修改锁定
elseif( isset($_POST['s_list_lock']) ){
	for($i = 0;$i<sizeof( $_POST["lock"] );$i++)	{
		$lock=$_POST["lock"][$i];
		
		if($MyDatabase->Update('threads', array('lock'), array($lock), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '主贴锁定：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '主贴锁定 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//审核主题
elseif( isset($_POST['s_list_check']) ){
	for($i = 0;$i<sizeof( $_POST["check"] );$i++)	{
		$id=$_POST["check"][$i];
		
		if($MyDatabase->Update('topics', array('ifcheck'), array('1'), '`tid`='.$id)){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '主贴：[<font color=red>审核'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '主贴 &gt;&gt; 审核 &gt;&gt; '.$refresh_txt;	
}
//审核回复主题
elseif( isset($_POST['s_list_post']) ){
	//加载postfunc.php
	require '../../postfunc.php';
//	DebugArr($_POST["id"]);
	
	for($i = 0;$i<sizeof( $_POST["tid"] );$i++)	{
		$tid			= $_POST["tid"][$i];
		$title		= $_POST["title"][$i];
		$content	= $_POST["content"][$i];
		
		//审核回复
		if($MyDatabase->Update('posts', array('title','content','ifcheck'), array($title, $content, '1'), '`tid`='.$tid)){
			$refresh_txt = '成功';
		}else{
			echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg($MyDatabase->SqlStr);
		}
		
		//统计回复数
		$replies=0;
		$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `tid`='.$tid;
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$replies = $MyDatabase->ResultArr [0]['count'];		
		}
			
		if($MyDatabase->Update('topics', array('replies'), array($replies), '`tid`='.$tid)){
			$refresh_txt = '成功';
		}
		
		/*
		 * 更新一下统计
		 */
		//获取帖子所属栏目
		$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'topics` WHERE `tid`='.$tid;
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$DB_Record = $MyDatabase->ResultArr [0];
			
			$fid		= $DB_Record['fid'];
			$author	= $DB_Record['author'];
			$title	= $DB_Record['title'];
			
			//更新
			lastinfo($fid,$tid,'reply',$author, $MyDatabase,$title);
		}
	}

	$refresh_msg	= '帖子：[<font color=red>审核'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '贴子 &gt;&gt; 审核 &gt;&gt; '.$refresh_txt;	
}
require($page_name.'.php');
require('../../include/debug.php');
?>