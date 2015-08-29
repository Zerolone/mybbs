<?php
/**
 * 课程模块公共页面
 * 
 * @author Zerolone
 * @version 2009-12-7 16:01:45
 */

$id				=	Request('id' , 0);	//获取id
$parentid	=	Request('parentid' , 0);	//获取id
$title		= '';									//标题
$cycle		= '';									//课时
$pic			=	'';									//课程描述
$content	= '';									//课程内容
$homework	= '';									//课下作业
$order		=	1;									//顺序

//模块说明
if ($id>0){
	//--------------------0--------1-------2--------3----------4----------5----------6
	$SqlStr	= ' SELECT `title`, `cycle`, `pic`, `content`, `homework`, `order`, `parentid` ';
	$SqlStr.= ' FROM `' .DB_TABLE_PRE. 'class_detail` WHERE `id`= ' . $id;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$title		= $DB_Record[0];
		$cycle		= $DB_Record[1];
		$pic			= $DB_Record[2];
		$content	= $DB_Record[3];
		$homework	= $DB_Record[4];
		$order		= $DB_Record[5];
		$parentid	= $DB_Record[6];
	}
}
?>