<?php
/**
 * 导航添加页面
 * 
 * @version 2009-3-2 22:25:47
*/
require('../include/common.php');
require('common.inc.php');

define('PAGENAME', 'add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= "导航菜单管理 &gt;&gt; 导航菜单添加前台";
$log_url					= PAGENAME;
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>