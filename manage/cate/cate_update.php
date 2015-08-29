<?php
/**
 * 栏目添加、修改
 * 
 * @author Zerolone
 * @version 2010-3-16 14:44:40
 */
require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt = '失败';
$refresh_url	= Request('refresh_url','cate.php');
$mode					=	Request('mode');			//提交方式， add为添加， edit为修改
$fid					= Request('fid',0);			//栏目编号
$logo					=	Request('logo');			//Logo
$content			=	Request('content');		//说明
$title				=	Request('title');			//标题
$forumadmin		= Request('forumadmin');
$post_check		= Request('post_check', 0);
$reply_check	= Request('reply_check', 0);
$modify_check	= Request('modify_check', 0);

$allowvisit		= Request('allowvisit');
if($allowvisit) $allowvisit = implode(",", $allowvisit);
$allowpost		= Request('allowpost');
if($allowpost) $allowpost = implode(",", $allowpost);
$allowreply		= Request('allowreply');
if($allowreply) $allowreply = implode(",", $allowreply);

//---------------logo---帮助---------说明-------发帖审核------回复审核-------修改审核--------允许浏览-----允许发帖-----运行回帖
$ArrField=array('logo','forumadmin','content', 'post_check', 'reply_check', 'modify_check', 'allowvisit','allowpost', 'allowreply');
$ArrValue=array($logo, $forumadmin, $content,  $post_check,  $reply_check, 	$modify_check,  $allowvisit, $allowpost,  $allowreply);

//添加
if($mode=='add'){
	if ($MyDatabase->Insert('forums',$ArrField,$ArrValue)){
		$refresh_txt = '成功';
	}

	$page_name	= '../../include/refreshno.php';
	$refresh_msg	= '栏目：[<font color=red>'.$title.'</font>]添加'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目 &gt;&gt; 添加 &gt;&gt; '.$refresh_txt;	
}

//添加
elseif( isset($_POST['s_add']) ){
	if ($MyDatabase->Insert('forums',$ArrField,$ArrValue)){
		$refresh_txt = '成功';
	}

	$refresh_msg	= '栏目添加'.$refresh_txt.'</font>，点击返回。';
	$log_content			= '栏目 &gt;&gt; 添加 &gt;&gt; '.$refresh_txt;
}

