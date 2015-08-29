<?php
/**
 * 相关网址添加、修改公共页面
 * 
 * @version  2009-3-2 21:52:49
 */

//接受id， 修改用
$id = Request('id',0);

$pid= Request('pid',1);

//标题
$title = '';

//顺序
$order=1;

//url
$url='';

$active=0;

//-------------------0--------1-------2-------3
$SqlStr = 'Select `title`, `order`, `url`, `active` From `' . DB_TABLE_PRE . 'navservice` WHERE `id`= ' . $id;
$SqlStr.= ' AND `pid`='.$pid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$title 		= $DB_Record [0];
	$order 		= $DB_Record [1];
	$url 			= $DB_Record [2];
	$active		= $DB_Record [3];
}
?>