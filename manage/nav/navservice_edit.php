<?php
/**
 * 可提供服务修改页面
 * 
 * @version 2009-3-2 22:26:21
*/
require('../include/common.php');
require('navservice_common.inc.php');

$page_name	= 'navservice_add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '导航菜单管理 &gt;&gt; 可提供服务修改  &gt;&gt; 修改编号：'.$id;
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>