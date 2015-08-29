<?php
/**
 * 模板列表显示，按顺序Order显示
 * 
 * @author Zerolone
 * @version 2009-8-14 10:01:50
 */
require('../include/common.php');
define('PAGENAME','template.php');

$pagenum=Request('pagenum',1);	//读取页数
$pagesize 	= 14 ;							//页面记录数

//计算总记录数
$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'article_template`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	//总记录
	$recordcount	= $DB_Record[0];
}

//文章列表
//------------------0------1-------2------3------4--------5
$SqlStr	= 'SELECT `id`, `title`, `html`, `js`, `order`, `css` from '.DB_TABLE_PRE.'article_template ';
$SqlStr.= ' ORDER BY `Order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$article_title = subString($DB_Record[1],76);
	
		$template_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> $article_title,
		'html'			=> $DB_Record[2],
		'js'				=> $DB_Record[3],
		'order'			=> $DB_Record[4],
		'css'				=> $DB_Record[5]
		);
	}
}

require(PAGENAME.'.php');
require('../../include/debug.php');
?>