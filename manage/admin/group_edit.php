<?php
/**
 * 用户组修改页面
 * 
 * @version 2009-3-3 14:34:44
*/

require('../include/common.php');
require('group_common.inc.php');

$page_name	= 'group_add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

require($page_name.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '管理组 &gt;&gt; 编辑前台';
require('../../include/log.php');
?>