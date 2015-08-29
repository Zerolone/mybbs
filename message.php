<?php 
/**
 * 短信
 * 
 * @version	2010-4-2 10:47:27
 * @author	Zerolone
 * 
 */
require('include/common.php');
Define('PAGENAME', 'message.php');

$title='发送信息';
$foruminfo['title']='';
$secondurl='message.php';

//获取方式，默认为收件箱
$action=Request('action','receivebox');

//获取收件箱方式
$SqlStr='SELECT COUNT(*) AS `msgcount` FROM `'.DB_TABLE_PRE.'msg` WHERE `touid`='.$user->uid.' AND `type`=\'rebox\'';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$rs = $MyDatabase->ResultArr [0];
	$msgcount = $rs['msgcount'];
}

$action!="read" && $action!='clear' && $action!='del' && getusermsg($user->uid,$MyDatabase);

//收件箱
if ($action=="receivebox"){
	$readtype='read';	
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'msg` WHERE `type`=\'rebox\' AND `touid`='.$user->uid.' ORDER BY mdate DESC;';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $msginfo ) {
			$msginfo['title']=subString($msginfo['title'],35);
			$msginfo['mdate']=get_date($msginfo['mdate']);
			$msginfo['from']=$msginfo['username'];
			$msginfo['to']=$user->username;
			$msgdb[]=$msginfo;		
		}
	}
	$towhere='receivebox';
}

//发件箱
if ($action=="sendbox"){
	$readtype='readsnd';	
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'msg` WHERE `type`=\'sebox\' AND `fromuid`='.$user->uid.' ORDER BY mdate DESC;';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $msginfo ) {
			$msginfo['title']=subString($msginfo['title'],35);
			$msginfo['mdate']=get_date($msginfo['mdate']);
			$msginfo['from']=$user->username;
			$msginfo['to']=$msginfo['username'];
			$msginfo['fromid']=$msginfo['fromuid'];
			$msginfo['touid']=$msginfo['touid'];
			$msgdb[]=$msginfo;		
		}
	}
	$towhere='sendbox';
}

/**
* 阅读短消息
*/
if ($action=="read"||$action=="readsnd"||$action=="readscout"){
	if($action=="read"){
		$preaction='receivebox';
		$sqladd="type='rebox' AND touid='$user->uid'";
	} elseif($action=="readsnd"){
		$preaction='sendbox';
		$sqladd="type='sebox' AND fromuid='$user->uid'";
	} elseif($action=="readscout"){
		$preaction='scout';
		$sqladd="type='rebox' AND fromuid='$user->uid'";
	} else{
		$sqladd='';
	}
	
	$mid=Request('mid');
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'msg` WHERE `mid`='.$mid.' AND '.$sqladd;
	$MyDatabase=new Database();
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$msginfo = $MyDatabase->ResultArr [0];	
		$msginfo['content']=str_replace("\n","<br>",$msginfo['content']);
		$msginfo['content']=$msginfo['content'];
		$msginfo['title'] =str_replace('&ensp;$','$', $msginfo['title']);
		$msginfo['content'] =str_replace('&ensp;$','$', $msginfo['content']);
		$msginfo['mdate']=get_date($msginfo['mdate']);		
	}
	//更新一下阅读状态
	$ArrField=array('ifnew');
	$ArrValue=array(0);
	if ($MyDatabase->Update('msg', $ArrField, $ArrValue, 'mid='.$mid)){
		//成功
	}else {
		ErrorMsg('更新消息状态为已读失败！');
	}	
	$action=="read" && getusermsg($user->uid, $MyDatabase);
}
/**
* 写短信
*/
if($action=="write"){
	$step=Request('step',0);	
	if ($step==0){
		$subject=$atc_content='';
		$remid=Request('remid');
		$touid=Request('touid');
		if(is_numeric($remid)){			
			$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'msg` WHERE mid='.$remid.' AND (fromuid='.$user->uid.' OR (type=\'rebox\' AND touid='.$user->uid.'))';
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$reinfo = $MyDatabase->ResultArr [0];	
				
				$msgid="value=$reinfo[username]";
				$subject=strpos($reinfo['title'],'Re:')===false ? 'Re:'.$reinfo['title']:$reinfo['title'];
				$atc_content="[quote]".trim(subString(preg_replace("/\[quote\](.+?)\[\/quote\]/is",'',$reinfo['content']),100))."[/quote]\n\n";
			}			
		} elseif(is_numeric($touid)){
			$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'users` WHERE `uid`='.$touid;
			$MyDatabase->SqlStr=$SqlStr;
			if ($MyDatabase->Query ()) {
				$reinfo = $MyDatabase->ResultArr [0];
				$msgid="value=$reinfo[username]";
			}			
		} else{
			$msgid='';
		}
	} elseif($step==2){
		$msg_title		= Request('msg_title');
		$atc_content	= Request('atc_content');		
		$msg_ruser		= Request('msg_ruser');
		$ifsave				= Request('ifsave');
		
		$msg_title   = trim($msg_title);
		$atc_content = trim($atc_content);
		if (empty($msg_ruser) || empty($atc_content) ||empty($msg_title)){
			ErrorMsg('短信为空！');
		} elseif (strlen($msg_title)>75||strlen($atc_content)>1500){
			ErrorMsg('短信内容超长!');
		}
		$atc_content = Char_cv($atc_content);
		$msg_title   = Char_cv($msg_title);
		$messageinfo = array($msg_ruser,$user->uid,$msg_title,TIMESTAMP,$atc_content,$ifsave,$user->username);

		//写信息到数据库
		writenewmsg($messageinfo,$MyDatabase,$user->groupid);
	
		ErrorMsg('发送成功！','message.php?action=receivebox');
	}
}
if ($action=="del"){
	//只能删除发件人或者收件人为自己的
	$delids	= Request('delids');
	$delid	= Request('delid');
	
	if(!is_numeric($delids)){
		if (!$delid) ErrorMsg('未定义操作！');
		$delids='';
		foreach($delid as $value){
			!is_numeric($value) && Showmsg('undefined_action');
			$delids.=$value.',';
		}
		$delids && $delids=substr($delids, 0, -1);
	}
	if($delids){
		if ($MyDatabase->Delete('msg', 'mid IN('.$delids.') AND ((type=\'rebox\' AND touid='.$user->uid.') OR (type=\'sebox\' AND fromuid='.$user->uid.') OR (type=\'rebox\' AND fromuid='.$user->uid.' AND ifnew=1))')){
			getusermsg($user->uid, $MyDatabase);
			ErrorMsg('删除成功！', 'message.php?action=receivebox');
		}
	} else{
		ErrorMsg('未定义操作！');
	}
}

