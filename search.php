<?php 
/**
 * 搜索帖子列表
 * 
 * @version	2010-2-21 17:14:28
 * @author		Zerolone
 * 
 */
require('include/common.php');
define('PAGENAME','search.php');

//栏目列表
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums`;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$forumArr = $MyDatabase->ResultArr;
	foreach ( $forumArr as $forums ) {
		$forum[$forums['fid']]['title']=$forums['title'];
	}
}
//DebugArr($forum);
//步骤
$authorid	= Request('authorid',0);			//发帖人编号
$step=Request('step',0);
if ($authorid>0) $step++;
if($step==0){
}else{
	$keyword	= Request('keyword');					//关键字
	$sch_time	= Request('sch_time','all');	//时间
	$s_type		= Request('s_type','all');		//搜索类型，默认为全论坛
	$f_fid		= Request('f_fid');						//搜索的栏目编号
	$sch_area	= Request('sch_area',0);			//搜索范围 0-主题标题 1-主题标题与主题内容 2-回复标题与回复内容 
	$orderway	= Request('orderway');				//排序方式
	$asc			= Request('asc', 'DESC');
	
	$sqlwhere='';
	if ($keyword=='' && $authorid==0){
		ErrorMsg('请输入关键字');
	}
	
	//关键字字数少于等于2个的时候
	$keyword  && strlen($keyword) <= 2  && ErrorMsg('关键字太少');
	
	//如果选择了搜索栏目-判断栏目是否允许搜索	
	
	//用户不存在

	//搜索
	if ($authorid){
		$sqlwhere = ' AND `authorid`='.$authorid;
	}
	
	//排序方式
	$orderway = ($orderway == '`replies`' || $orderway == '`hits`') ? $orderway : '`lastpost`';
	$orderby  = ' ORDER BY '. $orderway . $asc;
		
	//搜索限制
	
	//如果f_fid存在， 并且分类类型不为 catgory，则
	if (is_numeric($f_fid) && $s_type=='forum'){
		if ($forum[$f_fid]['type'] == 'category'){
			ErrorMsg('不能搜索分类！');
		}else {
			$sqlwhere = ' AND `fid`='.$f_fid;
		}
	}
		
	$uids=$keywhere='';
	if ($keyword){
		$keyword      = str_replace("%",'\%',$keyword);
		$keyword      = str_replace("_",'\_',$keyword);
		$keyword      = trim($keyword);		
		$sqlwhere .= ' AND `title` like \'%' . $keyword . '%\'';
	}
	if (is_numeric($sch_time) && strlen($sch_time)<10){
		$sch_time  = TIMESTAMP-$sch_time;
		$sqlwhere .= " AND postdate>'$sch_time'";
	}
	
	$limit = ' LIMIT 50;';

	$extra='';
	$schedid='';
	$SqlStr='SELECT DISTINCT tid FROM `'.DB_TABLE_PRE.'topics` WHERE 1=1 '. $sqlwhere . $orderby . $limit;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
	$sch1 = $MyDatabase->ResultArr;
		foreach ( $sch1 as $sch ) {
			if ($sch['tid']){
				$schedid .= $extra.$sch['tid'];
				$extra    = ',';
			}
		}
//		DebugStr($SqlStr);
		$total=count($sch1);
				
		$page=Request('page',1);
		$start = ($page-1)*PAGE_PER;
		$limit = ' LIMIT '. $start . ',' . PAGE_PER;
		$numofpage = ceil($total/PAGE_PER);
		if (substr($schedid,-1) == ','){
			$schedid = substr($schedid,0,-1);
		}
		$rawkeyword = rawurlencode($keyword);
		$pages = numofpage($total,$page,$numofpage,"search.php?step=$step&keyword=$rawkeyword&orderway=$orderway&s_type=$s_type&f_fid=$f_fid&sch_time=$sch_time&sch_area=$sch_area&authorid=$authorid&");
		
		$schdb = array();
		$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'topics` WHERE `tid` IN ('.$schedid.')' . $orderby . $limit;
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$sch1 = $MyDatabase->ResultArr;
			foreach ( $sch1 as $sch ) {
				$sch['titleadd']='';
				
				$keywords = explode("|",$keyword);
				foreach($keywords as $value){
					$sch['title'] = str_replace($value,"<font color='red'><u>$value</u></font>",$sch['title']);
				}

				//如果帖子被锁定级别为1
				if ($sch['lock']){
					$sch['status']="topiclock";
				} 
				
				//如果帖子回复大于10
				elseif ($sch['replies']>=10){
					$sch['status']="topichot";
					$sch['titleadd'].='<img src="images/blank.gif" class="topichot1"> ';
				}
			
				//为新帖的话
				elseif (TIMESTAMP-strtotime($sch['lastpost'])<=TIME_NEW){
					$sch['status']="topicnew";
					$sch['titleadd'].='<img src="images/blank.gif" class="topicnew1"> ';
				}
				
				//否则为默认图标
				else{
					$sch['status']="topic";
				}
					
				$sch['forumname'] = $forum[$sch['fid']]['title'];
				$sch['postdate'] = get_date($sch['postdate'],"Y-m-d");
				$sch['lastpost'] = get_date($sch['lastpost']);
				$sch['lastposterraw'] = rawurlencode($sch['lastposter']);
		
				$schdb[] = $sch;
			}
//			DebugArr($schdb);
		}else {
//			DebugStr($SqlStr);
			ErrorMsg('没有查到你需要的数据1！');
		}
	}else{
//		DebugStr($SqlStr);
		ErrorMsg('没有查到你需要的数据2');
	}
			
}
require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');
?>