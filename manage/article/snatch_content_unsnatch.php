<?php
/**
* 页面功能：文章内容内容抓取、入库
* 创建日期：2008-9-20 8:33:07
* 修改日期：
* 文 件 名：/manage/article/snatch_content_unsnatch.php
* 作    者：Zerolone
*/
require../include/common.php;

//可以自动刷新
$CanRefresh = false;
?>
<style>*{font-size: 12px;}</style>
<?php
$sourceid	= $_GET['id'];
$cateid		= $_GET['cateid'];
//--------------------0---------1----------2-----------------------3---------------------4-----------------5----------------6------------7
$SqlStr	= 'Select  `a`.`id`, `a`.`url`, `b`.`flagcontentstart`, `b`.`flagcontentend`, `b`.`flagadstart`,`b`.`flagadend`, `a`.`title`, `a`.`cateid`  From `'.table_pre.'article` a, `'.table_pre.'article_source` b where `a`.`sourceid`=`b`.`id` and `a`.`flag`=0 and `a`.`sourceid`=' . $sourceid;
$SqlStr.= ' LIMIT 0,'.$LimitCount;
$temp_query = query($SqlStr);
//echo $SqlStr;exit();
while($DB_Record = nqfetch($temp_query))
{
	$CanRefresh				= true;
	$id								= $DB_Record[0];
	$Url							= $DB_Record[1];
	$ContentStartFlag	= $DB_Record[2];
	$ContentEndFlag		= $DB_Record[3];
	$FlagAdStart 			= $DB_Record[4];
	$FlagAdEnd 				= $DB_Record[5];
	$Title						= $DB_Record[6];
	/*
	echo '<hr>Url='.$Url.'<br>';
	echo 'ArticleId='.$ArticleId.'<br>';
	echo 'ContentStartFlag='.$ContentStartFlag.'<br>';
	echo 'ContentEndFlag='.$ContentEndFlag.'<br>';
	echo 'FlagAdStart='.$FlagAdStart.'<br>';
	echo 'FlagAdEnd='.$FlagAdEnd.'<br>';
	//*/
?>
<iframe  marginwidth="0" marginheight="0" scrolling="no" name="1" border="0" frameborder="0" width="100%" height="12" src="snatch_content_unsnatch.inc.php?id=<?=$id?>">UnSupport Frame</iframe>
<br>
<?php
}
if ($CanRefresh) {
	
?>
<span id="clock"><?=$RefreshTime?></span>秒后自动刷新|<a href="javascript:location.reload()" target="_self">下<?=$LimitCount?>条</a>

<?php
}
else 
{
?>
<meta http-equiv=refresh content="<?=$RefreshTime?> url=article_unissue.php?cateid=<?=$cateid?>">	
<span id="clock"><?=$RefreshTime?></span>秒后自动返回|<a href="article_unissue.php?cateid=<?=$cateid?>" target="_self">全部都已经抓取完毕，请返回</a>
<?php
}
?>
<script type="text/javascript">
  var settime=<?=$RefreshTime?>;
  var i;
  var showthis;
  for(i=1;i<=settime;i++)   {
     setTimeout("update("+i+")",i*1000);
  }
  function update(num) {
     if(num==settime) {
    <?php
    if($CanRefresh)
    {
    ?>
		 	location.reload();
	 	<?php
    }
	 	?>	 	
   }
   else {
   showthis=settime-num;
   clock.innerText = showthis;
   }
  }
</script>