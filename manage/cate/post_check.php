<?php
/**
 * 回复帖子审核
 * 
 * @version 2010-3-19 21:36:13
 * @author Zerolone
*/
require('../include/common.php');
define('PAGE_NAME','post_check.php');

//计算未审核的帖数
$count=0;
$SqlStr='SELECT COUNT(*) as `count` FROM `'.DB_TABLE_PRE.'posts` WHERE `ifcheck`=0;';
//	DebugStr($str_Sql);
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$count = $MyDatabase->ResultArr[0]['count'];		
}

//搜索方式
$search='';

//获取当前页
$page=Request('page',1)+0;
if ($page<1) $page=1;
		
$sql='`ifcheck`=0';

//顺序
$asc = 'DESC';

//排序方式
$orderway='`tid`';
$orderway ? $w_add="orderway=$orderway&asc=$asc&" : $w_add='';
	
//分页
$numofpage=ceil($count/PAGE_PER_B);
$totlepage=$numofpage;
if ($numofpage && $page>$numofpage){
	$page=$numofpage;
}
$start_limit = ($page - 1) * PAGE_PER_B;
$limit2=' LIMIT '.$start_limit. ','.PAGE_PER_B . ';';

//分页
$pages=numofpage($count,$page,$numofpage,"topic_check.php?search=$search");

//排序
$orderway.=' '.$asc;

//显示帖子，如果需要查询， 则显示查询的帖子
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'posts` WHERE ' . $sql . ' ORDER BY ' . $orderway . $limit2;
//	DebugStr($str_Sql);
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$topics = $MyDatabase->ResultArr;		
}
			
require(PAGE_NAME.'.php');
require('../../include/debug.php');
?>