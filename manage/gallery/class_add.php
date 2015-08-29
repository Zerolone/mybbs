<?php
/**
 * 类别添加页面
 * 
 * @author Zerolone
 * @Version 2009-8-20 14:54:21
 */

require('../include/common.php');
require('class_common.php');
define('PAGENAME','class_add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= '相册类别 &gt;&gt; 添加前台';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>