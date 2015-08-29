<?php
/**
 * 文章系统中的分类添加
 * 
 * @author Zerolone
 * @version 2009-8-14 9:43:05
 */
require('../include/common.php');

require('cate_common.php');

define('PAGENAME','cate_add.php');

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

require(PAGENAME.'.php');
require('../../include/debug.php');
?>