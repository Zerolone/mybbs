<?php 
/**
 * 发帖
 * 
 * @version	2010-3-23 20:09:10
 * @author		Zerolone
 * 
 */
require('include/common.php');
define('PAGENAME','post.php');

if ($user->uid==''){
	$refresh_msg='请登录，点击登录！';
	$refresh_url='login.php';
	require 'include/refresh.php.php';
	exit();
}

$fid					= Request('fid');					//获取栏目编号
$page					= Request('page',1);			//页数
$atc_title		= '';											//标题
$atc_content	= '';											//内容
$tid					= Request('tid', 0);			//帖子编号
$article			=	Request('article',0);		//是否为主题， 0为主题
$id						=	Request('id','topic');	//帖子编号

//获取版块
$SqlStr ='SELECT * FROM `'. DB_TABLE_PRE .'forums` WHERE `fid`='.$fid.' AND length(`level`)=4;';
$MyDatabase->SqlStr= $SqlStr;
if ($MyDatabase->Query ()) {	
	$foruminfo=$MyDatabase->ResultArr [0];
	
	//返回导航信息
	$msg_guide= ' -&gt; <a href="'.sprintf(URLTOPIC, $foruminfo['fid']).'">'.$foruminfo['title'].'</a>';	
}
if(!is_numeric($fid) || !$foruminfo){
	DebugStr($MyDatabase->SqlStr);
	echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('获取版块信息错误！');
}

$step=Request('step',0);
if ($step>0){
	//提交用到的函数
	require_once('postfunc.php');
}

$action=Request('action', 'new');

if ($action=="new"){
	$ifcheck=0;
	$article=1;
	require_once('postnew.php');
}elseif($action=="reply" || $action=="quote"){
	require_once('postreply.php');
} elseif($action=="modify"){
	require_once('postmodify.php');
}

require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');
?>