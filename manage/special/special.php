<?php
/**
 * 专题列表显示
 * 
 * @author Zerolone
 * @version 2009-8-17 15:19:50
*/

require('../include/common.php');
$page_name	= 'special.php';

$pagenum 	= Request('pagenum',1);	//读取页数
$pagesize 	= 12 ;								//页面记录数
$recordcount=0;										//总记录

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'special`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$recordcount	= $DB_Record[0];
}

//专题列表
//------------------0------1---------2----------3------4
$SqlStr	= 'SELECT `id`, `title`, `order` from `'.DB_TABLE_PRE.'special`';
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$special_list[] = array(
		'id' 							=> $DB_Record[0],
		'title'						=> $DB_Record[1],
		'order'						=> $DB_Record[2]
		);
	}
}
//管理员日志
$log_content			= '专题 &gt;&gt; 列表';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>