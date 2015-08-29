<?php
/**
 * 文章系统中的分类修改
 * 
 * @author Zerolone
 * @version 2009-8-17 10:25:09
 */
require('../include/common.php');

require('cate_common.php');

define('PAGENAME','cate_add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

require(PAGENAME.'.php');
require('../../include/debug.php');
?>