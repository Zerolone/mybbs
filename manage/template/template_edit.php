<?php
/**
 * 模板修改页面
 * 
 * @author Zerolone
 * @version 2009-8-14 15:09:34
 */

require('../include/common.php');
require('common.php');

define('PAGENAME','template_add.php');

//方式
$mode				= 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

require(PAGENAME.'.php');
require('../../include/debug.php');
?>