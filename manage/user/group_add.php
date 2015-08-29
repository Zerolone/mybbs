<?php
/**
* 用户组添加页面
* 
* @version 2009-3-3 14:34:20
*/

require('../include/common.php');
require('group_common.php');
$page_name	= 'group_add.php';

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

require($page_name.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '管理组 &gt;&gt; 添加前台';
require('../../include/log.php');
?>