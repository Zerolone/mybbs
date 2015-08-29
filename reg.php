<?php 
/**
 * 注册
 * 
 * @version	2010-5-10 22:48:26
 * @author		Zerolone
 * 
 */

require('include/common.php');
define('PAGENAME','reg.php');

//步骤
$step=Request('step',0);

//默认的时候，显示注册条款

if($step==1){
			//头像
		$img=@opendir(TP.'images/face');
		$imgselect='';
		while ($imagearray=@readdir($img)){
			if ($imagearray!='.' && $imagearray!='..' && $imagearray!='' && $imagearray!='none.gif'){
				$imgselect.= '<option value="'.$imagearray.'">'.$imagearray."</option>";
			}
		}
		@closedir($img);		
}

//如果为提交的第二步，即注册
elseif($step==2){
	$regname=Request('regname');
	$regpwd=Request('regpwd');
	$regicon=Request('regicon');
	$regreason    = Request('regreason');
	$reghomepage  = Request('reghomepage');
	$regfrom	  = Request('regfrom');
	$regintroduce = Request('regintroduce');
	$regsign	  =	Request('regsign');
	$regemail	  =	Request('regemail');
	
	//字符长度
	if (strlen($regname)>$rg_regmaxname || strlen($regname)<$rg_regminname){
		Showmsg('reg_username_limit');
	}
	$S_key=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
	foreach($S_key as $value){
		if (strpos($regname,$value)!==false){
			Showmsg('illegal_username');
		}
		if (strpos($regpwd,$value)!==false){
			Showmsg('illegal_password');
		}
	}
	if(!$rg_rglower){
		for ($asc=65;$asc<=90;$asc++){
			if (strpos($regname,chr($asc))!==false){
				Showmsg('username_limit');
			}
		}
	}

	if(strpos($regicon,'..')!==false){
		Showmsg('undefined_action');
	}
	$regicon=Char_cv($regicon);

	$rg_name      = Char_cv($regname);
	$regpwd       = Char_cv($regpwd);
	$rg_pwd       = md5($regpwd);
	$regreason    = Char_cv($regreason);
	$rg_homepage  = Char_cv($reghomepage);
	$rg_from	  = Char_cv($regfrom);
	$rg_introduce = Char_cv($regintroduce);
	$rg_sign	  =	Char_cv($regsign);
	if(strlen($rg_introduce)>200) Showmsg('introduce_limit');
	if($rg_sign != ""){
		if(strlen($rg_sign)>50){
			$gp_signnum=50;
			Showmsg('sign_limit');
		}
		require_once(R_P.'require/bbscode.php');
		$lxsign=convert($rg_sign,$db_windpic,2);
		if($lxsign==$rg_sign){
			$rg_ifconvert=1;
		} else{
			$rg_ifconvert=2;
		}
	} else{
		$rg_ifconvert=1;
	}
	if(@include_once(D_P."data/bbscache/wordsfb.php")){
		if($wordsfb){
			foreach($wordsfb as $key => $value){
				if(strpos($rg_sign,(string)$key) !== false){
					$banword = $key;
					Showmsg('post_wordsfb');
				}
				if(strpos($rg_introduce,(string)$key) !== false){
					$banword = $key;
					Showmsg('post_wordsfb');
				}
			}
		}
	}
	if (strpos($regpwd,"\r")!==false || strpos($regpwd,"\t")!==false || strpos($regpwd,"|")!==false || strpos($regpwd,"<")!==false || strpos($regpwd,">")!==false) {
		Showmsg('illegal_password');
	}
	if (empty($regemail) || !ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$regemail)) {
		echo '邮箱错误';
		exit();
	} else{
		$rg_email=$regemail;
	}
	
	//验证用户名是否合法
	/*
	if($rg_name!==Sql_cv($rg_name)){
		Showmsg('illegal_username');
	}
	*/
	
	//判断用户名是否可用
	$MyDatabase=new Database();
	$SqlStr='SELECT `username` FROM `'.DB_TABLE_PRE.'users` WHERE `username`=\''.$rg_name.'\'';
	$MyDatabase->SqlStr = $SqlStr;
