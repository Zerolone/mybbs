<?php
require('common.php');
$page_name	= 'refresh.php';

//读取分类编号， cateid
$cateid 	= 0;
if (isset($_GET['cateid']))
{
	$cateid 	= $_GET['cateid'] ;
}

$SqlStr	= 'DELETE FROM `'.table_pre.'article` WHERE `cateid`='.$cateid.' AND LENGTH(`content`)<10';
query($SqlStr);
$refresh_msg	= '删除有问题的数据完毕，请返回。';
$refresh_url	= 'article.php?cateid='.$cateid;

require($page_name.'.php');

//管理员日志
$log_content			= "文章管理 &gt;&gt; 删除未抓取数据完毕。";
require('../include/log.inc.php');
require('../include/debug.inc.php');
?>