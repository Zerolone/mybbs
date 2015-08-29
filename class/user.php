<?php
/**
 * 用户类  
 * 
 * @version 2010-4-20 17:01:50
 * @author Zerolone
 */

class User {
	public $uid; 			//编号
	public $username; //用户名
	public $password; //密码
	public $groupid; 	//组编号
	public $lastpost;	//最后发帖时间
	public $ip;				//
	public $theme;    //风格
	

	public $pm;				//短信	
	public $postnum;	//发帖数
	
	public $icon;
	public $rvrc;
	public $money;
	public $regdate;

	/**
	 * 初始化用户，从Cookies里面获取内容
	 * 
	 */
	public function __construct() {
		$this->username 	= $this->getCookie('username');
		$this->password 	= $this->getCookie('password');
		$this->groupid		= 0;
		$this->theme			= $this->getCookie('theme');
	}
	
	/**
	 * 写入Cookies
	 * @param 名 $name
	 * @param 值 $value
	 * @param 有效期 $expire
	 * @param 路径 $path
	 * @param 域名 $domain
	 */
	public function setCookie($name, $value, $expire) {
		$secure		 = $_SERVER['SERVER_PORT'] == '443' ? 1:0;
		setCookie($name, $value, $expire,DB_CKPATH,DB_CKDOMAIN,$secure);		
	}
	
	/**
	 * 
	 * @param Cookie名 $Value
	 */
	private function getCookie($Value){
		if (isset($_COOKIE[$Value])){
			return $_COOKIE[$Value];
		}else {
			return '';
		}
	}
	
	/**
	 * 写入Cookies
	 * 
	 * @param 超时 $expire
	 */
	public function writeCookies($expire){
		$this->setCookie ('uid',       $this->uid, 			$expire);
		$this->setCookie ( 'username', $this->username, $expire);
		$this->setCookie ( 'password', $this->password, $expire);
		$this->setCookie ( 'groupid',  $this->groupid, 	$expire);
		$this->setCookie ( 'lastpost', $this->lastpost, $expire);
		$this->setCookie ( 'ip',       $this->ip,       $expire);		
	}
	
	/**
	 * 情况Cookies
	 */
	public function clearCookies() {
		$this->setCookie ( 'uid', '', 0 );
		$this->setCookie ( 'username', '', 0 );
		$this->setCookie ( 'password', '', 0 );
		$this->setCookie ( 'groupid', '', 0 );
		$this->setCookie ( 'lastpost', '', 0 );
		$this->setCookie ( 'theme',    '', 0 );		
	}		
	
	/**
	 * 检测用户是否存在
	 * 
	 * @param 用户名 $username
	 * @param 密码 	$password
	 * @param 数据库 $MyDatabase
	 */
	public function checkUser($MyDatabase, $username, $password) {
		if ($username==''){
			$username=$this->username;
		}
		if ($password==''){
			$password=$this->password;
		}
				
		$SqlStr = 'SELECT *  FROM `' . DB_TABLE_PRE . 'view_user` WHERE `username`=\'' . $username . '\';';
		$MyDatabase->SqlStr = $SqlStr;
		$users='';
		if ($MyDatabase->Query ()) {
			$users = $MyDatabase->ResultArr [0];
		}
		
		$refresh_msg='';
		if ($users) {
			$this->uid 			= $users ['uid'];
			$this->username = $users ['username'];
			$this->password = $users ['password'];
			$this->lastpost = $users ['lastpost'];
			$this->groupid 	= $users ['groupid'];
			$this->lastpost	= $users ['lastpost'];
			$this->newpm		= $users ['newpm'];
			
			$this->postnum	= $users ['postnum'];
			$this->icon			= $users ['icon'];
			$this->rvrc			= $users ['rvrc'];
			$this->money		= $users ['money'];
			$this->regdate	= $users ['regdate'];
			
			$this->ip				= $this->GetIP();
				
			if ($users ['active'] > 2)
				$refresh_msg = '用户需要激活，请稍等！';
				
			//如果密码相等
			if ($this->password == $password) {
				$this->groupid = ( int ) $users ['groupid'];				
			} else {
				$refresh_msg = '登录密码错误！';
			}
		} else {
			$refresh_msg = '用户不存在！';
		}
		
		return $refresh_msg;
	}
	
	/**
	 * 获取用户组信息
	 * @param $MyDatabase
	 */
	public function getGroupInfo($MyDatabase) {
		if ($this->groupid != '') {
			$SqlStr = 'SELECT * FROM `' . DB_TABLE_PRE . 'user_group` WHERE `gid`=' . $this->groupid;
			$SqlStr .= ' LIMIT 1;';
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				return $MyDatabase->ResultArr [0];
			}
		}	
	}

	/**
	 * 获取客户端IP
	 */
	private function GetIP() {
		if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
			$ip = getenv ( "HTTP_CLIENT_IP" );
		else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
			$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
		else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
			$ip = getenv ( "REMOTE_ADDR" );
		else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
			$ip = $_SERVER ['REMOTE_ADDR'];
		else
			$ip = "unknown";
		return ($ip);
	}	
}
?>