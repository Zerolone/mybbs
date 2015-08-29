<?php
/**
 * 在线咨询添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-11-30 22:29:07
 */

$id				= Request('id',0);				//id
$title		= '';											//标题
$order		= 1;											//顺序
$content	=	'';											//内容
$pagenum	=	Request('pagenum',1);		//接受pagenum

//获取在线咨询
//--------------------0--------1----------2
$SqlStr	= ' SELECT `title`, `order`, `content`';
$SqlStr.=' FROM `' .DB_TABLE_PRE. 'qq` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$content		= $DB_Record[2];	
}
?>