<?php
/**
 * 轮显前台
 * 
 * @author Zerolone
 * @version 2009-12-2 14:41:30
 */

require('../include/common.php');
require('common.php');

define('PAGENAME','add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '轮显添加 &gt;&gt; 前台';
require('../../include/log.php');
?>