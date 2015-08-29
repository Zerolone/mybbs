<?php
/**
 * 文章列表显示，按栏目ID显示
 * 
 * @version 2009-8-14 10:14:55
 * @author Zerolone
 */

require('../include/common.php');
define('PAGENAME','article.php');

$cateid			= Request('cateid',0);		//读取分类
$pagenum 		= Request('pagenum',1);		//读取页数
$searchkey	=	Request('searchkey');		//搜索

$pagesize 	= 20 ;										//页面记录数

$SqlStr	= 'SELECT COUNT( * ) , `b`.`title` FROM `'.DB_TABLE_PRE.'article` `a`, `'.DB_TABLE_PRE.'article_cate` `b`';
$SqlStr.= ' WHERE 1=1 ' ;
if ($cateid<>0) {
	$SqlStr.=	' AND `a`.`cateid` ='.$cateid ;
	$SqlStr.= ' AND `a`.`cateid` = `b`.`id`';
}

if($searchkey<>''){
	$SqlStr.= ' AND `a`.`title` like \'%'. $searchkey .'%\' ' ;
}

//$SqlStr.= ' AND `a`.`flag` = '. $flag;
$SqlStr.= ' GROUP BY `b`.`title`';

$MyDatabase->SqlStr = $SqlStr;
$recordcount	= 0;	//总记录
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$recordcount	= $DB_Record[0];
}

//*/
//文章列表
//-------------------0------1---------2----------3------4------5--------6--------7------------8----------9
$SqlStr	= ' SELECT `id`, `title`, `posttime`, `flag`, `url`, `html`, `hits`, `isvideo`, `titlecolor`, `order` from `'.DB_TABLE_PRE.'article`';
$SqlStr.= ' WHERE 1=1 ';
if ($cateid<>0) {
	$SqlStr.=	' AND `cateid`='.$cateid;
}

if($searchkey<>''){
	$SqlStr.= ' AND `title` like \'%'. $searchkey .'%\' ' ;
}

//$SqlStr.= ' AND `flag` = '. $flag;
$SqlStr.= ' ORDER BY `order` ASC, `id` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$isvideo=$DB_Record[7];
		if ($isvideo) {
			$article_title = '<img height="16" src="/images/dot_video.gif" border="0">' . subString($DB_Record[1],80);	
		}else {
			$article_title = subString($DB_Record[1],82);	
		}
		
		if ($DB_Record[8]<>''){
			$article_title = '<font color="'.$DB_Record[8].'">' . subString($DB_Record[1],52) . '</font>';
		}
		
		$flag_txt					 = printFlag($DB_Record[3]);
	
		$article_list[] = array(
		'id' 	=> $DB_Record[0],
		'title'				=> $article_title,
		'posttime'		=> $DB_Record[2],
		'flag_txt' 		=> $flag_txt,
		'url'					=> $DB_Record[4],
		'html'				=> $DB_Record[5],
		'hits'				=> $DB_Record[6],
		'order'				=> $DB_Record[9],
		);
	}
}

//栏目列表
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `id`, `parentid`, `level`, `title` FROM `' .DB_TABLE_PRE. 'article_cate` Order By `level`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		if ($DB_Record[0]==$cateid){
			$selected = 'selected		= "selected"';
		}else{
			$selected		= '';
		}
	
		$cate_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> LoopNBSP(((strlen($DB_Record[2]))-2) / 2 * 3) .$DB_Record[3],
		'selected'	=> $selected
		);
	}
}

//管理员日志
$log_content			= '文章管理 &gt;&gt; 文章列表';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>