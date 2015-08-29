<?php
/**
 * 类别修改页面
 * 
 * @author Zerolone
 * @version 2009-8-20 14:42:47
 */

require('../include/common.php');
require('class_common.php');

define('PAGENAME','class_add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '相册类别 &gt;&gt; 修改前台';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>