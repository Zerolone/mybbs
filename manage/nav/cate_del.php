<?php
require('common.inc.php');
$page_name	= 'cate_del.php';

//接受id， 修改用
$id=0;
if (isset($_GET['id']))
{
	$id=$_GET['id'];
}

$title = '';

//文档信息
//------------------0---------1----------2--------3
$SqlStr	= 'Select `title`, `level`, `parentid` From `' .table_pre. 'article_cate` WHERE `id`= ' . $id;
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$title		= $DB_Record[0];
	$level		= $DB_Record[1];
	$parentid	= $DB_Record[2];
}

//获取所属信息
if ($parentid==0)
{
	$catetitle	= '为分类';
}
else
{
	//------------------0---------1----------2--------3
	$SqlStr	= 'Select `title` From `' .table_pre. 'article_cate` WHERE `id`= ' . $parentid;
	$temp_query = query($SqlStr);
	while($DB_Record = nqfetch($temp_query))
	{
		$catetitle	= $DB_Record[0];
	}
}

require($page_name.'.php');
require('../include/debug.inc.php');
?>