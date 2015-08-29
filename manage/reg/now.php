<?php
/**
 * 当前状态统计
 * 
 * @author Zerolone
 * @version 2009-12-5 17:04:29
*/
require('../include/common.php');
define('PAGENAME','now.php');

$count=0;

//---------------------0----------1------2------3------4
$SqlStr	= 'SELECT count(`now`), `now` FROM `'.DB_TABLE_PRE.'reg` ';
$SqlStr.= ' GROUP BY `now` ';
$SqlStr.= ' ORDER BY `now` ASC;';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$title=$DB_Record[1];
		
		switch ($title) {
	    case 1:
	      $title_txt='通过网站内的课程介绍已清楚了解教学内容，希望尽快报名确定座位';
	      break;
	    case 2:
	      $title_txt='通过在线咨询已了解课程详细情况，希望尽快报名确定座位';
	    	break;
	    case 3:
	    	$title_txt='想参加学习，但对自己个人能力并不了解，不能确定自己适合学习什么课程，希望得到老师的咨询帮助';
	    	break;
			case 4:
	      $title_txt='对动漫学堂的课程感兴趣，想先了解一下';
				break;
		}
		
		$now_list[] = array(
		'count' 		=> $DB_Record[0],
		'title'			=> $title_txt,
		);
		
		$count+=$DB_Record[0];

	}
}

//管理员日志
$log_content			= '报名管理 &gt;&gt; 报名当前状态分析';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>