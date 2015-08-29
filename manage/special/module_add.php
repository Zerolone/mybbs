<?php
/**
 * 模块添加页面
 * 
 * @version 2009-9-11 13:34:01
 * @author Zerolone
 */

require('../include/common.php');
require('module_common.php');
$page_name	= 'module_add.php';

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= '模块 &gt;&gt; 添加前台';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>