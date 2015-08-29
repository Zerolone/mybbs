<?php
/**
 * 后台主文件
 * 
 * @author Zerolone
 * @version 2009-11-30 20:20:10
 */
require('common.php');
define('PAGENAME', 'index.php');

$log_content			= "index.php";

require(PAGENAME.'.php');

//管理员日志
$ThisPage='login.php';
require('../include/log.php');
?>