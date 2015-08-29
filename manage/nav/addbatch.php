<?php
/**
 * 网址批量添加页面
 * 
 * @version 2009-5-9 19:48:58
*/
require('../include/common.php');
require('addbatch_common.inc.php');

$page_name	= 'addbatch.php';

//方式
$mode				= 'addbatch';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= "网址管理 &gt;&gt; 网址批量添加前台";
$log_url					= $page_name;
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>