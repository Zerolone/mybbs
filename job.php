<?php 
/**
 * 实现小功能的页面
 * 
 * @version	2010-5-12 21:00:43
 * @author		Zerolone
 * 
 */
require('include/common.php');

//获取操作状态
$action=Request('action');
if($action==''){
	ErrorMsg('参数错误！');
}

//调整风格
if ($action=='theme'){
	$value=Request('value');
	$reurl=Request('reurl');
	$user->setCookie('theme', $value, TIMESTAMP + 31536000);
	
	ErrorMsg('设置成功， 请返回！', $reurl);
}


?>