<?php
/**
 * 帖子查看
 * 
 * @version 2010-3-15 20:22:37
 * @author Zerolone
*/
require('../include/common.php');
define('PAGE_NAME','topic.php');

//获取栏目编号
$fid=Request('fid');
//获取版块内容， 包括了版块公告
$SqlStr ='SELECT * FROM `'. DB_TABLE_PRE .'forums`';
$SqlStr.='WHERE `fid` =' . $fid;

$MyDatabase->SqlStr= $SqlStr;
if ($MyDatabase->Query ()) {	
	$foruminfo = $MyDatabase->ResultArr[0];	
	if (strlen($foruminfo['level'])==2){
		//版块为分类的话， 显示下级的栏目名
		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('当前栏目为分类，请返回。');
	}
}else{
	DebugStr($SqlStr);
	echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('获取版块数据错误！');
}

//论坛帖子
$forumdb=array();

//搜索方式
$search='';

//获取主题数
$count=$foruminfo['topic'];

$tpcdb=array();	
//获取当前页
$page=Request('page',1)+0;
if ($page<1) $page=1;
		
//帖子排序方式
/**/
$sql='fid='.$fid;
$SqlWhere=' AND `ifcheck`=1';
$sql.=$SqlWhere;

//置顶贴
$topadd='`top` DESC,';
	
//顺序
$asc = 'DESC';

//排序方式
$orderway='`lastpost`';
$orderway ? $w_add="orderway=$orderway&asc=$asc&" : $w_add='';
	
//分页
$numofpage=ceil($count/PAGE_PER_B);
$totlepage=$numofpage;
if ($numofpage && $page>$numofpage){
	$page=$numofpage;
}
$start_limit = ($page - 1) * PAGE_PER_B;
$limit2=' LIMIT '.$start_limit. ','.PAGE_PER_B . ';';

//分页
$pages=numofpage($count,$page,$numofpage,"topic.php?fid=$fid&search=$search&$w_add");

//排序
$orderway.=' '.$asc;


//显示帖子，如果需要查询， 则显示查询的帖子
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'topics` WHERE ' . $sql . ' ORDER BY ' . $topadd . $orderway . $limit2;
//	DebugStr($str_Sql);
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$topicdb = $MyDatabase->ResultArr;		
}else {
	DebugStr($MyDatabase->SqlStr);
	echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('没有帖子！');
}
			
//当前栏目的帖子
foreach($topicdb as $topic){
	//如果上传过附件
	$topic['titleadd']='';
	if($topic['ifupload']){
		$topic['titleadd']=" <img src='../../image/ico/file/img.gif' align='absbottom' border=0>";
	}

	//这个不知道如何注释
	$topics[]=$topic;
}
//DebugArr($topics);

require(PAGE_NAME.'.php');
require('../../include/debug.php');
?>