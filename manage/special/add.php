<?php
/**
 * 专题添加页面
 * 
 * @author Zerolone
 * @version 2009-8-17 15:31:56
 */

require('../include/common.php');
require('common.php');
$page_name	= 'add.php';

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= '专题 &gt;&gt; 添加前台';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>