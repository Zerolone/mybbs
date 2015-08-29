<?php
/**
 * 文章添加、修改公共页面
 * 
 * @version 2009-8-13 22:08:00
 * @author Zerolone
*/

$id					=	Request('id',0);			//获取id
$level			= '00';									//level
$title			= '';										//标题
$titlecolor	= '';										//标题颜色
$title2			= '';										//标题2
$author			= '';										//作者
$from				= '';										//来源
$keyword		= '';										//关键字
$cateid			=	Request('cateid',0);	//栏目编号
$posttime		=	date("Y-m-d",time());	//提交时间
$html 			= '';										//静态页面名
$memo				=	'';										//调用文字
$pic1				=	'';										//调用图片一、二
$pic2				=	'';
$order			=	255;									//order
$reurl			=	'';										//ReUrl
$hits				=	0;										//点击率
$content		=	'';										//内容
$pagenum		=	Request('pagenum',0);	//页数
$notshowlist=	0;										//不在列表显示

//获取文章内容
//-------------------0---------1--------2------------3-----------4---------5--------6----------7-------------8-------9------10------11------12-------13------14-------15--------16------17---------18----------19--------20---------21
$SqlStr	= 'SELECT `title`, `title2`, `cateid`, `notshowlist`, `author`, `from`, `posttime`, `titlecolor`, `memo`, `pic1`, `pic2`, `html`, `order`, `reurl`, `hits`, `content` ';
$SqlStr.= ' FROM `' .DB_TABLE_PRE. 'article` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title			= $DB_Record[0];
	$title2			= $DB_Record[1];
	$cateid			= $DB_Record[2];
	$notshowlist= $DB_Record[3];
	$author			= $DB_Record[4];
	$from				= $DB_Record[5];
	$posttime		= $DB_Record[6];
	$titlecolor	=	$DB_Record[7];
	$memo				= $DB_Record[8];
	$pic1				= $DB_Record[9];
	$pic2				= $DB_Record[10];
	$html				= $DB_Record[11];
	$order			= $DB_Record[12];
	$reurl			= $DB_Record[13];
	$hits				= $DB_Record[14];
	$content		= addslashes($DB_Record[15]);
	
	$content		= str_replace(chr(10), '', $content);
	$content		= str_replace(chr(13), '', $content);	
}

//栏目列表
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `id`, `parentid`, `level`, `title` FROM `' .DB_TABLE_PRE. 'article_cate` Order By `level`;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$selected		= '';
		if ($DB_Record[0]==$cateid){
			$selected = 'selected		= "selected"';
		}
		$cate_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> LoopNBSP(((strlen($DB_Record[2]))-2) / 2 * 3) .$DB_Record[3],
		'selected'	=> $selected
		);
	}
}

//文章作者
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `name` FROM `' .DB_TABLE_PRE. 'article_author` Order By `order`;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
	$author_list[] = array(
	'name' 				=> $DB_Record[0]
	);
}
}

//文章来源
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `name` FROM `' .DB_TABLE_PRE. 'article_from` Order By `order`;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
	$from_list[] = array(
	'name' 				=> $DB_Record[0]
	);
}
}
?>