//	DebugStr($SqlStr);
	if ($MyDatabase->Query ()) {
		echo '用户名重复';exit();
	}
	
	if ($rg_name=='guest'){
		echo '不允许的用户名';exit();
	}
	
	$rg_banname=explode(',',$rg_banname);
	foreach($rg_banname as $value){
		if(strpos($rg_name,$value)!==false){
			echo '不允许注册的用户名';exit();
		}
	}
	$regsex=Request('regsex');
	$regbirthyear=Request('regbirthyear');
	$regbirthmonth=Request('regbirthmonth');
	$regbirthday=Request('regbirthday');
	$regoicq=Request('regoicq');
	
	$rg_sex=$regsex ? $regsex : "0";
	$rg_birth= (!$regbirthyear||!$regbirthmonth||!$regbirthday)?'0000-00-00':$regbirthyear."-".$regbirthmonth."-".$regbirthday;
	$rg_oicq=($regoicq ? $regoicq :'');

	if ($regoicq && !ereg("^[0-9]{5,}$",$regoicq)) {
		Showmsg('illegal_OICQ');
	}
	
	$rg_groupid='8';
	if($rg_ifcheck=='1'){
		$rg_groupid='7';//后台控制是否需要验证
	}
	require_once ('data/bbscache/level.php');
	@asort($lneed);
	$rg_memberid=key($lneed);

	$rg_yz=$rg_emailcheck==1 ? $timestamp : 1;
	//是否接受邮件
	$regifemail			= Request('regifemail');
	$rg_ifemail    = (int)$regifemail;
	
	//插入会员表 
	$ArrField=array('username','password','email', 'groupid', 	'icon', 	'gender', 'regdate', 'signature', 'introduce', 'oicq', 'site', 'location', 'bday', 'yz');
	$ArrValue=array($rg_name,   $rg_pwd,  $rg_email,$rg_groupid,$regicon,	$rg_sex,	TIMESTAMP,	$rg_sign,		$rg_introduce,$rg_oicq,$rg_homepage,$rg_from,$rg_birth,$rg_yz);
	if($MyDatabase->Insert('users', $ArrField, $ArrValue)){
		$winduid=$MyDatabase->Insert_id();
	}else{
		echo '添加会员失败！';
		DebugStr($MyDatabase->SqlStr);
		exit();
	}
	
	//插入会员扩展数据表
	$ArrField=array('uid',		'postnum','rvrc', 			'money', 		'lastvisit', 'thisvisit', 'onlineip');
	$ArrValue=array($winduid, 0,  			$rg_regrvrc,	$rg_regmoney,TIMESTAMP,		TIMESTAMP,	ONLINEIP);
	if($MyDatabase->Insert('user_ext', $ArrField, $ArrValue)){
	}else{
		echo '添加会员扩展数据失败！';
		exit();
	}	
		
	//更新论坛信息，最新会员，总会员数
	$SqlStr='UPDATE `'.DB_TABLE_PRE.'bbsinfo` SET `newmember`=\''.$rg_name.'\',`totalmember`=`totalmember`+1 WHERE id=1';
	$MyDatabase->SqlStr=$SqlStr;
	$MyDatabase->ExecuteQuery();
	
	/*
	$ArrField=array('newmember',		'totalmember');
	$ArrValue=array($rg_name, 			'totalmember+1');
	if($MyDatabase->Update('bbsinfo', $ArrField, $ArrValue, '`id`=1')){
	}else{
		echo '更新会员数据失败！';
		DebugStr($MyDatabase->SqlStr);
		exit();
	}*/
	
	$windid=$rg_name;
	$windpwd=$rg_pwd;

	if($rg_yz == 1){
		Cookie("winduser",($winduid."\t".$windpwd));
		Cookie("ck_info",DB_CKPATH."\t".DB_CKDOMAIN);
		Cookie('lastvisit','',0);//将$lastvist清空以将刚注册的会员加入今日到访会员中
	}
	
	$refresh_url='index.php';
	$refresh_msg='用户['.$rg_name.']，注册成功！';
	require '../include/refresh.php.php';	
	exit();
	//refreshto("./$db_bfn",'reg_success');
	
}

require('include/debug.php');
require(TP.'head.php');
require(TP.PAGENAME);
require('foot.php');
?>