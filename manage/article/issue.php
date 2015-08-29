<?php
/**
* 页面功能：文章全部发布，并且生成静态页面
* 创建日期：2008-9-20 8:33:07
* 修改日期：
* 文 件 名：/manage/article/add_update.php
* 作    者：Zerolone
*/

require../include/common.php;

$page_name	= '../include/refresh.php';

$refresh_msg	= '文章发布[<font color=blue>不成功</font>]，返回文章显示页面。';

//接受cateid
$cateid=0;
if (isset($_GET['cateid']))
{
	$cateid=$_GET['cateid'];
}

//生成静态页面
//每次生成100个
//-------------------0------------1-------------2--------------3-----------4-----------5
$SqlStr	= 'SELECT `a`.`title`, `a`.`title2`, `a`.`content`, `a`.`html`, `t`.`html`, `t`.`js` FROM `'.table_pre.'article` `a`, `'.table_pre.'article_template` `t`';
$SqlStr.= ' WHERE `a`.`cateid`='.$cateid;
$SqlStr.= ' AND `a`.`templateid`= `t`.`id`';
$SqlStr.= ' AND `a`.`flag`= 1';
$SqlStr.= ' LIMIT 100';

//echo $SqlStr;
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$title					= $DB_Record[0];
	$title2					= $DB_Record[1];
	$content				= addslashes($DB_Record[2]);
	$html						= $DB_Record[3];
	$template_html	= $DB_Record[4];
	$template_js		= $DB_Record[5];
	
	
	//生成一个
//	ob_flush();
	
	//获取模板地址
	$contents=file_get_contents($site_dir.$template_html);
	$contents=str_replace("{title}", 				$title, 				$contents);
	$contents=str_replace("{title2}", 			$title2, 				$contents);
	$contents=str_replace("{content}", 			$content, 			$contents);
	$contents=str_replace("{template_js}", 	$template_js, 	$contents);
	
	$handle = fopen ( $site_dir . $html, "w" );
	fwrite( $handle, $contents );
	fclose($handle);
	
	echo '['. $title . '],生成成功:地址为：<a target="_blank" href="'. $site_url . $html .'">'. $site_url . $html .'</a><br />';
	
	flush();
}

$SqlStr = 'UPDATE `'. table_pre .'article` SET flag = 2 WHERE `cateid`='. $cateid;
query($SqlStr);
$refresh_msg	= '文章发布[<font color=red>成功</font>]，返回文章显示页面。';

$refresh_url	= 'article.php?cateid='.$cateid;

require($page_name.'.php');
require('../../include/debug.inc.php');
?>