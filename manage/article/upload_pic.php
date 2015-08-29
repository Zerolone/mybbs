<?php
/**
* 文章系统中的图片上传管理
* 
* @version 2009-12-23 9:46:23
* @author Zerolone
*/
require ('../include/common.php');

define('PAGENAME','upload_pic.php');

//读取页数
$pagenum 	= Request('pagenum', 1);

//页面记录数
$pagesize 	= 10 ;

$SqlStr = 'Select count(*) from `'.DB_TABLE_PRE.'article_pic`';
$MyDatabase->SqlStr = $SqlStr;
$recordcount	= 0;	//总记录
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$recordcount	= $DB_Record[0];
}

//------------------0------1---------2----------3------4
$SqlStr	= 'SELECT `url`, `urlold`, `posttime`, `id` from '.DB_TABLE_PRE.'article_pic';
$SqlStr.= ' ORDER BY `id` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$photo_list[] = array(
		'url' 			=> SITE_URL . $DB_Record[0],
		'urlold'		=> $DB_Record[1],
		'posttime'	=> $DB_Record[2],
		'id'				=> $DB_Record[3]
		);
	}
}

//管理员日志
$log_content			= '文章管理 &gt;&gt; 图片列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>