<?php
/**
 * 专题修改页面
 * 
 * @author Zerolone
 * @version 2009-8-17 15:31:32
 */

require('../include/common.php');
require('common.php');

$page_name	= 'add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '专题 &gt;&gt; 修改前台';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>