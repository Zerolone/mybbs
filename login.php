<?php 
/**
 * 登录与退出
 * 
 * @version	2010-3-23 14:56:08
 * @author		Zerolone
 * 
 */
require('include/common.php');
$pagename='login.php';
$refresh_msg='';

//获取状态，默认为登录
$action=Request('action','login');

//获取来源URL，没有的话就用默认的
!($pre_url=@$_SERVER['HTTP_REFERER']) && $pre_url = BBS_INDEX;
if(strpos($pre_url,'login.php')!==false || strpos($pre_url,'reg.php')!==false) {
	$pre_url = BBS_INDEX;
}

if ($user->groupid!='' && $action!="quit"){
	ErrorMsg('你已经登录!',$pre_url);
}

//获取步骤，1为登录页面，2为登录提交功能
$step=Request('step',1);
if ($action=="login"){
	if ($step==1){		
	} elseif($step==2){
		//获取用户名，密码
		$username	= Request('username');
		$password	= Request('password');

		//如果用户名、密码都有值的话，则
		if($username && $password){
			//加密密码
			$password=md5($password);
			
			$refresh_msg = $user->checkUser($MyDatabase, $username, $password);				
		} else{
			$refresh_msg='用户名密码全都不能为空！';
		}
			
		//写入用户Cookies
		if ($refresh_msg == '') {
			
			//cookie有效期
			$cktime = Request ( 'cktime' );
			if ($cktime != 0) {
				$cktime += TIMESTAMP;
			}
			
			$user->writeCookies($cktime);
			$refresh_msg='登录成功，返回首页。';
		}

		ErrorMsg($refresh_msg,$pre_url);
	}
} elseif($action=="quit"){
	$user->clearCookies();
	ErrorMsg('退出成功！<a href="'.BBS_INDEX.'">返回首页</a>');	
}

require('include/debug.php');
require(TP.'head.php');
require(TP.$pagename);
require('foot.php');
?>