<?php
/**
 * QA分类列表显示
 * 
 * @author Zerolone
 * @version 2009-12-4 14:39:12
 */

require('../include/common.php');
define('PAGENAME','cate.php');

$pagenum 		= Request('pagenum',1);		//读取页数

//页面记录数
$pagesize 	= 20 ;

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'qa_cate`';
$MyDatabase->SqlStr = $SqlStr;
$recordcount	= 0;	//总记录
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$recordcount	= $DB_Record[0];
}

//专题列表
//------------------0------1---------2----------3------4
$SqlStr	= 'SELECT `id`, `title`, `order` from `'.DB_TABLE_PRE.'qa_cate`';
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$cate_list[] = array(
		'id' 							=> $DB_Record[0],
		'title'						=> $DB_Record[1],
		'order'						=> $DB_Record[2]
		);
	}
}

//管理员日志
$log_content			= 'QA分类 &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>