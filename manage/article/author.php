<?php
/**
 * author_from列表显示
 * 
 * @author Zerolone
 * @version 2009-12-2 11:54:27
 */

require ('../include/common.php');
define('PAGENAME','author.php');

//读取页数
$pagenum 	= Request('pagenum', 1);

$pagesize=20;

//读取kind
$kind 	= Request('kind','author');

$recordcount = 0;

$SqlStr	= ' SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'article_'.$kind.'`';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0][0];
}

//文章列表
//------------------0------1--------2----------3------4------5
$SqlStr	= 'SELECT `id`, `name`, `order` from `'.DB_TABLE_PRE.'article_'. $kind .'`';
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr=$MyDatabase->ResultArr;
	foreach ($DB_Record_Arr as $DB_Record){
		$author_list[] = array(
		'id' 					=> $DB_Record[0],
		'name'				=> $DB_Record[1],
		'order'				=> $DB_Record[2]
		);
	}
}

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '作者来源 &gt;&gt; 列表';
require('../../include/log.php');
?>