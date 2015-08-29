<?php
/**
 * 报名列表
 * 
 * @author Zerolone
 * @version 2009-11-13 15:46:42
*/
require('../include/common.inc.php');
$page_name	= 'father.php';

//读取页数
$pagenum 	= Request('pagenum',1);

//页面记录数
$pagesize 	= 20 ;

$SqlStr	= 'SELECT COUNT( * ) FROM `'.table_pre.'father` ';

$temp_query 	= query($SqlStr);
$DB_Record = nqfetch($temp_query);

//总记录
$recordcount	= $DB_Record[0];

//显示方式
$code=Request('code','id');

//投票列表
//------------------0------1------2-------3---------4
$SqlStr	= 'SELECT `id`, `name`, `age`, `father`, `momther` from `'.table_pre.'father` ';
$SqlStr.= ' ORDER BY `'.$code.'` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$vote_list[] = array(
	'id' 		=> $DB_Record[0],
	'name'		=> $DB_Record[1],
	'age'		=> $DB_Record[2],
	'father'	=> $DB_Record[3],
	'mother'	=> $DB_Record[4],
	);
}

//管理员日志
$log_content			= '报名管理 &gt;&gt; 报名列表';
require('../../include/log.inc.php');

require($page_name.'.php');
require('../../include/debug.inc.php');
?>