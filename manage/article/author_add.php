<?php
/**
 * 文章作者、来源添加页面
 * 
 * @author Zerolone
 * @version 2009-12-8 15:20:36
 */

require '../include/common.php';
require('author_common.php');
$page_name	= 'author_add.php';

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

$log_content			= '文章作者、来源前台';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>