<?php
/**
 * 学习模块列表显示
 * 
 * @author Zerolone
 * @version 2009-12-8 9:31:16
 */

require('../include/common.php');
define('PAGENAME','class_detail.php');

$pagenum 	= Request('pagenum',1);		//读取页数
$parentid	=	Request('parentid', 1);
$pagesize = 10 ;										//页面记录数
$recordcount	= 0;									//总记录

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'class_detail`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$recordcount	= $DB_Record[0];
}

//模块列表
//------------------0-------1---------2---------3-------4--------5-----------6---------7
$SqlStr	= 'SELECT `id`, `parentid`, `title`, `cycle`, `pic`, `content`, `homework`, `order` FROM `'.DB_TABLE_PRE.'class_detail`';
$SqlStr.= ' WHERE `parentid` =' . $parentid;
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$ad_list[] = array(
		'id' 				=> $DB_Record[0],
		'parentid'	=> $DB_Record[1],
		'title'			=> $DB_Record[2],
		'cycle'			=> $DB_Record[3],
		'pic'				=> $DB_Record[4],
		'content'		=> $DB_Record[5],
		'homework'	=> $DB_Record[6],
		'order'			=> $DB_Record[7],
		);
	}
}

//管理员日志
$log_content			= '学习模块列表 &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>