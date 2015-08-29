<?php
require_once("common.php");

$cateid	= 0;
if (isset($_GET['cateid']))
{
	$cateid=$_GET['cateid'];
}
$SqlStr	= 'Update `'.table_pre.'article` SET `flag`=0 where LENGTH(`content`)<10';
//echo $SqlStr . '<hr>';
query($SqlStr);
?>
处理有问题的数据完毕，请重新抓取。<br>
<a href="snatch_content_all.php?cateid=<?=$cateid?>">抓取该类所有未抓取数据</a>