<?php
/**
 * 公告列表显示
 * 
 * @author Zerolone
 * @version 2010-3-15 23:39:04
 */

require('../include/common.php');
define('PAGENAME','announce.php');

$pagenum 	= Request('pagenum',1);		//读取页数
$pagesize = 20 ;										//页面记录数
$recordcount	= 0;									//总记录

$SqlStr	= 'SELECT COUNT( * ) AS `count` FROM `'.DB_TABLE_PRE.'announce`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0]['count'];
}

//公告列表
$SqlStr	= 'SELECT * FROM `'.DB_TABLE_PRE.'announce`';
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$announce_list = $MyDatabase->ResultArr;
}

//管理员日志
$log_content			= '公告 &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>