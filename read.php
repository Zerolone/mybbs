<?php 
/**
 * 阅读帖子内容
 * 
 * @version	2010-2-23 10:51:05
 * @author		Zerolone
 * 
 */
require('include/common.php');
define('PAGENAME','read.php');

//加载所有的等级
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'user_group` ORDER BY `post`, `gid`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$UserGroups = $MyDatabase->ResultArr;
	
	//重新定义一下组、图片和名字
	foreach ( $UserGroups as $group ) {
		$groups[$group['gid']]=array(
			'online'		=> $group['online'],
			'offline'		=> $group['offline'],
			'title'			=> $group['title'],
		);
	}		
}else {
	ErrorMsg($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：用户组出错！');
}

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
	ErrorMsg($SqlStr.'帖子显示错误！');
}

if($read['ifcheck']==0) ErrorMsg('帖子尚未审核！');

$fid			=	$read['fid'];				//所属栏目编号
$title	  = $read['title'];			//主题
$authorid = $read['authorid'];	//作者ID

//获取当期栏目信息
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums` WHERE `fid`='.$fid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$foruminfo = $MyDatabase->ResultArr [0];
	$forumtitle=' &gt;&gt; '. $foruminfo['title']. ' &gt;&gt; ';
		
	//返回导航信息
	$msg_guide= ' -&gt; <a href="'.sprintf(URLTOPIC, $fid).'">'.$foruminfo['title'].'</a>';		
}else {
	ErrorMsg('导航信息错误！');
}

//判断板块访问权限
$allowvisit=explode(',',$foruminfo['allowvisit']);
if (!in_array($user->groupid, $allowvisit)){
	ErrorMsg('你没有访问该栏目的权限！');
}

//板块发帖、回复权限
$canpost=1;
$allowpost=explode(',',$foruminfo['allowpost']);
if (!in_array($user->groupid, $allowpost)){
	$canpost=0;
}

$canreply=1;
$allowreply=explode(',',$foruminfo['allowreply']);
if (!in_array($user->groupid, $allowreply)){
	$canreply=0;
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
	$read['id'] = 'topic';
	$readdb[]    = viewread($read, 0, $groups, $MyDatabase);
	$authorids   = $read['authorid'];
}

//文章数,页码,共几页,路径
$pages=numofpage($count,$page,$numofpage,'read.php?tid='.$tid);

//更新点击率
$SqlStr='UPDATE `'.DB_TABLE_PRE.'topics` SET `hits`=`hits`+1 WHERE tid='.$tid;
$MyDatabase->SqlStr=$SqlStr;
if($MyDatabase->ExecuteQuery()){
}else {
	ErrorMsg($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：点击率更新失败！');
}

//导航
$msg_guide.= ' -&gt; <a href="'.sprintf(URLREAD, $tid).'">'.$title.'</a>';

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
			$readdb[]=viewread($read,$start_limit,$groups, $MyDatabase);
			if($authorids){
				$authorids .=','.$read['authorid'];
			}else{
				$authorids  = $read['authorid'];
			}
			$start_limit++;
		}
	}else {
		ErrorMsg($SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：读取帖子数据失败！');
	}	
}

/**
 * 显示单个帖子
 * 
 * @param 帖子数组 $read
 * @param 开始楼层 $start_limit
 * @param 用户组		$UserGroups
 */
function viewread($read,$start_limit,$UserGroups, $MyDatabase){
	//如果为楼主， 则不显示帖子标题
	if ($start_limit==0){
		$read['title']='';
	}
	
	//开始楼层
	$read['lou']=$start_limit;
	
	//签名代码替换
	$read['ifsign']<2 && $read['content']=str_replace("\n","<br>",$read['content']);
	
	//如果存在用户组
	if($read['groupid']!=''){		
		//组对应图片
		$read['lpic']=$UserGroups[$read['groupid']]['offline'];
		if($read['thisvisit']+TIME_ONLINETIME*1.5>TIMESTAMP){
			$read['lpic']=$UserGroups[$read['groupid']]['online'];
		}
		
		$read['level']=$UserGroups[$read['groupid']]['title'];			//组对应等级
		$read['regdate']=get_date($read['regdate'],"Y-m-d");				//注册时间
		$read['lastlogin']=get_date($read['thisvisit'],"Y-m-d");		//最后登录时间
		$read['aurvrc']=round($read['rvrc'] / 10);									//威望
		$read['author']=$read['username'];													//作者-用户名
		$tpc_author=$read['author'];																//
		$sign[$read['author']]=$read['signature'];									//签名
		
		//BBCODE替换内容
		$read['content'] = BB($read['content'], $MyDatabase);		
	}else{
		$read['face']="<br>";
		$read['lpic']='8';
		$read['level']=$read['digests']=$read['postnum']=$read['money']=$read['regdate']=$read['lastlogin']=$read['aurvrc']='*';
	}
	
	//格式化发帖日期
	$read['postdate']=get_date($read['postdate']);
		
	//如果存在表情
	if($read['icon']){
		$read['icon']='<img src="image/post/emotion/'.$read['icon'].'.gif" align=left border=0>';
	} else{
		$read['icon']='';
	}
	
	/**
	$attachper=1;
	if($attachper){
		$attachments=array();
		$downattach=$downpic='';
		if($read['aid']!=''){
			//附件，解序列
			$attachs= unserialize(stripslashes($read['aid']));
			if(is_array($attachs)){
				$str_tmp='';
				foreach($attachs as $at){
					$a_url=$at['attachurl'];

					//如果附件为图片
					if($at['type']=='img'){
						$dfurl='<br><img src="'.$a_url.'" border=0>';
						if (isset($at['desc'])){
							$str_tmp.='<br /><br /><b>'.$at['desc'].'</b><br />';							
						}						
						$str_tmp.=$dfurl;						
					}
				}

				$aids=array();
				$read['content'].=$str_tmp;
				foreach($aids as $key => $value){
					if($read['pic'][$value]){
						unset($read['pic'][$value]);
					}
					if($read['downattach'][$value]){
						unset($read['downattach'][$value]);
					}
				}
			}
		}
	}
	/**/
	
	//转换提交内容
	$read['alterinfo'] && $read['content'].="<br><br><br><font color=gray>[ $read[alterinfo] ]</font>";
	return $read;
}

/**
 * BBCode
 * 
 * @param  $content
 */
function BB($content, $MyDatabase){
	//						 b						i						 u 						 align														image								 
	$Arr_S=array('[b]','[/b]','[i]','[/i]','[u]','[/u]', '[align=center]', 		'[/align]' ,'[img]', '[/img]'		, '','');
	$Arr_R=array('<b>','</b>','<i>','</i>','<u>','</u>', '<p align="center">','</p>' , 		'<img src="' , '" />', '','');

	$content=str_replace($Arr_S,$Arr_R,$content);

	//url
	$content=preg_replace("/\[url(.*?)\](.*?)\[\/url\]/",'<a href\\1>\\2</a>',$content);
	
	//CODE	
	$content=preg_replace("/\[code\]([\s\S]+?)\[\/code\]/ies","encode('\\1')",$content);
	
	//quote
	$content=preg_replace("/\[quote\]([\s\S]+?)\[\/quote\]/ies","quote('\\1')",$content);
		
	//FONT
	$content=preg_replace("/\[font(.*?)\](.*?)\[\/font\]/",'<font face\\1>\\2</font>',$content);
	
	//COLOR
	$content=preg_replace("/\[color(.*?)\](.*?)\[\/color\]/",'<font color\\1>\\2</font>',$content);
			
	//SIZE
	$content=preg_replace("/\[size(.*?)\](.*?)\[\/size\]/",'<font size\\1>\\2</font>',$content);
	
	//附件
	if(preg_match_all('%\[attach\](\d+)\[/attach\]%i', $content, $aids)){
		$aids=$aids[1];
		$att=array();
		foreach ($aids as $aid){
			//获取附件
			$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'attachs` WHERE `aid`='.$aid;
			$MyDatabase->SqlStr = $SqlStr;
