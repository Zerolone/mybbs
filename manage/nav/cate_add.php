<?php
/**
 * 文章系统中的分类添加
 * 
 * @version 2008-9-20 8:33:07
 */
require ('../include/common.php');

require ('cate_common.inc.php');

$page_name = 'cate_add.php';

//方式
$mode = 'add';
$mode_title = ' 添 加 (Alt +Y) ';

require ($page_name . '.php');
require ('../../include/debug.php');
?>