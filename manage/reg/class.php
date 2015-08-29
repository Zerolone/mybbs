<?php
/**
 * 当前状态统计
 * 
 * @author Zerolone
 * @version 2009-12-5 17:04:29
*/
require('../include/common.php');
define('PAGENAME','class.php');

$count=0;

//---------------------0----------1------2------3------4
$SqlStr	= 'SELECT count(`class`), `class` FROM `'.DB_TABLE_PRE.'reg` ';
$SqlStr.= ' GROUP BY `class` ';
$SqlStr.= ' ORDER BY `class` ASC;';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$title=$DB_Record[1];
		
		switch ($title) {
	    case 1:
	      $title_txt='插画日常进修班';
	      break;
	    case 2:
	      $title_txt='游戏设定周末加强班';
	    	break;
	    case 3:
	    	$title_txt='青春唯美插画周末班';
	    	break;
			case 4:
	      $title_txt='原动画短期班';
				break;
			case 5:
	      $title_txt='影视动画长期班';
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
$log_content			= '报名管理 &gt;&gt; 选择的课程分析';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>