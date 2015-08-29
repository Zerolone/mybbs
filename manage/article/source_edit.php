<?php
/**
* 页面功能：文章系统采集列表修改页面
* 创建日期：2008-9-20 8:33:07
* 修改日期：
* 文 件 名：/manage/article/source_edit.php
* 作    者：Zerolone
*/
require../include/common.php;

$page_name	= 'source_edit.php';

//接受id， 修改用
$id=0;
if (isset($_GET['id']))
{
	$id=$_GET['id'];
}

//信息
//------------------0--------1------2--------3-------4----------5----------6----------7---------------8-----------9-----------10----------11-------------------12---------------13----------4
$SqlStr	= 'Select `title`, `url`, `url1`, `url2`, `urlext`, `urlfill`, `cateid`, `flagadstart`, `flagadend`, `flagstart`, `flagend`, `flagcontentstart`, `flagcontentend`, `flagsingle`, `utf8` From `' .table_pre. 'article_source` WHERE `id`= ' . $id;
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$title						= $DB_Record[0];
	$url 							= $DB_Record[1];
	$url1							= $DB_Record[2];
	$url2							= $DB_Record[3];
	$urlext						= $DB_Record[4];
	$urlfill					= $DB_Record[5];
	$cateid						= $DB_Record[6];
	$flagadstart			= DeCodeStr($DB_Record[7]);
	$flagadend				= DeCodeStr($DB_Record[8]);
	$flagstart				= DeCodeStr($DB_Record[9]);
	$flagend					= DeCodeStr($DB_Record[10]);
	$flagcontentstart	= DeCodeStr($DB_Record[11]);
	$flagcontentend		= DeCodeStr($DB_Record[12]);
	$flagsingle				= DeCodeStr($DB_Record[13]);
	$utf8							= $DB_Record[14];
}

//栏目列表
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `id`, `parentid`, `level`, `title` FROM `' .table_pre. 'article_cate` Order By `level`';

$temp_query = query($SqlStr);

while($DB_Record = nqfetch($temp_query))
{
	if ($DB_Record[0]==$cateid)
	{
		$selected = 'selected		= "selected"';
	}
	else
	{
		$selected		= '';
	}

	$menu_list[] = array(
	'id' 				=> $DB_Record[0],
	'title'			=> LoopNBSP(((strlen($DB_Record[2]))-2) / 2 * 3) .$DB_Record[3],
	'selected'	=> $selected
	);
}

$flagadstartarray	=	explode(",", $flagadstart );
$flagadendarray		=	explode(",", $flagadend );

$flagsinglearray		=	explode(",", $flagsingle );

require($page_name.'.php');
require('../../include/debug.inc.php');
?>