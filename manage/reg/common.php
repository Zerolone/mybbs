<?php
/**
 * Reg添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-12-5 20:19:24
 */

$id				= Request('id',0);				//id
$pagenum	= Request('pagenum', 1);

//------------------0------1------2-------3
$SqlStr	= 'SELECT * from `'.DB_TABLE_PRE.'reg` WHERE `id`='.$id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$now			= $DB_Record['now'];				//您现在的情况
	$class		= $DB_Record['class'];			//您选择的课程是
	$name			= $DB_Record['name'];			//昵称
	$sex			= $DB_Record['sex'];				//性别
	$age			= $DB_Record['age'];				//年龄
	$job			= $DB_Record['job'];				//您目前的职业身份
	$art			= $DB_Record['art'];				//美术教育基础
	$paint		= $DB_Record['paint'];			//绘画软件基础
	$phone		= $DB_Record['phone'];			//联系电话（用于报名答疑）：
	$mail			= $DB_Record['mail'];			//电子邮件（用于报名答疑）：
	$qq				= $DB_Record['qq'];				//QQ（用于报名答疑）：
	$prov			= $DB_Record['prov'];			//您现在的所在地：
	$city			= $DB_Record['city'];			//
	$area			= $DB_Record['area'];			//
	$street		= $DB_Record['street'];		//
	$sleep		= $DB_Record['sleep'];			//是否需要为您提供住宿帮助
	$study		= $DB_Record['study'];			//你的学习目的
	$study_other = $DB_Record['study_other'];			//你的学习目的
	$know			= $DB_Record['know'];			//您是通过什么渠道了解到动漫学堂的？：
	$know_other	= $DB_Record['know_other'];			//您是通过什么渠道了解到动漫学堂的？：
}
?>