<?php
/**
 * 文章预览，接受参数为ID
 * 
 * @author Zerolone
 * @version 2009-11-30 21:25:08
 */

require('../include/common.php');
define('PAGENAME','preview.php');

$id	= $_GET["id"];
$SqlStr = 'SELECT `title`, `url`, `content` FROM `'.DB_TABLE_PRE.'article` WHERE `id`='.$id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];

	$title=$DB_Record[0];
	$url=$DB_Record[1];
	$content=encode2($DB_Record[2]);
}

//管理员日志
$log_content			= '文章管理 &gt;&gt; 文章预览';
require('../../include/log.php');

require(PAGENAME.'.php');
require('../../include/debug.php');
?>