<?php
/**
 * 相册添加页面
 * 
 * @author Zerolone
 * @version 2009-8-21 11:16:52
 */

require('../include/common.php');
require('common.php');
define('PAGENAME','add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= ' 相册 &gt;&gt; 添加前台';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>