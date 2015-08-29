<?php
/**
* 页面功能：广告修改页面
* 创建日期：2008年10月2日10:36:10
* 修改日期：
* 文 件 名：/manage/ad/edit.php
* 作    者：Zerolone
*/

require../include/common.php;
require('common.inc.php');

$page_name	= 'add.php';

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

//管理员日志
$log_content			= '广告 &gt;&gt; 修改前台';
require('../../include/log.inc.php');

require($page_name.'.php');
require('../../include/debug.inc.php');
?>