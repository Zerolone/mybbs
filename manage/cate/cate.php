<?php
/**
 * 栏目查看
 * 
 * @version 2010-3-15 20:22:37
 * @author Zerolone
*/
require('../include/common.php');
define('PAGE_NAME','cate.php');

$SqlStr	= 'SELECT * FROM `' .DB_TABLE_PRE. 'forums`';
$SqlStr.= ' ORDER BY `level` ASC;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$forums = $MyDatabase->ResultArr;
}	
require(PAGE_NAME.'.php');
require('../../include/debug.php');
?>