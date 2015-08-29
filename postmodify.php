<?php
//如果为发帖
if($article==0){
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'view_topic_ext` WHERE `tid`='.$tid;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$tpcdb = $MyDatabase->ResultArr [0];	

		if(!$tpcdb['tid']){
//DebugStr($SqlStr);
//echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';
			ErrorMsg('不存在的主帖编号！');
		}
		@extract($tpcdb);
	}
}
//如果为回帖
else {
	!is_numeric($id) && ErrorMsg('帖子编号错误！');
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'view_posts` WHERE `id`='.$id;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {	
		$atcdb= $MyDatabase->ResultArr [0];		
		if(!$atcdb['tid']){
			DebugStr($SqlStr);
			echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('不存在的帖子编号！');
		}
		@extract($atcdb);
	}
}
//判断是否为本人
if ($authorid!=$user->uid) ErrorMsg('你不能修改他人的帖子！');

//获取用户组的最大编辑时间
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'user_group` WHERE `gid`='.$user->groupid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$edittime = $MyDatabase->ResultArr [0]['edittime'];	
}

//修改超时后不允许修改
//debugstr($edittime);
if (((TIMESTAMP - $postdate) > $edittime * 60) && $edittime>0){
	ErrorMsg('已经过了修改时间，你不能再修改你的帖子了。');
}

//获取操作步骤
$step=Request('step',0);
//默认步骤，显示帖子内容
if (!$step){
	empty($title) && $title=' ';

	$atc_title  = $title;
	$atc_content = $content;
	$atc_icon		 = '';
	//
	$atc_content = str_replace("<","&lt;",$atc_content);
	$atc_content = str_replace(">","&gt;",$atc_content);
		
	//返回导航信息
	$msg_guide.= ' -&gt; <a href="read.php?tid='.$tid.'">'.$atc_title.'</a>';	
} elseif ($step == 2){

	$atc_title	= Request('atc_title');
	$atc_content= Request('atc_content');
	$atc_usesign= Request('atc_usesign',0);
	
	//获取发帖表情
	$atc_iconid	= Request('atc_iconid',0);
	
	//重新编辑信息
	$timeofedit	= get_date(TIMESTAMP);
	$alterinfo	= '此贴在'.$timeofedit.'重新编辑';
	
	//是否可以发布
	$ifcheck		= 1;
	$addmsg			= '';
	$refresh_url= 'read.php?tid='.$tid.'&page='.$page;	
	if ($foruminfo['modify_check'] == 1){
		$ifcheck	= 0;
		$addmsg		= '<font color=red>你修改的帖子需要审核， 请等待管理员审核。</font>';
		$refresh_url= 'read.php?tid='.$tid.'&page='.$page;		
	}

	//内容
	$atc_content=trim($atc_content);
	if ($authorid == $user->uid){
		$ipdata='userip=\''.$user->ip.'\',';
	} else {
		$ipdata='';
	}
	
	require_once('postupload.php');		 //文件上传
	if ($article == 0){
		$ArrField=array('icon',				'title',		'ifcheck');
		$ArrValue=array($atc_iconid,	$atc_title, $ifcheck);
		if($MyDatabase->Update('topics', $ArrField, $ArrValue, 'tid='.$tid)){
		}else{
			DebugStr($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：发帖修改失败！');
		}
		
		$ArrField=array('ifsign',		 'alterinfo', 	'content');
		$ArrValue=array($atc_usesign,$alterinfo,		$atc_content.$str_att);
		if($MyDatabase->Update('topics_ext', $ArrField, $ArrValue, 'tid='.$tid)){
		}else {
			DebugStr($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：发帖修改失败！');
		}

		//
		if($ifcheck==0){
			$SqlStr='UPDATE `'.DB_TABLE_PRE.'forums` SET `topic`=`topic`-1,`post`=`post`-1 WHERE `fid`='.$fid;
			$MyDatabase->SqlStr=$SqlStr;
			if ($MyDatabase->ExecuteQuery()){
			}else {
				DebugStr($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：更新首页显示栏目最新发帖失败！');
			}	
		}


	} else {
		//更新回帖
		$ArrField=array('icon',				'title', 		'ifsign',	 		'alterinfo',	'content',		'ifcheck');
		$ArrValue=array($atc_iconid,	$atc_title,	$atc_usesign,	$alterinfo,		$atc_content.$str_att, $ifcheck);
		if($MyDatabase->Update('posts', $ArrField, $ArrValue, 'id='.$id)){
		}else {
			DebugStr($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：回帖修改失败！');			
		}

		if($ifcheck==0){
			$SqlStr='UPDATE `'.DB_TABLE_PRE.'forums` SET `post`=`post`-1 WHERE `fid`='.$fid;
			$MyDatabase->SqlStr=$SqlStr;
			if ($MyDatabase->ExecuteQuery()){
			}else {
				DebugStr($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：');			
			}	

			$SqlStr='UPDATE `'.DB_TABLE_PRE.'topics` SET `replies`=`replies`-1 WHERE `tid`='.$tid;
			$MyDatabase->SqlStr=$SqlStr;
			if ($MyDatabase->ExecuteQuery()){
			}else {
				DebugStr($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：');			
			}	
		}


	}
	$refresh_msg='帖子修改 ['.$title.']，成功。'.$addmsg.'';
	ErrorMsg($refresh_msg, $refresh_url);
}
?>