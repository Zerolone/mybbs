<?php
/**
 * 可提供服务
 * 
 * @version 2009-3-17 11:00:00
 * @author Zerolone
*/
require('../include/common.php');

$page_name	= 'navservice.php';

//读取页数
$pagenum 	= Request('pagenum', 1);

//上级
$pid			= Request('pid',1);

//页面记录数
$pagesize 	= 20 ;

//总记录
$recordcount	= 0;

$SqlStr = 'Select count(*) from `'.DB_TABLE_PRE.'navservice`';
$SqlStr.= ' WHERE `pid`='.$pid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0][0];
}

//------------------0------1--------2-------3-------4
$SqlStr	= 'SELECT `id`, `title`, `order`, `url`, `active` FROM `'.DB_TABLE_PRE.'navservice`';
$SqlStr.= ' WHERE `pid`='.$pid;
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$navbar_title 	= subString($DB_Record[1],76);
		$navbar_active_txt	= '使用';
		if($DB_Record[4]=='0')	$navbar_active_txt	= '不使用';
				
		$navbar_list[] = array(
		'id' 			=> $DB_Record[0],
		'title'		=> $navbar_title,
		'order'		=> $DB_Record[2],
		'url'			=> $DB_Record[3],
		'active_txt'	=> $navbar_active_txt,
		);
	}
}

//管理员日志
$log_content			= '导航菜单管理 &gt;&gt; 可提供服务查看';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>