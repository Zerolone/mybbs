<?php
/**
* 页面功能：文章标题采集抓取、入库
* 创建日期：2008-9-20 8:33:07
* 修改日期：
* 文 件 名：/manage/article/snatch_title.php
* 作    者：Zerolone
*/
require../include/common.php;

set_time_limit(300);
?>
<link href="/css/manage.css" type=text/css rel=stylesheet>

<?php
/*	时间：2006年10月24日
//	作者：Zerolone
//  功能：采集标题以及连接并且入库
//*/

//--------------------------------------
//-------------函数部分-----------------
//--------------------------------------
/**
* 得到一个字符串中的某一部分
* @param  $Url 需要抓取的地址
* @param  $UrlFill 填充地址,例如<a href="aaa.php">aaa</a>，这样的地址就需要用到Fill
* @param  $Url1 递增抓取，例如aaa.php?page=1 这时Url就为aaa.php?page=
* @param  $UrlExt  地址后缀
* @param	$FlagStart		过滤广告开始、结束标志
* @param	$FlagEnd
* @param	$CateId		栏目编号
* @param	$SourceId 抓取栏目
* @param	$utf8 编码方式
* @return  String  返回剪切后的数据
*/		
function getContentTitle ( $Url, $UrlFill, $Url1, $UrlExt, $FlagStart, $FlagEnd, $CateId, $SourceId, $utf8)
{
	//$CatchCount为计数器
	$CatchCount=0;
	//获取源数据
	if ($Url1==0)
	{
		$Content = file_get_contents( $Url );
	}
	else
	{
		$Content = file_get_contents( $Url.$Url1.$UrlExt );
	}
	//echo $Content;

	/*
	Zerolone Add 07-04-28
	如果是UTF-8编码的则
	//*/
	if($utf8)
	{
		$Content=mb_convert_encoding($Content, "GB2312", "UTF-8");
	}

	$Content	= EnCodeStr($Content);
	
	//切割数据
	$Content			= CutStr($Content, $FlagStart, $FlagEnd);
	//echo $Content;

	//切割Url
	preg_match_all( "/<a[[:space:]](.*?)<\/a>/i", DeCodeStr($Content), $list );
	$list = $list[0];

	for ( $i = 0; $i < count( $list ); $i++ )
	{
		//内容
		preg_match_all( "/>(.*?)<\/a>/i", $list[$i], $templ );

		//地址 Url
		//preg_match_all( "/href=(\"|'|)(.*?)(\"|'|)[[:space:]]/i", $list[$i], $tempc );
		/* preg_match_all( "/<a.+href=('|\"|)?(.*)(\\1)([\s].*)?>/ismUe", $list[$i], $tempc );
		//*/
		preg_match_all( "/href=('|\"|)?(.*)(\\1)([\s].*)?>/ismUe", $list[$i], $tempc );


		//获取的数据正确
		if( !empty( $templ[1][0] ) && !empty( $tempc[2][0] ) )
		{
			$listContent[$i][0] = $templ[1][0];
			$listContent[$i][1] = $tempc[2][0];

			$TheTitle	= $listContent[$i][0];
			$TheUrl		= $listContent[$i][1];

			$SqlStr	= 'SELECT `id` FROM `'.table_pre.'article` WHERE `title`=\'' . $TheTitle . '\' OR `url`=\'' . $TheUrl . '\'';
			//			echo $SqlStr;
			$temp_query = query($SqlStr);
			if(nqfetch($temp_query))
			{
				//已经抓取过
				continue;
			}
			else
			{
				$CatchCount++;
				echo '第'.$CatchCount.'条';
				echo '<br>标题：';
				echo $TheTitle;
				echo '<br>地址：';
				echo $UrlFill.$TheUrl;

				//入库
				$SqlL = 'insert into `'.table_pre.'article` (';
				$SqlR = 'values (';

				//标题
				$SqlL .= '`title`,';
				$SqlR .= '\'' . $TheTitle . '\',';

				//地址
				$SqlL .= '`url`,';
				$SqlR .= '\'' . $UrlFill.$TheUrl . '\',';

				//所属栏目
				$SqlL .= '`cateid`,';
				$SqlR .= $CateId . ',';

				//添加时间
				$SqlL .= '`posttime`,';
				$SqlR .= '\'' . date("Y-m-d",time()) . '\',';

				//所属抓取类
				$SqlL .= '`sourceid`)';
				$SqlR .= $SourceId . ')';

				query($SqlL.$SqlR);
//				echo $SqlL.$SqlR;
				echo "<font color =red>抓取成功！</font><hr>";
			}

			flush();
			usleep(300);
		}
	}

//	return $listContent;
}

//--------------------------------------
//-------------使用部分-----------------
//--------------------------------------
$id	= $_GET["id"];
//------------------0--------1--------2--------3---------4----------5-----------6-------7---------8
$SqlStr	= 'SELECT `url`, `urlfill`, `url1`, `url2`, `flagstart`, `flagend`, `cateid`, `urlext`, `utf8` From `'.table_pre.'article_source` WHERE `id`=\'' . $id . '\'';
$temp_query = query($SqlStr);
//echo $SqlStr;
while($DB_Record = nqfetch($temp_query))
{
	$Url					= $DB_Record[0];
	$UrlFill			= $DB_Record[1];
	$Url1 				= $DB_Record[2];
	$Url2 				= $DB_Record[3];
	$FlagStart 		= $DB_Record[4];
	$FlagEnd			= $DB_Record[5];
	$FlagAdStart	= '';
	$FlagAdEnd		= '';
	$CateId				= $DB_Record[6];
	$UrlExt				= $DB_Record[7];
	$utf8					= $DB_Record[8];
	
	/*
	$Url			= 'http://news.sina.com.cn/news1000/';
	$FillUrl	= '';
	$Url1 = '0';
	$Url2 = '0';
	$FlagStart 	= '&lt;!--新闻开始--&gt;';
	$FlagEnd		= '&lt;!--新闻结束--&gt;';
	$FlagAdStart	= '';
	$FlagAdEnd		= '';
	$CateId				= 0;
	$SourceId			= 0;
	
	//$Url			= 'http://localhost/admin/1.htm';
	//$FlagStart 	= '&lt;html&gt;';
	//$FlagEnd		= '&lt;/html&gt;';

	echo 'Url='.$Url.'<br>';
	echo 'UrlFill='.$UrlFill.'<br>';
	echo 'Url1='.$Url1.'<br>';
	echo 'Url2='.$Url2.'<br>';
	echo 'FlagStart='.$FlagStart.'<br>';
	echo 'FlagEnd='.$FlagEnd.'<br>';
	echo 'CateId='.$CateId.'<br>';
	echo 'SourceId='.$SourceId.'<br>';
	*/
	
	
	if ($Url1==0) 
	{
		getContentTitle($Url, $UrlFill, $Url1, $UrlExt, $FlagStart, $FlagEnd, $CateId, $id, $utf8);	
	}
	else 
	{
		for ($i=$Url2; $i>=$Url1; $i--)
		{	
			flush();
			usleep(300);
			echo "<hr size=1 color=red>抓取地址：".$Url.$i.$UrlExt."<hr>";
			getContentTitle($Url, $UrlFill, $i, $UrlExt, $FlagStart, $FlagEnd, $CateId, $id, $utf8);			
		}
		
	}
}
?>

<?php

//管理员日志
$log_content			= '文章采集管理 &gt;&gt; 采集文章 &gt;&gt 采集编号 '.$id;
require('../../include/log.inc.php');

//require($page_name.'.php');
require('../../include/debug.inc.php');
?>