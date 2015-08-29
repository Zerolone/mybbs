<?php
/**
 * 用户组|编辑添加、修改
 * 
 * @version 2010-3-20 22:30:48
 * @author Zerolone
*/

require('../include/common.php');

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';

$page_name	= '../../include/refresh.php';

$refresh_url	= 'group.php';
$refresh_txt	= '失败';

$mode					= Request('mode');						//提交方式， add为添加， edit为修改
$gid					= Request('gid',0);						//编号
$title				= Request('title');						//标题
$order				= Request('order',1);					//顺序
$online				= Request('online');					//在线图标
$offline			= Request('offline');					//离线图标
$post					= Request('post',0);					//升级贴数
$allowicon		= Request('allowicon',0);			//是否允许用户使用自定义头像
$allowpost		= Request('allowpost',0);			//是否允许回复主题
$allowreply		= Request('allowreply',0);		//是否允许发表主题
$allowsearch	= Request('allowsearch',0);		//搜索权限控制
$allowprofile	= Request('allowprofile',0);	//允许查看会员资料
$allowmessege	= Request('allowmessege',0);	//允许发送短消息
$allowupload	= Request('allowupload',0);		//允许上传附件
$edittime			=	Request('edittime',0);			//编辑时间约束(分)
$post_check		= Request('post_check',0);		//发贴审核
$reply_check	= Request('reply_check',0);		//回复审核

$ArrField=array('title','order','online','offline','post','allowicon','allowpost','allowreply','allowsearch','allowprofile','allowmessege','allowupload','edittime','post_check','reply_check');
$ArrValue=array($title, $order, $online, $offline, $post, $allowicon, $allowpost, $allowreply, $allowsearch, $allowprofile, $allowmessege, $allowupload, $edittime, $post_check, $reply_check);

//添加
if (isset($_POST['s_add'])) {
	if ($MyDatabase->Insert ( 'user_group', array('title'), array('') )){
		$refresh_txt='成功';	
	}
	
	$refresh_msg = '用户组：添加'.$refresh_txt.'，点击关闭。';	
	$log_content = '用户组 &gt;&gt; 添加 '.$refresh_txt;
} 
//修改
elseif ($mode == 'edit') {
	if($MyDatabase->Update ( 'user_group', $ArrField, $ArrValue, '`gid`=' . $gid )){	
		$refresh_txt='成功';
	}
	
	$refresh_msg = '用户组：[<font color=red>' . $title . '</font>]，修改'.$refresh_txt;
	$log_content = '用户组 &gt;&gt; 修改 &gt;&gt; 【' . $title . '】'.$refresh_txt;
}
//删除
elseif ($mode == 'del') {
	if($MyDatabase->Delete ( 'user_group', '`gid`=' . $gid )){
		$refresh_txt='成功';
	}
	
	$refresh_msg = '用户组删除'.$refresh_txt;
	$log_content = '用户组 &gt;&gt; 删除 &gt;&gt; 【' . $title . '】'.$refresh_txt;
}
//顺序
elseif (isset($_POST['s_list_order'])){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if($MyDatabase->Update('user_group',array('order'),array($_POST["order"][$i]),'`gid`='. $_POST["gid"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '用户组顺序修改：[<font color=red>'.$refresh_txt.'</font>]，点击返回。';
	$log_content	= '用户组顺序 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}

//组名
elseif (isset($_POST['s_list_title'])){
	for($i = 0;$i<sizeof( $_POST["title"] );$i++){
		if($MyDatabase->Update('user_group',array('title'),array($_POST["title"][$i]),'`gid`='. $_POST["gid"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '用户组名修改：[<font color=red>'.$refresh_txt.'</font>]，点击返回。';
	$log_content	= '用户组名 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}

//升级贴数
elseif (isset($_POST['s_list_post'])){
	for($i = 0;$i<sizeof( $_POST["post"] );$i++){
		if($MyDatabase->Update('user_group',array('post'),array($_POST["post"][$i]),'`gid`='. $_POST["gid"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '用户组升级贴数修改：[<font color=red>'.$refresh_txt.'</font>]，点击返回。';
	$log_content	= '用户组升级贴数 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}

//编辑超时
elseif (isset($_POST['s_list_edittime'])){
	for($i = 0;$i<sizeof( $_POST["edittime"] );$i++){
		if($MyDatabase->Update('user_group',array('edittime'),array($_POST["edittime"][$i]),'`gid`='. $_POST["gid"][$i])){
			$refresh_txt = '成功';
		}
	}
	
	$refresh_msg	= '用户组可编辑时间修改：[<font color=red>'.$refresh_txt.'</font>]，点击返回。';
	$log_content	= '用户组可编辑时间 &gt;&gt; 修改 &gt;&gt; '.$refresh_txt;
}

require($page_name.'.php');

require('../../include/debug.php');
require('../../include/log.php');
?>