<?php
/**
 * QA分类修改页面
 * 
 * @author Zerolone
 * @version 2009-12-4 14:47:51
 */

require('../include/common.php');

require('cate_common.php');

define('PAGENAME','cate_add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= 'QA分类 &gt;&gt; 修改前台';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>