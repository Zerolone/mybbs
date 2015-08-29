<?php
/**
 * 用户修改页面
 * 
 * @version 2009-3-3 14:58:56
*/

require('../include/common.php');
require('common.php');

define('PAGENAME', 'add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';
$mode_note	= '不修改密码则不填写';

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '管理员 &gt;&gt; 编辑前台';
require('../../include/log.php');
?>