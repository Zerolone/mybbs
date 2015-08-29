<?php
/**
 * 更新最后回复状态
 * 
 * @param $fid
 * @param $tid
 * @param $type
 * @param $mybbs_id
 * @param $MyDatabase
 * @param $atc_title
 */
function lastinfo($fid,$tid,$type='',$mybbs_id, $MyDatabase, $atc_title){
	$nowtime=date('Y-m-d H:i:s', time());
	$title  = subString($atc_title,24);
	//发帖
	if($type == 'new'){
		$topicadd = ",topic=topic+1,post=post+1";
	} 
	//回帖
	elseif($type == 'reply'){
		$topicadd = ",post=post+1";
	}
	
	$new_url  = 'read.php?tid='.$tid;
	$lastpost = $title."\t".addslashes($mybbs_id)."\t".$nowtime."\t".$new_url;

	//更新最后回复时间
	$SqlStr='UPDATE `'.DB_TABLE_PRE.'forums` SET `lastpost`=\''.$lastpost.'\''. $topicadd . '   WHERE `fid`='.$fid;
	$MyDatabase->SqlStr=$SqlStr;
	if ($MyDatabase->ExecuteQuery()){
	}else {
		echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';DebugStr($MyDatabase->SqlStr);
		ErrorMsg('更新首页显示栏目最新发帖失败！');
	}	
}

function bbspostguide($user, $top_post, $MyDatabase){
	//用户组不为游客时
	if($user->groupid != ''){
		$user->lastpost = TIMESTAMP;
		$user->postnum++;
		
		if($top_post){
			$addrvrc  = CREDIT_POST_RVRC;
			$addmoney = CREDIT_POST_MONEY;
		} else{
			$addrvrc  = CREDIT_REPLAY_RVRC;
			$addmoney = CREDIT_REPLAY_MONEY;
		}
		
		$groupid=$user->groupid;
		$postnum=0;
		//获取用户当前组的postnum
		$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'user_group` WHERE `gid`=' .$groupid. ' LIMIT 1;';
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$postnum = $MyDatabase->ResultArr [0]['post'];
		}
		
		//如果postnum不为0，则判断用户是否可以升级
		if($postnum>0){
			$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'user_group` WHERE `post`<='.($user->postnum) . ' AND `post`!=0 ORDER BY `order` DESC LIMIT 1;';
			$MyDatabase->SqlStr = $SqlStr;
			if ($MyDatabase->Query ()) {
				$groupid = $MyDatabase->ResultArr [0]['gid'];
			}

			if ($user->groupid!=$groupid){
				$SqlStr='UPDATE `'.DB_TABLE_PRE.'users` SET `groupid`='.$groupid.' WHERE uid='.$user->uid;
				$MyDatabase->SqlStr=$SqlStr;
				if ($MyDatabase->ExecuteQuery()){
				}else {
					ErrorMsg($MyDatabase->SqlStr. '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：更新用户等级失败！');
				}			
			}
		}
		
		//开始更新用户的奖励
		$SqlStr='UPDATE `'.DB_TABLE_PRE.'user_ext` SET `postnum`='.$user->postnum.',`rvrc`=`rvrc`+'.$addrvrc.',`money`=`money`+'.$addmoney.',lastpost='.$user->lastpost.' WHERE uid='.$user->uid;
		$MyDatabase->SqlStr=$SqlStr;
		if ($MyDatabase->ExecuteQuery()){
		}else {
			ErrorMsg($SqlStr . '文件：'.__FILE__ . '<br />行数：'.__LINE__ . '<br />原因：更新用户的奖励失败！');
		}
		
		//更新cookie
		setCookie ( 'lastpost', TIMESTAMP);
	}else{	
		Cookie('userlastptime',TIMESTAMP);
	}
}

/**
 * 文件上传功能
 * 
 * @param $tmp_name	临时文件名
 * @param $filename	存储文件名
 */
function postupload($tmp_name,$filename){
	if(strpos($filename,'..')!==false || eregi("\.php$",$filename)){
		ErrorMsg('文件类型错误！');
	}
	
	if(function_exists("move_uploaded_file") && @move_uploaded_file($tmp_name,$filename)){
		@chmod($filename,0777);
		return true;
	}elseif(@copy($tmp_name, $filename)){
		@chmod($filename,0777);
		return true;
	}elseif(is_readable($tmp_name)){
		writeover($filename,readover($tmp_name));
		if(file_exists($filename)){
			@chmod($filename,0777);
			return true;
		}
	}
	return false;
}
?>