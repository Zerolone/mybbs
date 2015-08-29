<?php
/**
* 登录后台页面
*
* @author 		Zerolone
* @version 	2009-11-30 20:16:06
*/

//公共包含文件
require('common.php');
define('PAGENAME', 'login.php');

$log_content			= "登录后台页面";

require(PAGENAME.'.php');

//管理员日志
$ThisPage='login.php';
require('../include/log.php');
?>