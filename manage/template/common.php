<?php
/**
 * 模板添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-8-14 15:10:22
 */

//获取id
$id			=	Request('id',0);
$title	= '';		//标题
$order	= 1;		//顺序
$html		= '';		//HTML
$js			= '';		//JS
$css		= '';		//CSS

//获取模板内容
//-------------------0--------1-------2-------3-----4---------5--------6----------7-------------8---------9-------10-----11-------12
$SqlStr	= 'SELECT `title`, `order`, `html`, `js`, `css` FROM `' .DB_TABLE_PRE. 'article_template` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$html				= $DB_Record[2];
	$js					= $DB_Record[3];
	$css				= $DB_Record[4];
}
?>