<?php
/**
 * 文章分类添加、修改公共页面
 * 
 * @version 2009-8-14 9:44:15
 * @author  Zerolone
*/

$id							= Request('id', 0);				//获取编号
$title 					= '';											//标题
$parenttitle 		= '为分类';								//默认选定分类
$parentid				= Request('parentid', 0);	//默认选定分类Id
$templateid			= 0;											//模板编号
$parentlevel		= '';											//上级level
$level					= '00';										//level
$forumid				=	0;											//论坛编号
$catetemplateid	=	0;											//分类对应模板
$dir						=	'';											//分类对应目录
$kind						=	0;											//文章列表方式
$pagesize				=	20;											//文章显示条数
$specialid			= 0;											//文章对应专题编号
$url						= '';

//当前分类
//--------------------0--------1-----------2------------3----------4-------------5------------6------7---------8-------------9-------10
$SqlStr	= ' SELECT `title`, `level`, `templateid`, `parentid`, `forumid`, `catetemplateid`, `dir`, `kind`, `pagesize`, `specialid`, `url` FROM `' .DB_TABLE_PRE. 'article_cate` ';
$SqlStr.= ' WHERE `id`= ' . $id;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title					= $DB_Record[0];
	$level					= $DB_Record[1];
	$templateid			= $DB_Record[2];
	$parentid				= $DB_Record[3];
	$forumid				= $DB_Record[4];
	$catetemplateid	= $DB_Record[5];
	$dir						= $DB_Record[6];
	$kind						= $DB_Record[7];
	$pagesize				= $DB_Record[8];
	$specialid			= $DB_Record[9];
	$url						= $DB_Record[10];
}

//上级分类
//--------------------0--------1-----------2-------------3
$SqlStr	= ' SELECT `title`, `level` FROM `' .DB_TABLE_PRE. 'article_cate` ';
$SqlStr.= ' WHERE `id`= ' . $parentid;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$parenttitle		= $DB_Record[0];
	$parentlevel		= $DB_Record[1];
}

//级别长度
$level_len	= strlen($parentlevel);

//级别左边
$level_left = substr($level, 0,$level_len-2);

//栏目
$SqlStr	= ' Select `level` From `' .DB_TABLE_PRE. 'article_cate` WHERE 1=1';
if ($parentlevel<>'') {
	$SqlStr.= ' AND left(`level`, '.$level_len.') = '. $parentlevel ;
}
$SqlStr.= ' AND length(`level`) = '.($level_len+2);
$SqlStr.= ' AND `level` <> '.$level;
$SqlStr.= ' ORDER BY `level`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$level_p	= $DB_Record[0];
		$the_list	= substr($level_p, -2, 2);
		$level_list[$the_list] = $level_p;
	}
}

//01-99数组
for ($i=1;$i<100;$i++){
	$j=$i;
	if ($i<=9){
		$j = '0' . $i;
	}
	$level_list_all[$j] = $parentlevel . $j;
}

if (isset($level_list)){
	$level_list_new = array_diff($level_list_all, $level_list);
}else{
	$level_list_new = $level_list_all;
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
		if ($DB_Record[0]==$catetemplateid)	{
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