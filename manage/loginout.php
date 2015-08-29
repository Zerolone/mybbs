<?php
/**
 * 退出登录
 * 
 * @author Zerolone
 * @version 2009-8-13 21:29:41
*/

require 'common.php';
define('PAGENAME', '../include/refresh.php');

session_unregister('user');
session_unregister('userid');
session_unregister('permission');
session_unregister('login');

$refresh_msg	= '退出成功';
$refresh_url	= 'index.php';

require(PAGENAME.'.php');

//管理员日志
$log_content			= $refresh_msg;
require('../include/log.php');
?>