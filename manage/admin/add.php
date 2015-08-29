<?php
/**
 * 用户添加页面
 * 
 * @version 2009-3-3 14:58:27
 * @author Zerolone
*/

require('../include/common.php');
require('common.inc.php');
define('PAGENAME', 'add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '管理员 &gt;&gt; 添加前台';
require('../../include/log.php');
?>