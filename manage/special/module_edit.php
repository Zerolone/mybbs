<?php
/**
 * 模块修改页面
 * 
 * @author Zerolone
 * @version 2009-8-17 17:15:49
 */

require('../include/common.php');
require('module_common.php');

define('PAGENAME','module_add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '模块 &gt;&gt; 修改前台';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>