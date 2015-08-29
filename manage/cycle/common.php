<?php
/**
 * 轮显公共页面
 * 
 * @author Zerolone
 * @version 2009-12-2 14:42:39
 */

//获取id
$id=Request('id' , 0);

//初始化标题
$title		= '';

//初始化说明标题
$title_sub	= '';

//初始化图片
$pic='';

//初始化顺序
$order=1;

//初始化URL
$url='';

//获取轮显内容
//-------------------0--------1-------2-----------3----------4-------5
$SqlStr	= ' SELECT `title`, `pic`, `order`, `title_sub`, `cateid`, `url` ';
$SqlStr.= ' FROM `' .DB_TABLE_PRE. 'cycle` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title					= $DB_Record[0];
	$pic						= $DB_Record[1];
	$order					= $DB_Record[2];
	$title_sub			= $DB_Record[3];
	$cateid					= $DB_Record[4];
	$url						= $DB_Record[5];
}
?>