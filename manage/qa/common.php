<?php
/**
 * QA添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-12-4 14:15:43
 */

$id				= Request('id',0);				//id
$title		= '';											//标题
$order		= 1;											//顺序
$active		=	1;											//初始化使用
$color		=	'#FF0000';							//初始化背景颜色
$pagenum	=	Request('pagenum',1);		//接受pagenum
$cateid		=	Request('cateid',1);		//接受cateid
$content	= '';

//获取广告信息
//--------------------0--------1---------2-------3------------4
$SqlStr	= ' SELECT `title`, `order`, `active`, `content`, `cateid`';
$SqlStr.=' FROM `' .DB_TABLE_PRE. 'qa` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$active			= $DB_Record[2];
	$content		= $DB_Record[3];	
	$cateid			= $DB_Record[4];	
}
?>