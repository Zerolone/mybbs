<?php
/**
 * 导航列表页面
 * 
 * @version 2009-3-2 21:54:23
*/
require('../include/common.php');

$page_name	= 'navorder.php';

//读取页数
$pagenum 	= Request('pagenum', 1);

//页面记录数
$pagesize 	= Request('pagesize',16);
$pagesize=round($pagesize);
if ($pagesize<=2){
	$pagesize=10;
}

//总记录
$recordcount	= 0;

//排序用的
$sort_id='';

//分类编号
$cateid=Request('cateid',1);

$SqlstrWhere='';
$SqlstrWhere.= ' WHERE `cid`='.$cateid;
$SqlstrWhere.= ' AND `userid`='.$userid;

$SqlStr = 'Select count(*) from `'.DB_TABLE_PRE.'view_nav`';
$SqlStr.=$SqlstrWhere;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0][0];
}

//------------------0------1--------2---------3----------4-------5-------6
$SqlStr	= 'SELECT `id`, `title`, `lorder`, `content`, `active`, `url`, `level` FROM `'.DB_TABLE_PRE.'view_nav`';
$SqlStr.=$SqlstrWhere;
$SqlStr.= ' ORDER BY `lorder` ASC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
//echo $SqlStr;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	//顺序循环变量
	$i=$pagesize*($pagenum-1)+1;
	
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$navbar_title 			= subString($DB_Record[1],34);
		$navbar_content			= subString($DB_Record[3],60);
		
		$navbar_active_txt	= '显示';
		if($DB_Record[4]=='0')	$navbar_active_txt	= '不显';
		
		$navbar_level_txt	= '显示';
		if($DB_Record[6]=='0')	$navbar_level_txt	= '不显';
		
		$url								= $DB_Record[5];
		if ($url==''){
			$url='&nbsp;';
		}
		$navbar_list[] = array(
		'id' 					=> $DB_Record[0],
		'title'				=> $navbar_title,
		'order'				=> $i++,
		'content'			=> $navbar_content,
		'active_txt'	=> $navbar_active_txt,
		'level_txt'		=> $navbar_level_txt,
		'url' 				=> $url,
		);
		
		$sort_id.= $DB_Record[0].'|';
	}
}

//栏目列表
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `id`, `parentid`, `level`, `title` FROM `' .DB_TABLE_PRE. 'nav_cate` Order By `level`';
$MyDatabase->SqlStr=$SqlStr;
$MyDatabase->Query();
$DB_Record_Arr=$MyDatabase->ResultArr;			
	
foreach ($DB_Record_Arr as $DB_Record){
	if ($DB_Record[0]==$cateid){
		$selected = 'selected		= "selected"';
	}else{
		$selected		= '';
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

//管理员日志
$log_content			= '网站管理 &gt;&gt; 网站首页显示顺序';
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>