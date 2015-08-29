<?php
/**
 * 用户组权限列表显示
 * 
 * @version 2010-3-20 21:51:58
*/

require('../include/common.php');
define('PAGENAME', 'group.php');

//读取页数
$pagenum 	= Request('pagenum',1);

//页面记录数
$pagesize 	= 10;

//总记录
$recordcount	= 0;

$SqlStr	= 'SELECT * from `'.DB_TABLE_PRE.'user_group`';
$SqlStr.= ' ORDER BY `order` ASC;';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$groups=$MyDatabase->ResultArr;
}

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '用户组 &gt;&gt; 列表';
require('../../include/log.php');
?>