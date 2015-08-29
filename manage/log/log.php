<?php
/**
 * 操作日志列表
 * 
 * @author Zerolone
 * @version 2009-8-20 15:43:25
 */

require('../include/common.php');

define('PAGENAME','log.php');

$pagenum 			= Request('pagenum',1);	//读取页数
$pagesize 		= 100 ;									//页面记录数
$recordcount	= 0;										//总记录

$SqlStr = 'Select count(*) from `'.DB_TABLE_PRE.'log`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$recordcount	= $DB_Record[0];
}

//------------------0-----1-----2--------3---------4-----5
$SqlStr	= 'SELECT `id`, `ip`, `url`, `content`, `date`, `user` FROM `'.DB_TABLE_PRE.'log`';
$SqlStr.= ' ORDER BY `id` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$log_list[] = array(
		'id' 				=> $DB_Record[0],
		'ip'				=> $DB_Record[1],
		'url'				=> $DB_Record[2],
		'content'		=> $DB_Record[3],
		'date'			=> $DB_Record[4],
		'user'			=> $DB_Record[5]
		);
	}
}

//管理员日志
$log_content			= '操作日志列表显示';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>