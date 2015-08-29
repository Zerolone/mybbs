<?php
/**
 * 专题下面的模块列表显示
 * 
 * @author Zerolone
 * @version 2009-8-17 17:11:21
*/
require('../include/common.php');
define('PAGENAME','module.php');

$pagenum = Request ( 'pagenum', 1 ); 		//页数
$parentid = Request ( 'parentid', 0 ); 	//parentid
$pagesize = 20; 												//页面记录数
$recordcount = 0;												//总记录

$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'special_module`';
$SqlStr.= ' WHERE `parentid`='.$parentid;
$MyDatabase->SqlStr = $SqlStr;

if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$recordcount	= $DB_Record[0];
}
//专题列表
//------------------0------1---------2-------3------4
$SqlStr	= 'SELECT `id`, `title`, `order`, `kind` from `'.DB_TABLE_PRE.'special_module`';
$SqlStr.= ' WHERE `parentid`='.$parentid;
$SqlStr.= ' ORDER BY `order` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$kind=$DB_Record[3];
		
		switch ( $kind ){
			case 'kind1':
				$kind_text= "图文列表";
				break;
			case 'kind2':
				$kind_text= "视频播放";
				break;
			case 'kind3':
				$kind_text= "单调文章";
				break;
			case 'kind4':
				$kind_text= "投票";
				break;
			case 'kind5':
				$kind_text= "留言板";
				break;
			case 'kind6':
				$kind_text= "轮显";
				break;
		}	
		
		$module_list[] = array(
		'id' 							=> $DB_Record[0],
		'title'						=> $DB_Record[1],
		'order'						=> $DB_Record[2],
		'kind_text'				=> $kind_text
		);
	}
}

//管理员日志
$log_content			= '专题 &gt;&gt; 模块 &gt;&gt; 列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>