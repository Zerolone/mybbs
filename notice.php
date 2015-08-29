<?php 
/**
 * 公告显示页面
 * 
 * @version	2010-3-11 15:27:13
 * @author		Zerolone
 * 
 */

require('include/common.php');
define('PAGENAME','notice.php');

//接受栏目编号
$fid=Request('fid','0');
$level=Request('level','0');
if($fid!='0'){
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums` WHERE fid='.$fid;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$foruminfo = $MyDatabase->ResultArr [0];		
	}		
}

$noticedb=array();
$SqlStr ='SELECT * FROM `'. DB_TABLE_PRE .'announce`';
$SqlStr.=' WHERE `level` = ' . $level;
$SqlStr.=' ORDER BY `order`, `startdate` DESC';
$MyDatabase->SqlStr= $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $notice ) {
		$notice['startdate']=get_date($notice['startdate']);
		$notice['content']=str_replace("\n","<br />",$notice['content']);
		$notice['content']=$notice['content'];
		$noticedb[]=$notice;
	}
}

require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');
?>