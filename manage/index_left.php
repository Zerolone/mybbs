<?php
/**
 * 后台左侧菜单
 * 
 * @author Zerolone
 * @version 2009-11-30 20:29:05
 */

require('common.php');

define('PAGENAME', 'index_left.php');

if ($_SESSION['login']!=1) {
	echo '你没有登陆，请返回。';
	exit();
}

require(PAGENAME.'.php');
//SHOW_DEBUG = 0;

//管理员日志
$log_content			= '左侧菜单';
$ThisPage='index_left.php';
require('../include/log.php');
?>