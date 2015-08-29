<?php
/**
 * 帖子查看
 * 
 * @version 2010-3-15 20:22:37
 * @author Zerolone
*/
require('../include/common.php');
define('PAGE_NAME','read.php');

//获取帖子编号
$tid=Request('tid',0);

//获取贴子的内容，和信息，如果为首页， 获取贴主的内容信息
$page=Request('page',1);
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'view_topic` WHERE `tid`='.$tid;
$start_limit = 0;

$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$read = $MyDatabase->ResultArr [0];
}else {
	DebugStr($SqlStr);
	echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('帖子显示错误！');
}

//DebugArr($read);

$fid			=	$read['fid'];//所属栏目编号
$title	  = $read['title'];//主题
$authorid = $read['authorid'];//作者ID

//获取当期栏目信息
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums` WHERE `fid`='.$fid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$foruminfo = $MyDatabase->ResultArr [0];
		
	//返回导航信息
	$msg_guide= ' -&gt; <a href="thread.php?id='.$fid.'">'.$foruminfo['title'].'</a>';		
}else {
	DebugStr($SqlStr);
	ErrorMsg('导航信息错误！');
}

//计算页数
$count= $read['replies'];
if ($count % READ_PER==0){
	$numofpage=$count/READ_PER;
} else{
	$numofpage=floor($count/READ_PER)+1;
}
if($page>$numofpage){
	$page=$numofpage;
}
if ($count==0) $page=1;

$readdb    = array();
$authorids = '';
if($page==1){
	$read['id'] = $tid;
	$readdb[]    = viewread($read, 0);
	$authorids   = $read['authorid'];
}
//DebugArr($read);

//文章数,页码,共几页,路径
//当这篇文章位于栏目列表第二页时，在列表页显示的路径就变为 read-tid-8278-fpage-2.html
//当在第三页时，列表页就显示为 read-tid-8278-fpage-3.html
//$pages=numofpage($count,$page,$numofpage,"read.php?tid=$tid&fpage=$fpage&toread=$toread&");
$pages=numofpage($count,$page,$numofpage,"read.php?tid=$tid&");

//更新点击率
$SqlStr='UPDATE `'.DB_TABLE_PRE.'topics` SET `hits`=`hits`+1 WHERE `tid`='.$tid;
$MyDatabase->SqlStr=$SqlStr;
if($MyDatabase->ExecuteQuery()){
		
}else {
	ErrorMsg('点击率更新失败！');
}

//导航
$msg_guide.= ' -&gt; <a href="read.php?id='.$tid.'">'.$title.'</a>';		

//回帖列表
if($read['replies']>0){
	//开始记录，
	$start_limit=($page-1)*READ_PER;
	
	//作者编号
	$authorids='';
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'view_posts` WHERE `tid`='.$tid.' AND ifcheck=1 ORDER BY `postdate` LIMIT '.$start_limit.','.READ_PER;	
	$start_limit++;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $read ) {
//			DebugArr($read);
			$readdb[]=viewread($read,$start_limit);
			if($authorids){
				$authorids .=','.$read['authorid'];
			}else{
				$authorids  = $read['authorid'];
			}
			$start_limit++;
		}
	}else {
		DebugStr($SqlStr);
		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('读取帖子数据失败！');
	}	
}

/**
 * 显示单个帖子
 * 
 * @param $read					数据
 * @param $start_limit		楼层
 * @param $UserGroups		用户组
 */
function viewread($read,$start_limit){
	//签名代码替换
	$read['ifsign']<2 && $read['content']=str_replace("\n","<br>",$read['content']);
		
	//转换提交内容
//	$read['alterinfo'] && $read['content'].="<br><br><br><font color=gray>[ $read[alterinfo] ]</font>";
	return $read;
}

require(PAGE_NAME.'.php');
require('../../include/debug.php');
?>