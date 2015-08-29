<?php
/**
 * 留言簿修改公共页面
 * 
 * @author Zerolone
 * @version 2009-12-4 21:24:04
 */

$id				= Request('id',0);				//id
$name			= '';											//标题
$order		= 1;											//顺序
$active		=	1;											//使用
$homepage	=	'';											//主页
$mail			=	'';											//邮箱
$pagenum	=	Request('pagenum',1);		//接受pagenum
$content	= '';
$recontent	= '';

//获取留言簿信息
//--------------------0-------1---------2---------3---------4---------5-----------6
$SqlStr	= ' SELECT `name`, `order`, `active`, `homepage`, `mail`, `content`, `recontent`';
$SqlStr.=' FROM `' .DB_TABLE_PRE. 'guestbook` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$name				= $DB_Record[0];
	$order			= $DB_Record[1];
	$active			= $DB_Record[2];
	$homepage		= $DB_Record[3];	
	$mail				= $DB_Record[4];	
	$content		= $DB_Record[5];	
	$recontent	= $DB_Record[6];	
}
?>