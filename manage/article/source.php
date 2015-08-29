<?php
/**
* 页面功能：文章系统采集列表
* 创建日期：2008-9-20 8:33:07
* 修改日期：
* 文 件 名：/manage/article/source.php
* 作    者：Zerolone
*/
require../include/common.php;

$page_name	= 'source.php';

//读取页数
$pagenum 	= 1;
if (isset($_GET['pagenum']))
{
	$pagenum 	= $_GET['pagenum'] ;
}



//页面记录数
$pagesize 	= 20 ;

//显示翻页数
$showrs			= 5;

//最大翻页数
$maxpagelimit = 50;

/*
计算总记录数
//如果改为读取数据库改栏目记录数则估计更快
//*/

$SqlStr = 'SELECT count(*) FROM `'.table_pre.'article_source`';
$temp_query 	= query($SqlStr);
$DB_Record = nqfetch($temp_query);

//总记录
$recordcount	= $DB_Record[0];

//总页数
$pagecount		= ceil($recordcount / $pagesize);
//*/

//最大移动数
$pagend	= $pagenum+$maxpagelimit;
if($pagend > $pagecount)
{
	$pagend	= $pagecount;
}

/*
显示前后分页
非空显示
为空隐藏
//*/

if (isset($_GET['pagenum']))
{
	$pagenum 	= $_GET['pagenum'] ;
	if($pagenum==1)
	{
		$pagenum_up	= 1;
	}
	else
	{
		$pagenum_up = $pagenum-1;
	}
	//		$articleid = $articleid - $pagenum*$pagesize;
}
else
{
	$pagenum 	= 1;
	$pagenum_up	= 1;
}

$pagenum_down	= $pagenum+1;
if ($pagenum > $pagecount)
{
	$pagenum_down	= $pagenum + 1;
}

//------------------0------1---------2
$SqlStr	= 'SELECT `id`, `title`, `posttime` FROM `'.table_pre.'article_source` ';
$SqlStr.= ' ORDER BY `id` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$temp_query = query($SqlStr);
$i=0;
while($DB_Record = nqfetch($temp_query))
{
	$i++;
	if($i % 2 == 0)
	{
		$trbgcolor	= "";
	}
	else
	{
		$trbgcolor	= 'bgcolor="#FFFFFF"';
	}

	$source_list[] = array(
	'id' 				=> $DB_Record[0],
	'title'			=> $DB_Record[1],
	'posttime'	=> $DB_Record[2],
	'trbgcolor'	=> $trbgcolor
	);
}

//显示前数
if ($pagenum>1)
{
	$pagenum_end = $pagenum - 1;
	if(($pagenum - $showrs)>1)
	{
		$pagenum_begin	= $pagenum - $showrs;
	}
	else
	{
		$pagenum_begin	= 1;
	}

	for($i=$pagenum_begin;$i<=$pagenum_end;$i++)
	{
		$beginlist[]= array( $i );
	}

}

//显示后面的
if($pagecount>$pagenum)
{
	$pagenum_begin	= $pagenum + 1;
	if($pagecount>($pagenum_begin + $showrs))
	{
		$pagenum_end	= $pagenum_begin + $showrs;
	}
	else
	{
		$pagenum_end	= $pagecount;
	}

	for($i=$pagenum_begin;$i<=$pagenum_end;$i++)
	{
		$endlist[]= array( $i );
	}
}

require($page_name.'.php');
require('../../include/debug.inc.php');
?>