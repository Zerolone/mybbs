<?php
/**
 * 轮显列表显示，按顺序顺序
 * 
 * @Version 2009-12-2 14:27:52
 * @author Zerolone
 */

require('../include/common.php');
define('PAGENAME','cycle.php');

//读取页数
$pagenum 	= Request('pagenum',1);

//页面记录数
$pagesize 	= 14 ;

$recordcount= 0;

$SqlStr	= ' SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'cycle` ';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0][0];
}

//投票列表
//------------------0------1----------2----------3----------4
$SqlStr	= ' SELECT `id`, `title`, `title_sub`, `order`, `pic` from `'.DB_TABLE_PRE.'cycle` ';
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr=$MyDatabase->ResultArr;
	foreach ($DB_Record_Arr as $DB_Record){
		$cycle_list[] = array(
		'id' 					=> $DB_Record[0],
		'title'				=> $DB_Record[1],
		'title_sub'		=> $DB_Record[2],
		'order'				=> $DB_Record[3],	
		'pic'					=> $DB_Record[4]
		);
	}
}

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '轮显管理 &gt;&gt; 轮显列表';
require('../../include/log.php');
?>