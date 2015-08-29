<?php
/**
 * 文章添加页面
 * 
 * @author Zerolone
 * @version 2009-8-13 22:07:02
 */

require('../include/common.php');
require('common.php');
define('PAGENAME', 'add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

//
$html				= '';
$pic1				= '';
$pic2				= '';
$title2			= '';

require(PAGENAME.'.php');
require('../../include/debug.php');
?>