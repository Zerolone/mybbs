<?php
/**
 * 课程公共页面
 * 
 * @author Zerolone
 * @version 2009-12-7 16:01:45
 */

$id			=	Request('id' , 0);	//获取id
$title	= '';									//标题
$cycle	= '';									//周期
$soft		=	'';									//学习软件
$pic1		= '';									//图片1-3
$pic2		= '';
$pic3		= '';
$teacher=	'';									//主讲老师
$study	=	'';									//学习目标
$intro	= '';									//课程介绍
$object	= '';									//招生对象
$works1	= '';									//作品1-2
$works2	= '';
$works1s= '';									//作品s1-2
$works2s= '';
$order	=	1;									//顺序
$articleid	= 0;

//获取轮显内容
if ($id>0){
	//--------------------0--------1-------2-------3-------4-------5---------6---------7-------8----------9--------10-------11--------12---------13---------14
	$SqlStr	= ' SELECT `title`, `cycle`, `soft`, `pic1`, `pic2`, `pic3`, `teacher`, `study`, `intro`, `object`, `works1`, `works2`, `order`, `works1s`, `works2s`, `articleid` ';
	$SqlStr.= ' FROM `' .DB_TABLE_PRE. 'class` WHERE `id`= ' . $id;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$title		= $DB_Record[0];
		$cycle		= $DB_Record[1];
		$soft			= $DB_Record[2];
		$pic1			= $DB_Record[3];
		$pic2			= $DB_Record[4];
		$pic3			= $DB_Record[5];
		$teacher	= $DB_Record[6];
		$study		= $DB_Record[7];
		$intro		= $DB_Record[8];
		$object		= $DB_Record[9];
		$works1		= $DB_Record[10];
		$works2		= $DB_Record[11];
		$order		= $DB_Record[12];
		$works1s	= $DB_Record[13];
		$works2s	= $DB_Record[14];
		$articleid= $DB_Record[15];
	}
}
?>