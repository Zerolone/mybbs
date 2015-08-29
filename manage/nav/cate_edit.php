<?php
/**
 * 文章系统中的分类修改
 * 
 * @version 		2008年9月24日17:46:03
 */
require ('../include/common.php');

require ('cate_common.inc.php');

$page_name = 'cate_add.php';

//方式
$mode = 'edit';
$mode_title = ' 修 改 (Alt +Y) ';

require ($page_name . '.php');
require ('../../include/debug.php');
?>