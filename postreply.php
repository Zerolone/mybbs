<?php
/**
* 版块权限判断
* 
* @version 2010-3-23 16:02:23
* @author	Zerolone
*/

//判断板块访问权限
$allowreply=explode(',',$foruminfo['allowreply']);
if (!in_array($user->groupid, $allowreply)){
	ErrorMsg('你没有在当前栏目发帖的权限！', 'index.php');	
}

//获取当前栏目
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'view_topic` WHERE `tid`='.$tid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$topic = $MyDatabase->ResultArr[0];
}else {
	ErrorMsg($SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：获取栏目失败！');
}

$t_date=$topic['postdate'];//主题发表时间 bbspostguide 中用到
if($topic['tid']!=$tid){
	ErrorMsg($SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：获取栏目失败！');
}
$replytitle	= $topic['title'];
$tpc_author	= $topic['author'];
$ifcheck		= $topic['ifcheck'];

//获取步骤
$step=Request('step',1);

if($step==1){
	//导航
	$msg_guide.= ' -&gt; <a href="'.sprintf(URLREAD, $tid).'">'.$topic['title'].'</a>';				
} elseif ($step==2){

	$atc_iconid		= Request('atc_iconid',0);		//表情
	$atc_usesign	= Request('atc_usesign',0);		//是否使用签名
	$atc_title		= Request('atc_title');				//标题
	$topic_title	= Request('topic_title');			//
	$atc_content	= Request('atc_content');			//内容
	
	$addmsg='';
	if ($foruminfo['reply_check'] == 1){
		$ifcheck=0;
		$addmsg='<font color=red>但是回复的帖子需要审核， 请等待管理员审核。</font>';
	}
		
	//是否可以回复
	if ($atc_content==''){
		ErrorMsg('请输入内容！', sprintf(URLREAD, $tid));	
	}
	
	//文件上传--附件
	require_once('postupload.php');	
	
	$ArrField=array('fid','tid','author',											'authorid',	'icon',				'title',		'userip',		'ifsign',			'ifcheck','content',	'postdate');
	$ArrValue=array($fid, $tid, addslashes($user->username),	$user->uid,	$atc_iconid,	$atc_title,	$user->ip,	$atc_usesign,	$ifcheck,	$atc_content.$str_att,TIMESTAMP);	
	if($MyDatabase->Insert('posts', $ArrField, $ArrValue)){
	}else {
		ErrorMsg($MyDatabase->SqlStr.'<br />文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：提交回复失败！', 'read.php?tid='.$tid);	
	}

	
	if($ifcheck==1){
		//如果上传了附件，则更新附件的图标
		$strup='';
		if ($ifupload){
			$strup=', `ifupload`=1';
		}
		
		$SqlStr='UPDATE `'.DB_TABLE_PRE.'topics` SET `lastpost`='.TIMESTAMP.',`lastposter` =\''.addslashes($user->username).'\',`replies`=`replies`+1 ,`hits`=`hits`+1 '. $strup .' WHERE `tid`='.$tid;
		$MyDatabase->SqlStr=$SqlStr;
		if($MyDatabase->ExecuteQuery()){
		}	else {
			ErrorMsg($MyDatabase->SqlStr.'<br />文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：更新回复失败！', 'read.php?tid='.$tid);	
		}
	}

	//更新发帖人状态
	bbspostguide($user, 0, $MyDatabase);
	
	//更新首页
	if ($ifcheck==1){
		if ($atc_title=='')$atc_title='Re:'.$topic_title;
		lastinfo($fid,$tid,'reply',$user->username, $MyDatabase,$atc_title);
	}
	
	
	$refreshurl = sprintf(URLREADM, $tid, $page);
	if($page==1){
		$refreshurl = sprintf(URLREAD, $tid);
	}
	
	
	
	
	ErrorMsg( '回复主题 ['.$topic_title.']，成功。'.$addmsg , $refreshurl);	
}
?>