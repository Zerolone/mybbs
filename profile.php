<?php 
/**
 * 个人资料
 * 
 * @version	2010-4-29 16:08:57
 * @author		Zerolone
 * 
 */

require('include/common.php');

//获取操作状态
$action=Request('action');
if (!$action){
	define('PAGENAME','profile.php');
	
	//用户头像
	$iconarray = explode('|',$user->icon);
	$uploadimg = '';
	
	//用户等级
	$systitle=$user->getGroupInfo($MyDatabase);
	$systitle=$systitle['title'];
	
	//用户在线时间-注册时间-最后访问时间
	$user->rvrc=floor($user->rvrc/10);
	$user->regdate=get_date($user->regdate,"Y-m-d");
	$user->lastvisit=get_date($user->lastpost,"Y-m-d");

	//最新的10条PM
	$msgdb=array();
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'msg` WHERE type=\'rebox\' AND touid='.$user->uid.' ORDER BY mdate DESC LIMIT 15;';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $msg ) {
			$msg['title']=subString($msg['title'],35);
			$msg['mdate']=get_date($msg['mdate']);
			$msg['username']=$msg['username'];
			$msg['to']=$user->username;
			
			if ($msg['ifnew']){
				$msg['ifnew']='<font color="red">否</font>';
			}else {
				$msg['ifnew']='是';
			}
			
			$msgdb[]=$msg;
		}
	}
//	DebugArr($msgdb);	
}elseif ($action=='show'){
	define('PAGENAME','profile_show.php');
	
	//获取用户编号-用户名
	$uid=Request('uid');
	$username=Request('username');
	
	//如果不存在用户编号，则查询用户名
	if ($uid){
		$sql='uid='.$uid;
	} else{
		$sql='username=\''.$username.'\'';
	}
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'view_user` WHERE '.$sql;
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->Query ()) {
		$userdb = $MyDatabase->ResultArr [0];
	}	else {
		ErrorMsg('用户不存在！');
	}
	
	//用户等级
	$systitle=$user->getGroupInfo($MyDatabase);
	$systitle=$systitle['title'];

	//用户名
	$rawauthor=rawurlencode($userdb['username']);

	//最后登录时间
	$lasttime=get_date($userdb['lastvisit'],"Y-m-d");

	//每日发帖
	$averagepost=floor($userdb['postnum']/(ceil((TIMESTAMP-$userdb['regdate'])/(3600*24))));
	
	//注册日期
	$show_regdate=get_date($userdb['regdate'],"Y-m-d");
	
	//签名
	$tempsign=$userdb['signature'];
	$tempsign=str_replace("\n","<br>",$tempsign);
	
	//个人简介
	$tempintroduce=str_replace("\n",'<br>',$userdb['introduce']);
}elseif ($action=="modify"){
	
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'users` WHERE `uid`='.$user->uid;
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->Query ()) {
		$userdb = $MyDatabase->ResultArr [0];
	}	else {
		ErrorMsg('用户不存在！');
	}	
	
	//修改操作步骤
	$step=Request('step',0);
	
	//显示数据
	if ($step==0){
		define('PAGENAME','profile_modify.php');
		
		$sexselect[$userdb['gender']]="selected";							//性别
		$getbirthday = explode("-",$userdb['bday']);					//生日
		$yearslect[(int)$getbirthday[0]]="selected";					//年
		$monthslect[(int)$getbirthday[1]]="selected";					//月
		$dayslect[(int)$getbirthday[2]]="selected";						//日
		
		//头像
		$img=@opendir(TP.'images/face');
		$imgselect='';
		while ($imagearray=@readdir($img)){
			if ($imagearray!='.' && $imagearray!='..' && $imagearray!='' && $imagearray!='none.gif'){
				if ($imagearray==$userdb['icon']){
					$imgselect.= '<option selected value="'.$imagearray.'">'.$imagearray."</option>";
				} else{
					$imgselect.= '<option value="'.$imagearray.'">'.$imagearray."</option>";
				}
			}
		}
		@closedir($img);		
	}  elseif ($_POST['step']==2){
		Add_S($userdb);
		
		$propwd=Request('propwd');
		$oldpwd=Request('oldpwd');
		$proemail=Request('proemail');
		
		if (!empty($propwd)||$userdb['email']!=$proemail){
			$oldpwd=md5($oldpwd);
			if (strlen($userdb['password'])==16){
				$oldpwd=substr($oldpwd,8,16);/*支持 16 位 md5截取密码*/
			}
			if ($userdb['password']!=$oldpwd){
				ErrorMsg('密码错误！', 'profile.php?action=modify');				
			}
		}
		
		$proemail=Request('proemail');
		$prooicq=Request('prooicq');
		$prohomepage=Request('prohomepage');
		$progender=Request('progender');
		$profrom=Request('profrom');
		$prosign=Request('prosign');
		$prointroduce=Request('prointroduce');
										
		$userdb['email']=$proemail;
		$userdb['oicq']=$prooicq;
		$userdb['site']=$prohomepage;
		$userdb['gender']=(int)$progender;
		$userdb['location']=$profrom;
		$userdb['signature']=$prosign;
		$userdb['introduce']=$prointroduce;
		if (!empty($propwd)){
			$propwd!=$check_pwd && Showmsg('password_confirm');
			$S_key=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
			foreach($S_key as $value){
				if (strpos($propwd,$value)!==false){ 
					ErrorMsg('密码还有非法字符！', 'profile.php?action=modify');
				}
			}
			$userdb['password']=$propwd;
			$userdb['password']=md5($userdb['password']);
		}

		//公开与接收邮件
		//合法性检测		
		//脏词过滤
		
		$proyear=Request('proyear');
		$promonth=Request('promonth');
		$proday=Request('proday');
		if (!empty($proyear)||!empty($promonth)||!empty($proday)){
			$userdb['bday']=$proyear."-".$promonth."-".$proday;
		}
		$userdb['site']		= Char_cv($userdb['site']);
		$userdb['introduce']= Char_cv($userdb['introduce']);
		$userdb['signature']= Char_cv($userdb['signature']);	 
		$userdb['location'] = Char_cv($userdb['location']);

		//签名
		$lxsign=$userdb['signature'];
		if ($lxsign==$userdb['signature']){
			$userdb['signchange']=1;
		} else{
			$userdb['signchange']=2;
		}
		
		//个人图标
		$userdb['icon']=Request('proicon');

		//更新
		$ArrField=array('password', 				'email', 				'gender', 				'signature', 					'introduce', 				'oicq', 				'site', 				'location',				  'bday',					'icon');
		$ArrValue=array($userdb['password'],$userdb['email'],$userdb['gender'],$userdb['signature'],$userdb['introduce'],$userdb['oicq'],$userdb['site'],$userdb['location'],$userdb['bday'],$userdb['icon'] );
		if($MyDatabase->Update('users', $ArrField, $ArrValue, 'uid='.$user->uid)){
			ErrorMsg('用户数据更新成功！', 'profile.php?action=modify');
		}else{
			ErrorMsg($MyDatabase->SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：修改失败！请后退','profile.php?action=modify');
		}
	}
}

//require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');

?>