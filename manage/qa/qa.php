<?php
/**
 * QA列表显示
 * 
 * @author Zerolone
 * @version 2009-12-4 14:06:42
 */

require('../include/common.php');
define('PAGENAME','qa.php');

$pagenum 	= Request('pagenum',1);		//读取页数
$pagesize = 20 ;										//页面记录数
$recordcount	= 0;									//总记录
$cateid		= Request('cateid', 1);		//所属栏目

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'qa`';
$SqlStr.= ' WHERE `cateid`='.$cateid;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$recordcount	= $DB_Record[0];
}

//------------------0------1---------2-------3
$SqlStr	= 'SELECT `id`, `title`, `order`, `active` from `'.DB_TABLE_PRE.'qa`';
$SqlStr.= ' WHERE `cateid`='.$cateid;
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$ad_list[] = array(
		'id' 			=> $DB_Record[0],
		'title'		=> $DB_Record[1],
		'order'		=> $DB_Record[2],
		'active'	=> $DB_Record[3],
		);
	}
}

//管理员日志
$log_content			= 'QA &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>