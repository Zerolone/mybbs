<?php
/**
 * 广告添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-11-30 22:29:07
 */

$id				= Request('id',0);				//id
$title		= '';											//标题
$order		= 1;											//顺序
$active		=	1;											//初始化使用
$url			=	'';											//初始化URL
$color		=	'#FF0000';							//初始化背景颜色
$pic			=	'';											//初始化图片
$pagenum	=	Request('pagenum',1);		//接受pagenum
$height		= 0;
$width		= 0;

//获取广告信息
//--------------------0--------1---------2-------3------4-------5--------6-------7--------8-------9---------10
$SqlStr	= ' SELECT `title`, `order`, `active`, `url`, `pic`, `height`,`width`,`color`';
$SqlStr.=' FROM `' .DB_TABLE_PRE. 'ad` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$active			= $DB_Record[2];
	$url				= $DB_Record[3];
	$pic				= $DB_Record[4];
	$height			= $DB_Record[5];
	$width			= $DB_Record[6];
	$color			= $DB_Record[7];	
}
?>