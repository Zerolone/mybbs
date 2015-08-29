<?php
/**
 * 友情链接添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-11-30 22:29:07
 */

$id				= Request('id',0);				//id
$title		= '';											//标题
$order		= 1;											//顺序
$url			=	'';											//初始化URL
$pic			=	'';											//初始化图片
$pagenum	=	Request('pagenum',1);		//接受pagenum

//获取友情链接信息
//--------------------0--------1-------2------3
$SqlStr	= ' SELECT `title`, `order`, `url`, `pic`';
$SqlStr.=' FROM `' .DB_TABLE_PRE. 'link` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$url				= $DB_Record[2];
	$pic				= $DB_Record[3];
}
?>