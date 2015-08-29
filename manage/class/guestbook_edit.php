<?php
/**
 * 留言修改页面
 * 
 * @author Zerolone
 * @version 2009-12-8 11:45:19
 */

require('../include/common.php');
require('guestbook_common.php');

$page_name	= 'guestbook_add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '留言 &gt;&gt; 修改';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>