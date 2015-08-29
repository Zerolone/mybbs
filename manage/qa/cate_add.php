<?php
/**
 * 轮显分类添加页面
 * 
 * @author Zerolone
 * @version 2009-12-4 14:44:51
 */
require('../include/common.php');
require('cate_common.php');

define('PAGENAME','cate_add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//管理员日志
$log_content			= 'QA分类 &gt;&gt; 添加前台';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>