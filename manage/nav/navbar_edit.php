<?php
/**
 * 相关网址修改页面
 * 
 * @version 2009-3-2 22:26:21
*/
require('../include/common.php');
require('navbar_common.inc.php');

$page_name	= 'navbar_add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '导航菜单管理 &gt;&gt; 相关网址修改  &gt;&gt; 修改编号：'.$id;
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>