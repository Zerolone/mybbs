<?php
/**
 * 模板添加页面
 * 
 * @version 2009-9-14 13:34:55
 * @author Zerolone
 */

require('../include/common.php');
require('common.php');
$page_name	= 'template_add.php';

//方式
$mode				= 'add';
$mode_title = ' 添 加 (Alt +Y) ';

require($page_name.'.php');
require('../../include/debug.php');
?>