<?php
/**
 * 类别添加、修改公共页面
 * 
 * @author Zerolone
 * @version 2009-8-20 14:43:47
 */

$id=Request('id',0);	//获取id
$title		= '';				//标题
$order	= 1;					//顺序
$dir		= '';
$specialid=0;

//获取类别信息
//-------------------0---------1----------2---------3---------4---------5----
$SqlStr	= 'SELECT `title`, `order`, `templateid`, `dir`, `specialid` FROM `' .DB_TABLE_PRE. 'gallery_class` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title			= $DB_Record[0];
	$order			= $DB_Record[1];
	$templateid = $DB_Record[2];
	$dir				= $DB_Record[3];
	$specialid	= $DB_Record[4];
}

//模板列表
//------------------0-------1
$SqlStr	= 'Select `id`, `title` From `' .DB_TABLE_PRE. 'article_template` ';
$SqlStr.= ' ORDER BY `order` ASC';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		if ($DB_Record[0]==$templateid)	{
			$selected = 'selected		= "selected"';
		}	else	{
			$selected		= '';
		}
		
		$template_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> $DB_Record[1],
		'selected'	=> $selected
		);
		
		//文章列表对应模板
		if ($DB_Record[0]==$templateid)	{
			$cateselected = 'selected		= "selected"';
		}	else	{
			$cateselected		= '';
		}
		
		$catetemplate_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> $DB_Record[1],
		'selected'	=> $cateselected
		);
	}
}

//专题列表
//------------------0-------1
$SqlStr	= 'Select `id`, `title` From `' .DB_TABLE_PRE. 'special` ';
$SqlStr.= ' ORDER BY `order` ASC';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		if ($DB_Record[0]==$specialid)	{
			$selected = 'selected		= "selected"';
		}	else	{
			$selected		= '';
		}
		
		$special_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> $DB_Record[1],
		'selected'	=> $selected
		);
	}		
}
?>