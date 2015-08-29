<?php
/**
 * 广告修改页面
 * 
 * @author Zerolone
 * @version 2009-11-30 22:27:51
 */

require('../include/common.php');
require('common.php');

$page_name	= 'add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

require($page_name.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '广告 &gt;&gt; 列表';
require('../../include/log.php');
?>