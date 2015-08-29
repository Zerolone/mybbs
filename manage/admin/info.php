<?php
/**
 * 用户密码修改
 * 
 * @version 2009-3-3 14:29:16
*/

require('../include/common.php');

$page_name	= 'info.php';


//获取信息
//-------------------0----------1--------2----------3
$SqlStr	= 'SELECT `title1`, `title2`, `title3`, `copyright` From `' .DB_TABLE_PRE. 'admin`';
$SqlStr.= ' WHERE `id`= ' . $userid . ';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title1			= $DB_Record[0];
	$title2			= $DB_Record[1];
	$title3			= $DB_Record[2];
	$copyright	= $DB_Record[3];
}

require($page_name.'.php');

//管理员日志
$log_content			= '用户修改信息 &gt;&gt; 修改前台';

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>