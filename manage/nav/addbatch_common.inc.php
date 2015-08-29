<?php
/**
 * 网址批量添加公共页面
 * 
 * @version  2009-5-6 9:48:22
 */

$title 		= '';									//标题
$order		=	1;									//顺序
$content	=	'';									//说明
$active		=	0;									//是否启用
$cateid		=	Request('cateid',0);//栏目编号
$url			= '';

//栏目列表
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `id`, `parentid`, `level`, `title` FROM `' .DB_TABLE_PRE. 'nav_cate` Order By `level`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
$DB_Record_Arr = $MyDatabase->ResultArr;
foreach ( $DB_Record_Arr as $DB_Record ) {
	if ($DB_Record [0] == $cateid) {
		$selected = 'selected		= "selected"';
	} else {
		$selected = '';
	}
	
	$group=0;
	if ($DB_Record[1]==0){
		$group = 1;
	}	
	
	$cate_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> LoopNBSP(((strlen($DB_Record[2]))-2) / 2 * 3) .$DB_Record[3],
		'selected'	=> $selected,
		'group'			=> $group,
		);
	}
}
?>