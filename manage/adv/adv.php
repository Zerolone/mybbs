<?php
/**
 * 广告列表显示
 * 
 * @author Zerolone
 * @version 2009-8-20 14:56:10
 */

require('../include/common.php');
define('PAGENAME','adv.php');

$pagenum 	= Request('pagenum',1);		//读取页数
$pagesize = 10 ;										//页面记录数
$recordcount	= 0;									//总记录

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'ad`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$recordcount	= $DB_Record[0];
}

//广告列表
//------------------0------1---------2-------3------4-------5---------6---------7
$SqlStr	= 'SELECT `id`, `title`, `order`, `hits`, `url`, `active`, `width`, `height` from `'.DB_TABLE_PRE.'ad`';
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
		'hits'		=> $DB_Record[3],
		'url'			=> $DB_Record[4],
		'active'	=> $DB_Record[5],
		'width'		=> $DB_Record[6],
		'height'	=> $DB_Record[7],
		);
	}
}

//管理员日志
$log_content			= '广告 &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>