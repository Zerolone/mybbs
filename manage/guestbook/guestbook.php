<?php
/**
 * 留言簿列表显示
 * 
 * @author Zerolone
 * @version 2009-12-4 20:48:10
 */

require('../include/common.php');
define('PAGENAME','guestbook.php');

$pagenum 	= Request('pagenum',1);		//读取页数
$pagesize = 20 ;										//页面记录数
$recordcount	= 0;									//总记录

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'guestbook`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$recordcount	= $DB_Record[0];
}

//------------------0------1---------2-------3---------4-----------5-----------6
$SqlStr	= 'SELECT `id`, `name`, `order`, `active`, `posttime`, `worksid` from `'.DB_TABLE_PRE.'guestbook`';
$SqlStr.= ' ORDER BY `id` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$active_txt = '<font color=blue>未启用</font>';
		if($DB_Record[3]==1) $active_txt = '<font color=red>已启用</font>';
		
		$guestbook_list[] = array(
		'id' 			=> $DB_Record[0],
		'name'		=> $DB_Record[1],
		'order'		=> $DB_Record[2],
		'active'	=> $active_txt,
		'posttime'=> $DB_Record[4],
		'worksid'	=> $DB_Record[5],
		);
	}
}

//管理员日志
$log_content			= '留言簿 &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>