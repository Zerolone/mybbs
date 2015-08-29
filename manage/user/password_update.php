<?php
/**
 * 用户密码修改后台
 * 
 * @version 2009-5-9 23:55:05
 * @author Zerolone
*/

require('../include/common.php');

$page_name	= '../../include/refresh.php';
$refresh_url	= 'password.php';

$password1	= MD5($_POST['password1']);

$userid=$_SESSION['userid'];

if ($MyDatabase->Update('admin',array('pass'),array($password1),'`id`=' . $userid)){
	$refresh_msg	= '密码修改成功。';
	
	$log_content			= '用户修改密码 &gt;&gt; 修改成功';
}else {
	$refresh_msg	= '密码修改失败。';
	
	$log_content			= '用户修改密码 &gt;&gt; 修改成功';
}

echo $MyDatabase->SqlStr;
require($page_name.'.php');

require('../../include/log.php');

require('../../include/debug.php');
?>