<?php
require('common.inc.php');
$page_name	= 'refresh.php';

//接受编号,id
$id=0;
if (isset($_POST['id']))
{
	$id=$_POST['id'];
}

//文档信息
//------------------0---------1----------2--------3
$SqlStr	= 'Select `title`, `level` From `' .table_pre. 'article_cate` WHERE `id`= ' . $id;
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$title	= $DB_Record[0];
	$level	= $DB_Record[1];
}

//level长度
$level_len	= strlen($level);

//echo $level_len;
//exit();
//删除当前编号记录
$SqlStr = 'DELETE FROM `'.table_pre.'article_cate` WHERE `id`='.$id;
query($SqlStr);

//删除当前编号记录下面的记录
$SqlStr = 'DELETE FROM `'.table_pre.'article_cate` WHERE left(`level`, '.$level_len.') = '. $level ;
query($SqlStr);

//删除所有属于该类的文章
//$SqlStr = 'DELETE FROM '.table_pre.'menu WHERE left(`level`, '.$level_len.') = '. $level ;
//query($SqlStr);

$refresh_msg	= $title.',删除成功';
$refresh_url	= 'cate.php';

require($page_name.'.php');
require('../include/debug.inc.php');
?>