<?php
/**
 * 广告添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-11-30 21:57:34
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';
$refresh_txt	= '失败';

$mode			= Request('mode');			//提交方式， add为添加， edit为修改
$id				= Request('id',0);			//编号
$pagenum	= Request('pagenum', 1);

$now			= Request('now');				//您现在的情况
$class		= Request('class');			//您选择的课程是
$name			= Request('name');			//昵称
$sex			= Request('sex');				//性别
$age			= Request('age');				//年龄
$job			= Request('job');				//您目前的职业身份
$art			= Request('art');				//美术教育基础
$paint		= Request('paint');			//绘画软件基础
$phone		= Request('phone');			//联系电话（用于报名答疑）：
$mail			= Request('mail');			//电子邮件（用于报名答疑）：
$qq				= Request('qq');				//QQ（用于报名答疑）：
$prov			= Request('prov');			//您现在的所在地：
$city			= Request('city');			//
$area			= Request('area');			//
$street		= Request('street');		//
$sleep		= Request('sleep');			//是否需要为您提供住宿帮助
$study		= Request('study');			//你的学习目的
$study_other = Request('study_other');			//你的学习目的
$know			= Request('know');			//您是通过什么渠道了解到动漫学堂的？：
$know_other	= Request('know_other');			//您是通过什么渠道了解到动漫学堂的？：

//处理年龄
if($age>100) $age=100;

//跳转url
$refresh_url  = 'reg.php?pagenum='.$pagenum;

$ArrField=array('now','class','name', 'sex', 'age', 'job', 'art', 'paint', 'phone', 'mail', 'qq', 'prov', 'city', 'area', 'street', 'sleep', 'study', 'study_other', 'know', 'know_other');
$ArrValue=array($now, $class, $name,  $sex,  $age,  $job,  $art,  $paint,  $phone,  $mail, $qq,   $prov,  $city, $area,    $street,  $sleep,  $study, $study_other, $know, $know_other);

if ($mode=='edit'){
	if($MyDatabase->Update('reg', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_txt = '成功';
	}
		
	$refresh_msg	= '注册用户：[<font color=red>'.$name.'</font>]，修改'.$refresh_txt.'，点击返回。';
	$log_content			= '注册用户 &gt;&gt; 修改 &gt;&gt; 【'. $name .'】'.$refresh_txt;	
}
//删除用户
elseif( $mode=='del' ){
	if($MyDatabase->Delete('reg', '`id`='.$id)){
		$refresh_txt = '成功';
	}
	
	$refresh_msg	= '注册用户删除[<font color=red>'.$refresh_txt.'</font>]，返回注册用户页面。';
	$log_content			= '注册用户 &gt;&gt; 删除 &gt;&gt; '.$refresh_txt;
}
//修改顺序
elseif( isset($_POST['s_list_order']) ){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)	{
		if($MyDatabase->Update('ad', array('order'), array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){
			$refresh_txt = '成功';
		}
	}

	$refresh_msg	= '广告顺序：[<font color=red>修改'.$refresh_txt.'</font>]，点击返回。';
	$log_content			= '广告顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;	
}

require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>