<?php
/**
 * 专题添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-8-17 15:33:09
 */

$id=Request('id',0);//获取id
$title			= '';		//标题
$order			= 1;		//顺序
$templateid	=	0;		//模板编号
$html				=	'';		//静态页面名
$pic				=	'';		//图片地址
$memo				= '';		//说明
$url1				= '';		//地址1-5
$url2				= '';
$url3				= '';
$url4				= '';
$url5				= '';

//获取专题信息
//-------------------0---------1----------2----------3------4------5-------6-------7--------8--------9-----10
$SqlStr	= 'SELECT `title`, `order`, `templateid`, `html`, `pic`, `memo`, `url1`, `url2`, `url3`, `url4`, `url5` FROM `' .DB_TABLE_PRE. 'special` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$templateid	= $DB_Record[2];
	$html				= $DB_Record[3];
	$pic				= $DB_Record[4];
	$memo				= $DB_Record[5];
	$url1				= $DB_Record[6];
	$url2				= $DB_Record[7];
	$url3				= $DB_Record[8];
	$url4				= $DB_Record[9];
	$url5				= $DB_Record[10];
}

//专题所属模板
//------------------0------1
$SqlStr	= 'SELECT `id`, `title` FROM `' .DB_TABLE_PRE. 'article_template` Order By `order`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$selected		= '';
		if ($DB_Record[0]==$templateid){
			$selected = 'selected		= "selected"';
		}
		
		$template_list[] = array(
		'selected' 		=> $selected,
		'id' 					=> $DB_Record[0],
		'title' 			=> $DB_Record[1]
		);
	}
}
?>