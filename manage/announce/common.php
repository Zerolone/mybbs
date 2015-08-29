<?php
/**
 * 公告添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2010-3-16 9:40:25
 */

$id				= Request('id',0);				//id
$title		= '';											//标题
$order		= 1;											//顺序
$pagenum	=	Request('pagenum',1);		//接受pagenum
$level		= 0;
$content	='';

//获取公告信息
$SqlStr	= ' SELECT * FROM `' .DB_TABLE_PRE. 'announce` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title			= $DB_Record['title'];
	$order			= $DB_Record['order'];
	$level				= $DB_Record['level'];
	$content		= $DB_Record['content'];
}
?>