//			DebugStr($SqlStr);
			if ($MyDatabase->Query ()) {
				$att = $MyDatabase->ResultArr [0];		
				if ($att['type']=='img'){
					$atts[]='<img src="' . $att['attachurl'] . '">';
				}else {
					
				}
				
				$reatts[]='[attach]'.$aid.'[/attach]';				
			}			
		}
		$content=str_replace($reatts,$atts,$content);
	}
	
	
	
	
	/*
	*/
	
	return $content;
}

/**
 * HTML教程过滤字符串
 * 
 * @param 过滤内容 $content
 */
function encode ( $content ){
	$content= ereg_replace("<br>", "[br]", $content);
	$content= ereg_replace("<", "&lt;", $content);
	$content= ereg_replace(">", "&gt;", $content);
	$content= ereg_replace("'", '\'', $content);
	$content= ereg_replace('"', '\"', $content);
	
//	DebugStr($str);
	$content= ereg_replace('\[br\]', '<br><li>', $content);
	
	$content='<div style="font-size:9px;margin-left:5px"><b>CODE:</b></div><div class=quote><OL>'.$content.'</li></OL></div>';
	return $content;	
}

/**
 * 引用
 * 
 * @param 引用内容 $content
 */
function quote($content){
	$content="<div style=\"font-size:9px;margin-left:5px\"><b>QUOTE:</b></div><div class=quote>$content</div>";
	return $content;	
}

/**
 * 附件
 * 
 * @param 附件编号 $aid
 * @param $MyDatabase
 */
function attach($aid, $MyDatabase){
	$content="附件显示错误！\n";
	
	//获取附件
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'attachs` WHERE `id`='.$aid;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$att = $MyDatabase->ResultArr [0];
		
		if ($att['type']=='img'){
			$content='<img src="' . $att['attachurl'] . '"><br>';
		}
		
	}
	
	
	return $content;	
}

require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');
?>