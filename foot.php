<?php
//更新用户访问信息
if($user->uid!=''){
	$SqlStr = 'UPDATE `' . DB_TABLE_PRE . 'user_ext` SET thisvisit=' . TIMESTAMP . ' WHERE uid=' . $user->uid;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->ExecuteQuery ()) {
	} else {
		ErrorMsg ( $SqlStr . '文件：' . __FILE__ . '<br />行数：' . __LINE__ . '<br />原因：更新用户状态失败！' );
	}
}

//Gzip是否启用
$str_gzip='<font color=red>disable</font>';
if(Extension_Loaded('zlib')){
	$str_gzip='<font color=green>enable</font>';
}

//SQL查询次数
$str_sqlcount=$MyDatabase->QueryCount;

//代码执行时间
$str_processtime=getprocesstime($startime);

require(TP.'foot.php');
?>