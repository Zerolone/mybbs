<?php
/**
* 页面功能：首页专题报道列表显示，按顺序显示
* 创建日期：2008年10月24日16:21:49
* 修改日期：
* 文 件 名：/manage/article/special.php
* 作    者：Zerolone
*/

require../include/common.php;
$page_name	= 'special.php';

//读取页数
$pagenum 	= 1;
if (isset($_GET['pagenum']))
{
	$pagenum 	= $_GET['pagenum'] ;
}

//读取显示区域
$area 	= 1;
if (isset($_GET['area']))
{
	$area 	= $_GET['area'] ;
}

//页面记录数
$pagesize 	= 20 ;

/*
计算总记录数
//如果改为读取数据库改栏目记录数则估计更快
//*/

$SqlStr	= ' SELECT COUNT( * ) FROM `'.table_pre.'article` ';
$SqlStr.= ' WHERE `area'.$area.'` =1';
$SqlStr.= ' AND `flag`=3';

$temp_query 	= query($SqlStr);
$DB_Record = nqfetch($temp_query);

//总记录
$recordcount	= $DB_Record[0];

//*/
//轮显列表
//------------------0-------1-------2--------3-------4--------5-------6-------7
$SqlStr	= ' SELECT `id`, `title`, `memo`, `order`, `html`, `reurl`, `pic1`, `pic2` from `'.table_pre.'article` ';
$SqlStr.= ' WHERE `area'.$area.'` =1';
$SqlStr.= ' AND `flag`=3';
$SqlStr.= ' ORDER BY `order` ASC ';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$article_title 	= subString($DB_Record[1],40);
	$article_memo 	= subString($DB_Record[2],60);

	$pic1		=	$pic	= $DB_Record[6];
	$pic2		= $DB_Record[7];
	if ($pic2) 
	{
		$pic	= $pic2;
	}	
	
	$url		= $DB_Record[4];
	$reurl	= $DB_Record[5];
	if ($reurl) 
	{
		$url	= $reurl;
	}	
		
	$article_list[] = array(
	'id' 	=> $DB_Record[0],
	'title'				=> $article_title,
	'memo'				=> $article_memo,
	'order' 			=> $DB_Record[3],
	'url'					=> $url,
	'pic'					=> $pic
	);
}

//管理员日志
$log_content			= '轮显管理 &gt;&gt; 轮显列表';
require('../../include/log.inc.php');

require($page_name.'.php');
require('../../include/debug.inc.php');
?>