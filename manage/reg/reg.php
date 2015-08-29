<?php
/**
 * 注册显示
 * 
 * @author Zerolone
 * @version 2009-12-5 17:04:29
*/
require('../include/common.php');
define('PAGENAME','reg.php');

//读取页数
$pagenum 	= Request('pagenum',1);

//页面记录数
$pagesize 	= 20 ;

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'reg` ';
$MyDatabase->SqlStr = $SqlStr;
$recordcount	= 0;	//总记录
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$recordcount	= $DB_Record[0];
}

//显示方式
$code=Request('code','id');

//投票列表
//------------------0------1------2------3------4
$SqlStr	= 'SELECT `id`, `name`, `age`, `sex` from `'.DB_TABLE_PRE.'reg` ';
$SqlStr.= ' ORDER BY `'.$code.'` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$sex_txt='<font color=blue>男</font>';
		if($DB_Record[3]==2) $sex_txt='<font color=red>女</font>';
		
		$reg_list[] = array(
		'id' 		=> $DB_Record[0],
		'name'	=> $DB_Record[1],
		'age'		=> $DB_Record[2],
		'sex'		=> $sex_txt,
		);
	}
}

//管理员日志
$log_content			= '报名管理 &gt;&gt; 报名列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>