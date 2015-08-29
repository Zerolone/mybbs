<?php
require('include/common.php');

$action=Request('action');
$username=Request('username');
if ($action == 'regnameck'){
	include_once("data/bbscache/dbreg.php");
	if (strlen($username) > $rg_regmaxname || strlen($username) < $rg_regminname){
		echo"<script language=\"JavaScript1.2\">parent.retmsg('0');</script>";
		exit;
	}
	$S_key = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
	foreach($S_key as $value){
		if (strpos($username,$value) !== false){
			echo"<script language=\"JavaScript1.2\">parent.retmsg('1');</script>";
			exit;
		}
	}
	if (!$rg_rglower){
		for ($asc=65;$asc<=90;$asc++){
			if (strpos($username,chr($asc)) !== false){
				echo"<script language=\"JavaScript1.2\">parent.retmsg('2');</script>";
				exit;
			}
		}
	}
	$rg_banname=explode(',',$rg_banname);
	foreach($rg_banname as $value){
		if(strpos($username,$value)!==false){
			echo"<script language=\"JavaScript1.2\">parent.retmsg('1');</script>";
			exit;
		}
	}
	$MyDatabase=new Database();
	$SqlStr='SELECT COUNT(*) AS `count` FROM `'.DB_TABLE_PRE.'users` WHERE `username`=\''.$username.'\'';
	$MyDatabase->SqlStr = $SqlStr;
//	DebugStr($SqlStr);
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		
		if ($DB_Record['count']>=1){
			echo '<script language="JavaScript">parent.retmsg("3");</script>';
			exit;
		}
	}
	echo '<script language="JavaScript">parent.retmsg("4");</script>';
	exit;
}
?>