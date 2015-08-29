<?php
/**
 * 用户列表显示
 *
 * @version 2009-3-3 14:45:01
 * @author Zerolone
*/

require('../include/common.php');
define('PAGENAME', 'admin.php');


$pagenum 			= Request('pagenum',1);	//读取页数
$pagesize 		= 14 ;									//页面记录数
$recordcount	= 0;										//总记录

$SqlStr	= 'SELECT COUNT( * ) AS `count` FROM `'.DB_TABLE_PRE.'admin`';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0]['count'];
}

//管理员列表
$SqlStr	= 'SELECT * ';
$SqlStr.= ' FROM `'.DB_TABLE_PRE.'view_admin`';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$admin_list=$MyDatabase->ResultArr;
}

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '管理员 &gt;&gt; 列表';
require('../../include/log.php');
?>