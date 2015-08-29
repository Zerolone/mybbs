<?php
/**
 * 相关网址添加页面
 * 
 * @version 2009-3-2 22:25:47
*/
require('../include/common.php');
require('navbar_common.inc.php');

$page_name	= 'navbar_add.php';

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= "导航菜单管理 &gt;&gt; 相关网址添加前台";
$log_url					= $page_name;
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>