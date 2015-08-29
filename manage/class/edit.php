<?php
/**
 * 轮显修改前台
 * 
 * @author Zerolone
 * @version 2009-12-2 15:07:42
 */

require('../include/common.php');
require('common.php');

define('PAGENAME','add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '轮显修改 &gt;&gt; 前台';
require('../../include/log.php');
?>