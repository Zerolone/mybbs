<?php
/**
 * 分类添加、修改公共页面
 * 
 * @version 	2009-5-5 22:38:01
 */

//编号
$id = 0;

//标题
$title = '';

//默认选定分类
$parenttitle = '为分类';
$parentid = 0;

//level
$parentlevel = '';

//level
$level = '00';

//获取编号
if (isset ( $_GET ['id'] )) {
	$id = $_GET ['id'];
}

//获取上级编号
if (isset ( $_GET ['parentid'] )) {
	$parentid = $_GET ['parentid'];
}

//当前分类
//--------------------0--------1---------2
$SqlStr = ' SELECT `title`, `level`, `parentid` FROM `' . DB_TABLE_PRE . 'nav_cate` ';
$SqlStr .= ' WHERE `id`= ' . $id;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title = $DB_Record [0];
	$level = $DB_Record [1];
	$parentid = $DB_Record [2];
}

//上级分类
//--------------------0--------1-----------2-------------3
$SqlStr = ' SELECT `title`, `level` FROM `' . DB_TABLE_PRE . 'nav_cate` ';
$SqlStr .= ' WHERE `id`= ' . $parentid;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$parenttitle = $DB_Record [0];
	$parentlevel = $DB_Record [1];
}

//级别长度
$level_len = strlen ( $parentlevel );

//级别左边
$level_left = substr ( $level, 0, $level_len - 2 );

//栏目
$SqlStr = ' Select `level` From `' . DB_TABLE_PRE . 'nav_cate` WHERE 1=1';
if ($parentlevel != '') {
	$SqlStr .= ' AND left(`level`, ' . $level_len . ') = ' . $parentlevel;
}
$SqlStr .= ' AND length(`level`) = ' . ($level_len + 2);
$SqlStr .= ' AND `level` <> ' . $level;
$SqlStr .= ' ORDER BY `level`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$level_p = $DB_Record [0];
		$the_list = substr ( $level_p, - 2, 2 );
		$level_list [$the_list] = $level_p;
	}
}

//01-99数组
for($i = 1; $i < 100; $i ++) {
	$j = $i;
	if ($i <= 9) {
		$j = '0' . $i;
	}
	$level_list_all [$j] = $parentlevel . $j;
}

if (isset ( $level_list )) {
	$level_list_new = array_diff ( $level_list_all, $level_list );
} else {
	$level_list_new = $level_list_all;
}
?>