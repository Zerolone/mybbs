<?php
/**
 * 用户组权限列表显示
 * 
 * @version 2009-3-3 14:32:32
*/

require('../include/common.php');
define('PAGENAME', 'group.php');

//读取页数
$pagenum 	= Request('pagenum',1);

//页面记录数
$pagesize 	= 10;

//总记录
$recordcount	= 0;

$SqlStr	= 'SELECT COUNT( * ) as `count` FROM `'.DB_TABLE_PRE.'admin_group`';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0]['count'];
}

//文章列表
$SqlStr	= 'SELECT * from `'.DB_TABLE_PRE.'admin_group`';
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$group_list=$MyDatabase->ResultArr;
}
require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '管理员 &gt;&gt; 列表';
require('../../include/log.php');
?>