<?php
/**
 * QA分类添加、修改公共页面
 * 
 * @author Zerolone
 * @Version 2009-12-4 14:45:59
 */

$id=Request('id',0);//获取id
$title		= '';			//标题
$order	= 1;				//顺序

//获取QA分类信息
//-------------------0---------1----------2----------3------4---------5----
$SqlStr	= 'SELECT `title`, `order` FROM `' .DB_TABLE_PRE. 'qa_cate` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
}
?>