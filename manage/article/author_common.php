<?php
/**
 * 文章作者、来源添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-12-8 15:21:47
 */

$id			=	Request('id', 0);			//获取id
$name		= Request('name');			//初始化标题
$order	= Request('order', 1);	//初始化顺序
$kind		=	Request('author', 'author');		//初始化Kind


//获取内容
//-------------------0-------1
$SqlStr	= 'SELECT `name`, `order` FROM `' .DB_TABLE_PRE. 'article_'.$kind.'` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$name			= $DB_Record[0];
	$order		= $DB_Record[1];
}
?>