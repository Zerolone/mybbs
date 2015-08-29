<?php
/**
 * 分类添加、修改
 * 
 * @version 2009-5-5 22:57:34
 */

require ('../include/common.php');

$page_name = '../include/refresh.php';

$refresh_msg = '[<font color=blue>不成功</font>]，返回首页。';

$refresh_url 		= Request('refresh','cate.php');

$mode 					= Request('mode');						//提交方式， add为添加， edit为修改
$id 						= Request('id',0);						//栏目编号
$parentid 			= Request('parentid');				//上级编号
$level 					= Request('level');						//顺序+栏目级别
$title 					= Request('title');						//标题

//-----------------0---------1----------2
$ArrField=array('title',	'level',	'parentid');
$ArrValue=array($title,		$level,		$parentid);

if ($mode == 'add') {
	$MyDatabase->Insert('nav_cate',$ArrField,$ArrValue);
	
	$refresh_msg = '网址分类：[<font color=red>' . $title . '</font>]，添加成功，跳转到修改页面。';
	
	//管理员日志
	$log_content = '导航栏目 &gt;&gt; 添加 &gt;&gt; 【' . $title . '】成功';
} elseif ($mode == 'edit') {
		$MyDatabase->Update('nav_cate',$ArrField,$ArrValue,'`id`=' . $id);
		
		$refresh_msg = '导航分类：[<font color=red>' . $title . '</font>]，修改成功，跳转到修改页面。';
				
		//管理员日志
		$log_content = '导航分类 &gt;&gt; 修改 &gt;&gt; 【' . $title . '】成功';
} elseif ($mode == "edit_title") {
	$MyDatabase->Update('nav_cate',array('title'),array($title),'`id`=' . $id);
	
	$refresh_msg = '导航栏目：[<font color=red>' . $title . '</font>]，修改成功，跳转到修改页面。';
	
	//管理员日志
	$log_content = '导航栏目 &gt;&gt; 修改 &gt;&gt; 【' . $title . '】成功';
	
	$refresh_url = 'cate.php#' . $id;
} elseif ($mode == "del") {
	//文档信息
	//------------------0---------1----------2--------3
	$SqlStr = 'Select `title`, `level` From `' . DB_TABLE_PRE . 'nav_cate` WHERE `id`= ' . $id;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			$title = $DB_Record [0];
			$level = $DB_Record [1];
		}
	}
	
	//level长度
	$level_len = strlen ( $level );
	
	//echo $level_len;
	//exit();
	//删除当前编号记录
	$MyDatabase->Delete('nav_cate','`id`=' . $id);
	
	//删除当前编号记录下面的记录
	$MyDatabase->Delete('nav_cate','left(`level`, ' . $level_len . ') = ' . $level);
	
	$refresh_msg = '导航栏目删除成功，跳转到修改页面。';
	
	//管理员日志
	$log_content = '导航栏目删除成功';
} elseif ($mode == "unite") {
	$cate1 = $_POST ['cate1'];
	$cate2 = $_POST ['cate2'];
	
	$MyDatabase->Update('article',array('cateid'),array($cate2),'`cateid`=' . $cate1);
	
	$refresh_msg = '导航分类：[<font color=red>合并</font>]成功，跳转到合并后的页面。';
	
	$refresh_url = 'cate_unite.php';
	
	//管理员日志
	$log_content = '导航栏目 &gt;&gt; 合并 &gt;&gt; 成功';
} //生成静态

require ($page_name . '.php');
require ('../../include/debug.php');
?>