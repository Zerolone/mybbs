<?php
/**
* 登录检测文件
*
* @author 		Zerolone
* @version 	2009-8-13 11:08:46
*/

//公共包含文件
require('common.php');

$log_content			= "登录后台检测";

$user						= Request('user');
$userpass				= Request('pass');
$usercheck			= Request('usercheck');
$int_usercheck	= Request('int_usercheck');




$usercheck_old			= 0;
if (isset($_SESSION['usercheck'])){
	$usercheck_old		= $_SESSION['usercheck'];	
}

$int_usercheck_old	= count_string($usercheck_old);

if ($user && $userpass && $usercheck){
	//判断认证码是否正确
	if ($int_usercheck==$int_usercheck_old && $usercheck==$usercheck_old){
		$SqlStr	= 'SELECT * From `' .DB_TABLE_PRE. 'view_admin`';
		$SqlStr.= ' WHERE `user`= \'' . $user . '\';';
		$MyDatabase->SqlStr=$SqlStr;
/*
echo $userpass;
echo '<hr>';
echo $SqlStr;
exit();
*/
		$MyDatabase->Query();
		$DB_Record=$MyDatabase->ResultArr[0];
		if($DB_Record){			
			if ($DB_Record['pass']==md5($userpass)){				
				$_SESSION['user']				= $user;
				$_SESSION['userid']			= $DB_Record['id'];
				$_SESSION['permission']	= tostr($DB_Record['permission']);
				$_SESSION['login']			= 1;

			
			}
			else{
				//密码错误
				$log_content			= "密码错误";
			}
		}
		else{
			//用户不存在
			$log_content			= "用户不存在";
		}
	}
	else{
		//认证码出错
		$log_content			= "认证码出错|新：".$usercheck."|旧：".$usercheck_old;		
	}
}


if (isset($_SESSION['userid']) && $_SESSION['userid']>0){
	$log_content			= $user.',登陆成功';
	

	
	//跳转
	Header("Location:index.php");
}else{
	Header("Location:login.php");
}

//管理员日志
$ThisPage='login.php';
require('../include/log.php');


echo $MyDatabase->PrintDebug ();
?>