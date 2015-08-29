<?php 
/**
 * 主题列表
 * 
 * @version	2010-3-17 17:33:09
 * @author		Zerolone
 * 
 */
require('include/common.php');
define('PAGENAME','topic.php');

//有无置置顶，或者公告
$ifsort=0;

//获取栏目编号
$fid=Request('fid');

//获取版块内容， 包括了版块公告
$SqlStr ='SELECT * FROM `'. DB_TABLE_PRE .'view_forum`';
$SqlStr.='WHERE `fid` =' . $fid;
$MyDatabase->SqlStr= $SqlStr;
if ($MyDatabase->Query ()) {
	$foruminfo = $MyDatabase->ResultArr[0];
	$forumtitle=$foruminfo['title'] . ' &gt;&gt; ';
	
	if (strlen($foruminfo['level'])==2){
		//版块为分类的话， 显示下级的栏目名
		ErrorMsg('当前栏目为分类，请返回。');
	}
}else{
	ErrorMsg($SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：获取版块数据错误！');
}

//判断板块访问权限
$allowvisit=explode(',',$foruminfo['allowvisit']);
if (!in_array($user->groupid, $allowvisit)){
	ErrorMsg('你没有访问该栏目的权限！', BBS_INDEX);
}

//板块发帖权限
$canpost=1;
$allowpost=explode(',',$foruminfo['allowpost']);
if (!in_array($user->groupid, $allowpost)){
	$canpost=0;
}

$searchadd=$thread_children=$thread_online=$fastpost='';
	
//如果$foruminfo没有值
if(!$foruminfo)	ErrorMsg('获取版块数据错误！');	
	
//返回导航信息
$msg_guide= ' -&gt; <a href="'.sprintf(URLTOPIC, $fid).'">'.$foruminfo['title'].'</a>';	
		
/**
 * 各个级别的公告
 */
//板块公告
if($foruminfo['aid']){
	$foruminfo['startdate']=get_date($foruminfo['startdate']);
	$foruminfo['content']=str_replace("\n","<br>",$foruminfo['content']);
}		

$uplevel=$foruminfo['level'];
$uplevel=substr($uplevel,0,2);
$NT_A=$NT_C=null;
//板块分类公告
$SqlStr='SELECT * FROM `'. DB_TABLE_PRE .'announce`';
$SqlStr.=' WHERE `level`='.$uplevel;
$SqlStr.=' LIMIT 1;';
//DebugStr($SqlStr);
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$NT_A = $MyDatabase->ResultArr [0];
	
	$ifsort=1;
	$NT_A['startdate']=get_date($NT_A['startdate'], 'y-m-d h:i');
}

//全局分类公告
$SqlStr='SELECT * FROM `'. DB_TABLE_PRE .'announce`';
$SqlStr.=' WHERE `level`=0';
$SqlStr.=' LIMIT 1;';
//DebugStr($SqlStr);
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$NT_C = $MyDatabase->ResultArr [0];
	
	$ifsort=1;
	$NT_C['startdate']=get_date($NT_C['startdate'], 'y-m-d h:i');
}	
	
//搜索方式
$search='';

//获取贴数
$count=$foruminfo['topic'];
$searchadd=" AND ifcheck='1'";

$tpcdb=array();	
//获取当前页
$page=Request('page',1)+0;
if ($page<1) $page=1;
		
//帖子排序方式
/**/
$sql='fid='.$fid;
//置顶，倒序，越大越前
$topadd='`top` DESC,';
	
//顺序
$asc = 'DESC';

//排序方式
$orderway='`lastpost`';
$orderway ? $w_add="orderway=$orderway&asc=$asc&" : $w_add='';
	
//分页
$numofpage=ceil($count/PAGE_PER);
$totlepage=$numofpage;
if ($numofpage && $page>$numofpage){
	$page=$numofpage;
}
$start_limit = ($page - 1) * PAGE_PER;
$limit2=' LIMIT '.$start_limit. ','.PAGE_PER . ';';

//分页
$pages=numofpage($count,$page,$numofpage,"topic.php?fid=$fid&search=$search&$w_add");

//排序
$orderway.=' '.$asc;

//显示帖子，如果需要查询， 则显示查询的帖子
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'topics` WHERE ' . $sql . $searchadd . ' ORDER BY ' . $topadd . $orderway . $limit2;
//	DebugStr($str_Sql);
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$topicdb = $MyDatabase->ResultArr;		

	foreach($topicdb as $topic){
		$topic['titleadd']='';
		
		$topic['urlread']  = sprintf(URLREAD,  $topic['tid']);		
		
		//帖子最后回复时间
		if($topic['lastpost']==0){
			$topic['lastpost']=$topic['postdate'];
		}
		$topic['lastpost']= get_date($topic['lastpost']);
		
		//发布日期
		$topic['postdate']=get_date($topic['postdate'],'Y-m-d');
		
		//如果上传过附件
		if($topic['ifupload']){
			$topic['titleadd'].='<img src="images/blank.gif" class="topicadd"> ';			
		}
		
		//如果帖子被锁定级别为1
		if ($topic['lock']){
			$topic['status']="topiclock";
		} 

		//如果帖子回复大于10
		elseif ($topic['replies']>=10){
			$topic['status']="topichot";
			$topic['titleadd'].='<img src="images/blank.gif" class="topichot1"> ';
		}

		//为新帖的话
		elseif (TIMESTAMP-strtotime($topic['lastpost'])<=TIME_NEW){
			$topic['status']="topicnew";
			$topic['titleadd'].='<img src="images/blank.gif" class="topicnew1"> ';
		}

		//否则为默认图标
		else{			
			$topic['status']="topic";
		}

		//格式化输出日期
		$topic['lastpost']= get_date(strtotime($topic['lastpost']), 'y-m-d H:i');

		//如果有置顶帖
		$topic['top'] && $ifsort=1;

		//如果置顶
		if($topic['top']){
			$topic['status']="topictop" .$topic['top'] ;
		}
		
		//这个不知道如何注释
		$topics[]=$topic;
	}
}

require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');

?>