elseif ($mode=='edit'){
	//判断$dir是否重复
	if ($MyDatabase->Update('forums', $ArrField, $ArrValue, '`fid`='.$fid)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '栏目：[<font color=red>'.$title.'</font>]修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}elseif ($mode=="del"){
	//删除栏目
	
	//1.删除回复表
	if(	$MyDatabase->Delete('posts','`fid`='.$fid)){
		$refresh_msg	= '回复删除成功-';
	
		//管理员日志
		$log_content			= '回复删除成功';		
	}	
	
	//2.删除发帖扩展表
	$SqlWhere='(SELECT `tid` FROM `'.DB_TABLE_PRE.'topics` WHERE `fid`='.$fid.')';
	if(	$MyDatabase->Delete('topics_ext','`tid` in '.$SqlWhere)){
		$refresh_msg.= '发帖扩展删除成功-';
	
		//管理员日志
		$log_content.= '发帖扩展删除成功-';		
	}	
	
	//3.删除发帖库
	if(	$MyDatabase->Delete('topics','`fid`='.$fid)){
		$refresh_msg.= '发帖删除成功-';
	
		//管理员日志
		$log_content.= '发帖删除成功-';		
	}
	
	//4.删除栏目
	if(	$MyDatabase->Delete('forums','`fid`='.$fid)){
		$refresh_msg.= '栏目删除成功';
	
		//管理员日志
		$log_content.= '栏目删除成功';		
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
		if($MyDatabase->Update('forums', array('title'), array($_POST["title"][$i]), '`fid`='.$_POST["fid"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '栏目名：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目名 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}
//重新统计-单个栏目
elseif ($mode=="count"){
	$SqlWhere=' AND `ifcheck`=1';
	
	//主题数
	$topics=0;
	$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'topics` WHERE `fid`='.$fid.$SqlWhere;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$topics = $MyDatabase->ResultArr [0]['count'];		
	}
	
	//帖子数
	$posts=0;
	$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `fid`='.$fid.$SqlWhere;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$posts = $MyDatabase->ResultArr [0]['count'] + $topics;
	}
		
	//最后发表主题
	$lastpost='';
	$SqlStr ='SELECT * FROM `'.DB_TABLE_PRE.'topics` WHERE `fid`='.$fid;
	$SqlStr.=' ORDER BY `tid` DESC LIMIT 1;';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$topic = $MyDatabase->ResultArr [0];
		
		$new_url  = 'read.php?tid='.$topic['tid'];
		$lastpost = $topic['title']."\t".addslashes($topic['author'])."\t".get_date($topic['postdate'])."\t".$new_url;		
	}	
		
	if($MyDatabase->Update('forums', array('topic', 'post', 'lastpost'), array($topics, $posts, $lastpost), '`fid`='.$fid)){
		$refresh_txt = '成功';
	}

	$refresh_msg	= '栏目统计：[<font color=red>更新'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '栏目统计 &gt;&gt; 更新 &gt;&gt; '.$refresh_txt;	
}
//重新统计-所有栏目
elseif ($mode=="countall"){
	//获取所有栏目列表
	$SqlStr ='SELECT * FROM `'.DB_TABLE_PRE.'forums` WHERE length(`level`)=4;';
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
//		DebugArr($DB_Record_Arr);
		foreach ( $DB_Record_Arr as $DB_Record ) {	
			$fid=$DB_Record['fid'];
		
			//主题数
			$topics=0;
			$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'topics` WHERE `fid`='.$fid;
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$topics = $MyDatabase->ResultArr [0]['count'];		
			}
			
			//帖子数
			$posts=0;
			$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `fid`='.$fid;
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$posts = $MyDatabase->ResultArr [0]['count'] + $topics;
			}
				
			//最后发表
			$lastpost='';
			$SqlStr ='SELECT * FROM `'.DB_TABLE_PRE.'posts` WHERE `fid`='.$fid;
			$SqlStr.=' ORDER BY `id` DESC LIMIT 1;';
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$topic = $MyDatabase->ResultArr [0];
				
				$new_url  = 'read.php?id='.$topic['id'];
				$lastpost = $topic['title']."\t".addslashes($topic['author'])."\t".get_date($topic['postdate'])."\t".$new_url;		
			}	
				
			if($MyDatabase->Update('forums', array('topic', 'post', 'lastpost'), array($topics, $posts, $lastpost), '`fid`='.$fid)){
				$refresh_txt = '成功';
			}
		}
	}else {
		DebugStr($MyDatabase->SqlStr);
		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('所有栏目统计统计失败！');
	}

	$refresh_msg	= '所有栏目统计：[<font color=red>更新'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '所有栏目统计 &gt;&gt; 更新 &gt;&gt; '.$refresh_txt;	
}
//重新统计-所有当前栏目的回复数
elseif ($mode=="replies"){
	//获取所有栏目列表
	$SqlStr ='SELECT * FROM `'.DB_TABLE_PRE.'topics` WHERE `fid`='.$fid;
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
//		DebugArr($DB_Record_Arr);
		foreach ( $DB_Record_Arr as $DB_Record ) {	
			$tid=$DB_Record['tid'];
		
			//回复数
			$replies=0;
			$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `tid`='.$tid;
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$replies = $MyDatabase->ResultArr [0]['count'];		
			}
				
			if($MyDatabase->Update('topics', array('replies'), array($replies), '`tid`='.$tid)){
				$refresh_txt = '成功';
			}
		}
	}else {
		DebugStr($MyDatabase->SqlStr);
		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('当前栏目回复数失败！');
	}

	$refresh_msg	= '当前栏目统计：[<font color=red>更新'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '当前栏目统计 &gt;&gt; 更新 &gt;&gt; '.$refresh_txt;	
}

//重新统计-所有当前栏目的回复数
elseif ($mode=="repliesall"){
	//批量处理
	$page=Request('page',1);
	$perpage=5000;
	
	$SqlStr ='SELECT * FROM `'.DB_TABLE_PRE.'topics`';
	$SqlStr.=' LIMIT '. ($page-1)*$perpage . ',' . $perpage . ';';
			
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
//		DebugArr($DB_Record_Arr);
		foreach ( $DB_Record_Arr as $DB_Record ) {	
			$tid=$DB_Record['tid'];
					
			//回复数
			$replies=0;
			$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `tid`='.$tid;
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$replies = $MyDatabase->ResultArr [0]['count'];		
			}
						
			if($MyDatabase->Update('topics', array('replies'), array($replies), '`tid`='.$tid)){
				$refresh_txt = '成功';
			}
		}
		$refresh_msg  = '统计['. $page*$perpage . ']-[' . ($page+1)*$perpage . ']成功。';
		$refresh_url	= Request('refresh_url','cate_update.php?mode=repliesall&page='.($page+1));
	}
	else {
//		DebugStr($MyDatabase->SqlStr);
//		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('当前栏目回复数失败！');
		$refresh_msg	= '所有栏目回复：[<font color=red>更新完毕</font>]，点击返回。';
	}

	$log_content			= '所有栏目回复 &gt;&gt; 更新 &gt;&gt; '.$refresh_txt;	
}
require($page_name.'.php');
require('../../include/debug.php');
?>