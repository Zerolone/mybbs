<?php
require('common.php');
set_time_limit(60);

/*	时间：2006年10月25日
//	作者：Zerolone
//  功能：采集内容并且入库
//*/


//--------------------------------------
//-------------函数部分-----------------
//--------------------------------------
/**
* 得到一个字符串中的某一部分
* @param  $Url 需要抓取的地址
* @param  $ArticleId  入库文章编号
* @param  $ContentStartFlag	文章内容开始、结束
* @param  $ContentEndFlag
* @param	$FlagAdStart				过滤广告开始、结束标志
* @param	$FlagAdEnd
* @param	$FlagSingle					单项过滤
* @param	$ImagePath					图片保存地址
* @param	$ImageUrl						图片显示地址
*/		
function getContent ( $Url, $id, $ContentStartFlag, $ContentEndFlag, $FlagAdStart, $FlagAdEnd, $FlagSingle, $ImagePath, $ImageUrl, $utf8)
{
	//获取源数据
	$Content = file_get_contents( $Url );
	//echo $Content;
	$Content	= EnCodeStr($Content);
	//echo $Content;

	/*
	Zerolone Add 07-04-28
	如果是UTF-8编码的则
	//*/
	if($utf8)
	{
		$Content=mb_convert_encoding($Content, "GB2312", "UTF-8");
	}
	

	//切割数据
	$Content			= CutStr($Content, $ContentStartFlag, $ContentEndFlag);
	//echo $Content;

	//切割广告
	//*//
	$FlagAdStartArray	=	explode(",", $FlagAdStart);
	$FlagAdEndArray		=	explode(",", $FlagAdEnd);
	for($i=0;$i<count($FlagAdStartArray);$i++)
	{
		$Content			= CutStr($Content, $FlagAdStartArray[$i], $FlagAdEndArray[$i], 1);
	}
	//*/
	//echo $Content;
	
	//单项替换
	$FlagSingleArray	=	explode(",", $FlagSingle);
	for($i=0;$i<count($FlagSingleArray);$i++)
	{
		$Content			= str_replace($FlagSingleArray[$i], '', $Content);
	}	
	echo $Content;
	
	//获取图片路径
	preg_match_all( "/src=(\"|')(.*?)(\"|')/i", DeCodeStr($Content), $temp );
		
	$imageList = $temp[2];
	//echo $imageList;
	
	//建立文件夹
	if (!is_dir($ImagePath)) {
		mkdir($ImagePath);
	}
	
	$ImagePath.='/'. date("m",time());
	if (!is_dir($ImagePath)) {
		mkdir($ImagePath);
	}

	$ImagePath.='/'. date("d",time()) . '/';
	if (!is_dir($ImagePath)) {
		mkdir($ImagePath);
	}
	
	//网页上面的路径
	$ImageUrl			.= date("m",time()).'/'.date("d",time()).'/';
	
	for ( $i = 0; $i < count( $imageList ); $i++ )
	{
		$fName = saveFile( $imageList[$i], $ImagePath, $ImageUrl);
		if( !empty( $fName ) )
		{
			$filename[$i] = $fName;
		}
	}
	
	for ( $i = 0; $i < count( $imageList ); $i++ )
	{
		$Content = str_replace( $imageList[$i], $ImageUrl.$filename[$i], $Content );
	}
	
	/*
	echo '<hr>';
	echo decode($TheContent);
	echo '<hr>';
	exit();
	//*/

	/*
	//去掉无用的页面脚本
	//去掉js	
	$cp = preg_replace( "@\<script(.*?)\</script\>@is", "", $cp );

	//去掉HTML
	//去Table
	$cp = preg_replace( "@\<table(.*?)\</table\>@is", "", $cp );
	//去Tr
	$cp = preg_replace( "@\<tr(.*?)\</tr\>@is", "", $cp );
	//去Td
	$cp = preg_replace( "@\<td(.*?)\</td\>@is", "", $cp );
	//去div
	$cp = preg_replace( "@\<div(.*?)\</div\>@is", "", $cp );

	//去iframe
	$cp = preg_replace( "@\<iframe(.*?)\</iframe\>@is", "", $cp );

	//去掉css
	//$cp = preg_replace( "@\<style(.*?)\</style\>@is", "", $cp );
	*/

	//去掉超连接
	$Content = preg_replace( EnCodeStr("@\<a(.*?)\>@is"), "", $Content );

	//去<!-- -->
	$Content = preg_replace( EnCodeStr("@\<!--(.*?)\--\>@is"), "", $Content );
	

	//页面内容入库
	$SqlStr = 'UPDATE `'.table_pre.'article` SET ';
			
	//文章内容
	$SqlStr .= '`flag`=1,';
	
	//文章内容
	$SqlStr .= '`content`=';
	$SqlStr .= '\'' . $Content . '\'';

	$SqlStr.=  ' WHERE `id`=' . $id;	
//	echo $SqlStr;
	query( $SqlStr);	

	return true;
}

//--------------------------------------
//-------------使用部分-----------------
//--------------------------------------
$id	= $_GET["id"];
//--------------------0---------1----------2-----------------------3--------------------4------------------5----------------6------------7-----------------8
$SqlStr	= 'Select  `a`.`id`, `a`.`url`, `b`.`flagcontentstart`, `b`.`flagcontentend`,`b`.`flagadstart`, `b`.`flagadend`, `a`.`title`, `b`.`flagsingle`, `b`.`utf8`  From `'.table_pre.'article` a, `'.table_pre.'source` b where a.sourceid=b.id and `a`.`id`=' . $id;
$temp_query = query($SqlStr);
//echo $SqlStr;
while($DB_Record = nqfetch($temp_query))
{
	$id								= $DB_Record[0];
	$Url							= $DB_Record[1];
	$ContentStartFlag	= $DB_Record[2];
	$ContentEndFlag		= $DB_Record[3];
	$FlagAdStart 			= $DB_Record[4];
	$FlagAdEnd 				= $DB_Record[5];
	$Title						= $DB_Record[6];
	$FlagSingle				= $DB_Record[7];
	$utf8							= $DB_Record[8];

	///*
	echo '<hr>Url='.$Url.'<br>';
	echo 'id='.$id.'<br>';
	echo 'ContentStartFlag='.$ContentStartFlag.'<br>';
	echo 'ContentEndFlag='.$ContentEndFlag.'<br>';
	echo 'FlagAdStart='.$FlagAdStart.'<br>';
	echo 'FlagAdEnd='.$FlagAdEnd.'<br>';
	//*/
	
	$CatchOk	= getContent($Url, $id, $ContentStartFlag, $ContentEndFlag, $FlagAdStart, $FlagAdEnd, $FlagSingle, $ImagePath, $ImageUrl, $utf8);
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-cn" />
<style>*{font-size: 12px;}</style>
<?php
if ($CatchOk) {
		echo '[<font color=red>抓取成功</font>]'.$Title;
}
else 
{
		echo '[<font color=blue>抓取失败，请重新尝试</font>]'.$Title;
}

require("../include/debug.inc.php");
?>