<?php
/**
 * 用户密码修改
 * 
 * @version 2009-8-13 12:44:12
*/

require('../include/common.php');

$page_name	= 'password.php';

require($page_name.'.php');

//管理员日志
$log_content			= '用户修改密码 &gt;&gt; 修改前台';

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>