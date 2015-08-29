<?php
require('common.php');
$page_name	= 'refresh.php';

//接受所有参数
$id									= $_POST["id"];
$title							= $_POST['title'];
$url								= $_POST['url'];
$url1								= $_POST['url1'];
$url2								= $_POST['url2'];
$urlext							= $_POST['urlext'];
$urlfill						= $_POST['urlfill'];
$cateid							= $_POST['cateid'];
$flagstart					= EnCodeStr($_POST['flagstart']);
$flagend						= EnCodeStr($_POST['flagend']);
$flagcontentstart		= EnCodeStr($_POST['flagcontentstart']);
$flagcontentend			= EnCodeStr($_POST['flagcontentend']);
$flagadstart				= $_POST['flagadstart'];
$flagadstartarray		=	'';
$flagadend					= $_POST['flagadend'];
$flagadendarray			= '';
$flagsingle					= $_POST['flagsingle'];
$flagsinglearray		= '';

//UTF-8
$utf8								= $_POST['utf8'];	

for($i=0;$i<count($flagadstart);$i++)
{
	if ($flagadstart[$i] !='')
	{
		if ($flagadstartarray == '')
		{
			$flagadstartarray	= $flagadstart[$i];
			$flagadendarray		= $flagadend[$i];
		}
		else
		{
			$flagadstartarray	.= ','.$flagadstart[$i];
			$flagadendarray		.= ','.$flagadend[$i];
		}
	}
}

for($i=0;$i<count($flagsingle);$i++)
{
	if ($flagsingle[$i] !='')
	{
		if ($flagsinglearray == '')
		{
			$flagsinglearray	= $flagsingle[$i];
		}
		else
		{
			$flagsinglearray	.= ','.$flagsingle[$i];
		}
	}
}

$SqlStr = 'UPDATE `'.table_pre.'source` SET ';

//标题
$SqlStr .= '`title`=';
$SqlStr .= '\'' . $title . '\',';

//网址
$SqlStr .= '`url`=';
$SqlStr .= '\'' . $url . '\',';

//utf8
$SqlStr .= '`utf8`=';
$SqlStr .= '\'' . $utf8 . '\',';

//批量网址1
$SqlStr .= '`url1`=';
$SqlStr .= '\'' . $url1 . '\',';

//批量网址2
$SqlStr .= '`url2`=';
$SqlStr .= '\'' . $url2 . '\',';

//后缀补全
$SqlStr .= '`urlext`=';
$SqlStr .= '\'' . $urlext . '\',';

//网址补全
$SqlStr .= '`urlfill`=';
$SqlStr .= '\'' . $urlfill . '\',';

//栏目编号
$SqlStr .= '`cateid`=';
$SqlStr .= '\'' . $cateid . '\',';

//起始标记
$SqlStr .= '`flagstart`=';
$SqlStr .= '\'' . $flagstart . '\',';

//结束标记
$SqlStr .= '`flagend`=';
$SqlStr .= '\'' . $flagend . '\',';

//内容开始标记
$SqlStr .= '`flagcontentstart`=';
$SqlStr .= '\'' . $flagcontentstart . '\',';

//内容结束标记
$SqlStr .= '`flagcontentend`=';
$SqlStr .= '\'' . $flagcontentend . '\',';

//广告开始标记Array
$SqlStr .= '`flagadstart`=';
$SqlStr .= '\'' . EnCodeStr($flagadstartarray) . '\',';

//广告结束标记Array
$SqlStr .= '`flagadend`=';
$SqlStr .= '\'' . EnCodeStr($flagadendarray) . '\',';

//单项替换
$SqlStr .= '`flagsingle`=';
$SqlStr .= '\'' . EnCodeStr($flagsinglearray) . '\',';

//更新日期
$SqlStr .= '`posttime`=';
$SqlStr .= '\'' . date("Y-m-d",time()) . '\'';


$SqlStr.=  ' WHERE `id`=' . $id;

query( $SqlStr );

$refresh_msg	= '采集规则[<font color="#FF0000">'.$title.'</font>]，修改添加成功，返回修改页面。';
$refresh_url	= 'source_edit.php?id='.$id;

require($page_name.'.php');
require('../include/debug.inc.php');
?>