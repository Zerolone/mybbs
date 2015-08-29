<?php
/**
* 页面功能：检测没有抓取内容的数据
* 创建日期：2008-9-20 8:33:07
* 修改日期：2008年9月22日10:59:13
* 文 件 名：/manage/article/unissue.php
* 作    者：Zerolone
*/

require../include/common.php;
?>
<style>*{font-size: 12px;}</style>
<?php
$cateid	= 0;
if (isset($_GET['cateid']))
{
	$cateid=$_GET['cateid'];
}
//------------------0-------1------2
$SqlStr	= 'Select `id`, `title`, `url` From `'.table_pre.'article` WHERE `cateid`='.$cateid.' AND LENGTH(`content`)<10';
$temp_query = query($SqlStr);
//echo $SqlStr.'<hr>';
while($DB_Record = nqfetch($temp_query))
{
	$id			= $DB_Record[0];
	$title	= $DB_Record[1];
	$url		= $DB_Record[2];
	echo '<a target="_blank" href="'.$url.'">[原]</a><a target="_blank" href="preview.php?id='.$id.'">'.$title.$url.'</a><br>';
}

//----------------------0----------------------1------------------2
//$SqlStr	= 'Update `'.table_pre.'page` SET `content`="" where LENGTH(`page`.`content`)<10';
//$temp_query = query($SqlStr);
?>
<a href="check_content_in.php?cateid=<?=$cateid?>">重新抓取这些未抓取数据</a>
<a href="check_content_del.php?cateid=<?=$cateid?>">删除这里这些未抓取数据</a>
