<?php
/**
 * 后台登陆检测页面
 * 
 * @author Zerolone
 * @version 2009-8-13 21:41:49
 */

$ThisPage = $_SERVER ['PHP_SELF'];
$ThePage1 = SITE_FOLDER . 'manage/login.php';
$ThePage2 = SITE_FOLDER . 'manage/logincheck.php';

//如果session不存在，则
if (!isset ( $_SESSION ['login'] )) {
	$_SESSION ['login'] = 0;
}

if ($_SESSION ['login'] != 1 && $ThisPage != $ThePage1 && $ThisPage != $ThePage2) {
	$refresh_msg = '你尚未登陆或登录超时，请重新登录。';
	$refresh_url = '../manage/login.php';	
	require ('../include/refresh.php.php');
	die ();
}
?>