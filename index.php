<?php 
/**
 * 论坛首页
 * 
 * @version	2010-3-23 15:22:48
 * @author	Zerolone
 * 
 */
require('include/common.php');
define('PAGENAME','index.php');

//全局公告--显示0-3条
$notices='';
$SqlStr ='SELECT * FROM `'. DB_TABLE_PRE .'announce`';
$SqlStr.=' WHERE `level`=0';
$SqlStr.=' ORDER BY `order` ASC';
$SqlStr.=' LIMIT 3;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$tnotices = $MyDatabase->ResultArr;
	foreach ($tnotices as $notice){
		$notice['startdate']=date('Y年m月d日',$notice['startdate']);
		
		$notices[]=$notice;
	}
}

//获取论坛数据
//当前注册用户//最新注册用户
$totalmember=$newmember=0;
$SqlStr='SELECT * FROM `'. DB_TABLE_PRE .'bbsinfo`;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];	
	$totalmember	= $DB_Record['totalmember'];
	$newmember		= $rawnewuser=$DB_Record['newmember'];
}

//版块和栏目信息
$topics=0;
$posts=0;
$SqlStr	= 'SELECT * FROM `' .DB_TABLE_PRE. 'forums`';
$SqlStr.= ' ORDER BY `level` ASC;';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$tforums = $MyDatabase->ResultArr;
	foreach ($tforums as $forum){
		$topics+=$forum['topic'];
		$posts+=$forum['post'];
		@list($forum['t'],$forum['author'],$lastpost,$forum['tid'])=explode("\t",$forum['lastpost']);
		
		//最后发布时间
		$forum['lastpost']=$lastpost;
		
		//根据最后回复时间，显示坛子的图片状态，new old，未登录的用户显示为old
		$forum['pic']='old';
		if ($user->uid && ($user->lastpost-strtotime($lastpost))<=TIME_NEW ){
			$forum['pic']='new';			
		}

		//最后发布主题
		$forum['t']=subString($forum['t'], 24);

		//如果为自定义图片
		if(BBS_FM_LOGO==1 && $forum['logo']){
			$forum['logo']='<img align=left src='.$forum['logo']. ' border=0>';
		}
		
		if ($forum['forumadmin']=='')$forum['forumadmin']='&nbsp';
		
		$forum['urltopic'] = sprintf(URLTOPIC, $forum['fid']);
		$forum['urlread']  = sprintf(URLREAD,  $forum['tid']);
		
		

		$forums[]=$forum;
	}
}
require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');
?>