/**
 * 更新提示新短信提示
 * 
 * @param $uid					用户编号
 * @param $MyDatabase	数据库
 */
function getusermsg($uid, $MyDatabase){
	$rs='';
	$SqlStr='SELECT ifnew FROM `'.DB_TABLE_PRE.'msg` WHERE touid='.$uid.' AND ifnew=1 AND type=\'rebox\'';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$rs = $MyDatabase->ResultArr [0];
	}
	
	$ArrField=array('newpm');	
	$ArrValue=array('0');
	if($rs){
		$ArrValue=array('1');
	}
	
	if ($MyDatabase->Update('users', $ArrField, $ArrValue, 'uid='.$uid)){
	}
}

//写短信
function writenewmsg($msg,$MyDatabase,$groupid,$sysmsg=0){
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'users` WHERE username=\''.addslashes($msg[0]).'\'';
	$MyDatabase->SqlStr = $SqlStr;
	//DebugStr($SqlStr);
	if ($MyDatabase->Query ()) {
		$rt = $MyDatabase->ResultArr [0];			
			!$msg[6] && $msg[6]='SYSTEM';
			
			$ArrField=array('touid',	'fromuid','username', 'type', 'ifnew', 'title', 'mdate', 'content');
			$ArrValue=array($rt['uid'],$msg[1],	$msg[6],		'rebox',1,				$msg[2],$msg[3],$msg[4]);
			if ($MyDatabase->Insert('msg', $ArrField, $ArrValue)){
				//成功
			}else {
				ErrorMsg('发送失败！');
			}
			
			//保存到发件箱
			if($msg[5] && $msg[5]=='Y'){
				$ArrField=array('touid',	'fromuid','username', 		'type', 'ifnew', 'title', 'mdate', 'content');
				$ArrValue=array($rt['uid'],$msg[1],	$rt['username'],'sebox',0,				$msg[2],$msg[3],$msg[4]);
				if ($MyDatabase->Insert('msg', $ArrField, $ArrValue)){
					//成功
				}else {
					ErrorMsg('保存发件箱失败！');
				}				
			}
			
			//更新为有新消息状态
			if ($rt['newpm']==0){
				$ArrField=array('newpm');
				$ArrValue=array(1);
				if ($MyDatabase->Update('users', $ArrField, $ArrValue, 'uid='.$rt['uid'])){
					//成功
				}else {
					ErrorMsg('更新为有新消息状态失败！');
				}	
			}
	}else {
		ErrorMsg('不存在此用户！');
	}
}

require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');

?>