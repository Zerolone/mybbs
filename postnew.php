<?php
//判断板块访问权限
$allowpost=explode(',',$foruminfo['allowpost']);
if (!in_array($user->groupid, $allowpost)){
	ErrorMsg('你没有在当前栏目发帖的权限！');
}

if($step==2){
	$atc_title		= Request('atc_title');
	$atc_content	= Request('atc_content');	
	$atc_usesign	= Request('atc_usesign', 0);

	//判断是否需要审核
	$addmsg='';
	$ifcheck = 1;
	if ($foruminfo['post_check'] == 1){
		$ifcheck = 0;
		$addmsg='<font color=red>你发的帖子需要审核， 请等待管理员审核。</font>';
	}

	//获取帖子图标
	$atc_iconid=Request('atc_iconid', 0);	
	
	//文件上传
	require_once('postupload.php');
	
	$ArrField=array('fid',	'icon',		  'author', 						  			'authorid', 'title',		'ifcheck','lastposter',									'ifupload', 'postdate','lastpost');
	$ArrValue=array($fid, 	$atc_iconid,addslashes($user->username),	$user->uid, 	$atc_title,	$ifcheck,	addslashes($user->username),  $ifupload, TIMESTAMP, TIMESTAMP);	
	if($MyDatabase->Insert('topics', $ArrField, $ArrValue)){
		$tid=$MyDatabase->Insert_id();
	}else {
		ErrorMsg($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__.'<br />发帖提交失败！');
	}
	
	$ArrField=array('tid','ifsign', 		'userip',		'content',		         'authorid');
	$ArrValue=array($tid, $atc_usesign, $user->ip,	$atc_content.$str_att, $user->uid);	
	if($MyDatabase->Insert('topics_ext', $ArrField, $ArrValue)){
	}else {
		ErrorMsg($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__.'<br />发帖扩展提交失败！');
	}
	bbspostguide($user, 1, $MyDatabase);

	$refresh_url=sprintf(URLTOPIC, $fid);
	//如果通过审核就
	if ($ifcheck==1){
		lastinfo($fid,$tid,'new',$user->uid, $MyDatabase,$atc_title);		
		$refresh_url=sprintf(URLREAD, $tid);
	}
	
	ErrorMsg('主题['.$atc_title.']，'.$addmsg.'发布成功！', $refresh_url);
}
?>