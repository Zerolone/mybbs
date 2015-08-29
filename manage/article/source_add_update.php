<?php
/**
* 页面功能：采集添加提交页面
* 创建日期：2008年9月24日16:49:04
* 修改日期：
* 文 件 名：/manage/article/source_add_update.php
* 作    者：Zerolone
*/

require../include/common.php;

$page_name	= '../include/refresh.php';

$title			= $_POST['title'];

$SqlL = 'insert into `'.table_pre.'article_source` (';
$SqlR = 'values (';

//标题
$SqlL .= 'title,';
$SqlR .= '\'' . $title . '\',';

//提交时间
$SqlL .= "posttime)";
$SqlR .= '\'' . date("Y-m-d",time()) . '\')';

query($SqlL.$SqlR);

$id=0;
$SqlStr = 'SELECT `id` FROM `'.table_pre.'article_source` WHERE `title`=\''.$title.'\'';
$temp_query = query($SqlStr);
while($DB_Record = nqfetch($temp_query))
{
	$id=$DB_Record[0];
}

$refresh_msg	= '文章采集规则：['.$title.']，添加成功，进入修改页面。';
$refresh_url	= 'source_edit.php?id='.$id;

require($page_name.'.php');
require('../../include/debug.inc.php');
?>