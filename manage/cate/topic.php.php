<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文章分类</title>
<link rel="STYLESHEET" type="text/css" href="<?=SITE_FOLDER?>/css/manage.css">
<style type="text/css">
body {font-family: Verdana;FONT-SIZE: 12px;MARGIN: 0;color: #000000;background: #ffffff;}
td {FONT-SIZE: 12px;}
textarea,input,select{	font-family: Verdana;	font-size: 12px;	background-color: #ffffff;}
form{margin:0px; display:inline}
div.quote{	margin:5px 5px;	border:1px dashed #E7E3E7;	padding:5px;	background:#FFFFFF;	line-height:normal;}
a { TEXT-DECORATION: none;}
a:hover{text-decoration: underline;}
img {border:0;}
.banner{background: #84AACE;}
.head {color: #FFFFFF;background: #84AACE;padding: 5px;font-weight:bold;}
.head a{color: #FFFFFF;}
.f_one {background: #FFFFFF;}
.f_two {background: #F7F8F8;}
.hr  {border-top: 1px solid #E7E3E7; border-bottom: 0; border-left: 0; border-right: 0; }
.t_one {background: #FFFFFF;}
.t_two {background: #F7F8F8;}
.r_one {background: #FFFFFF;}
.r_two {background: #FFFFFF;}
</style>
<script language="javascript" src="<?=SITE_FOLDER?>/js/all.js"></script>
</head>

<body>
<form name="topicfrm" id="topicfrm" method="post" action="topic_update.php">
<!-- 论坛循环 -->
<table cellspacing=1 cellpadding=5 width='100%' bgcolor=#E7E3E7 align=center>
  <tr>
    <td align=center class=head><input name="s_list_top" type="submit" value="更新置顶" id="s_list_top"></td>
    <td colspan="2" align=center class=head><input name="s_list_lock" type="submit" value="更新锁定" id="s_list_lock"></td>
    <td class=head  align=center><input name="s_list_fid" type="submit" value="更新栏目" id="s_list_fid"></td>
    <td align=left class=head><input name="s_list_title" type="submit" value="更新主题"></td>
    <td align=left class=head>&nbsp;</td>
    <td align=left class=head>&nbsp;</td>
    </tr>
<?php
$showtop=0;
$shownormal=0;
foreach($topics as $topic){
	if($topic['top'] && $showtop==0){
		$showtop=1;
?>
  <tr class=cbg><td colspan=7>&nbsp; <b>置顶主题</b></td></tr>
<?php
	}
	if(!$topic['top'] && $shownormal==0){
		$shownormal=1;
?>
  <tr class=cbg><td>&nbsp; <b>普通主题</b></td>
    <td align="center"><input name="s_lock" type="button" value="全锁定" id="s_lock" 		onClick="selectall('topicfrm', 'lock[]');"></td>
    <td align="center"><input name="s_unlock" type="button" value="不锁定" id="s_unlock"	onClick="selectall('topicfrm', 'unlock[]');"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
<?php } ?>
  <tr>
    <td align=center valign=middle class=f_two><input type="hidden" name="tid[]" value="<?=$topic['tid']?>"><input type="text" size="2" name="top[]" value="<?=$topic['top']?>" class="inputbox"></td>
    <td align=center valign=middle class=f_two>
    	<?php if($topic['lock']==0){?>
      	<input type="checkbox" name="lock[]" id="lock1<?=$topic['tid']?>" value="<?=$topic['tid']?>">
      <?php }?>
    </td>
    <td align=center valign=middle class=f_two>
    	<?php if($topic['lock']==1){?>    
	    <input type="checkbox" name="unlock[]" id="lock2<?=$topic['tid']?>" value="<?=$topic['tid']?>">
      <?php }?>
    </td>
    <td align=left class='f_one'><select name="ffid[]" id="ffid[]" style="width:140px;"><?=getForumsListByFid($MyDatabase, $topic['fid'])?></select></td>
    <td align=left class='f_one'><input type="text" size="60" name="title[]" value="<?=$topic['title']?>" class="inputbox" style="width:260px;">
      <?=$topic['titleadd']?></td>
    <td align=center class='f_one'><a href="javascript:ffClick('cate/read.php?tid=<?=$topic['tid']?>','<?=trim($topic['title'])?>');">查看内容</a></td>
    <td align=center class=f_two><a href="topic_update.php?mode=del&fid=<?=$fid?>&tid=<?=$topic['tid']?>&page=<?=$page?>">删除</a></td>
    </tr>
<?php }?>
	<tr class=cbg><td colspan=7>
  	&nbsp; <?=$pages?>&nbsp;&nbsp;<?=PAGE_PER_B?>/页&nbsp;<?=$count?>篇文章
    <input type="hidden" name="fid" value="<?=$fid?>">
    <input type="hidden" name="page" value="<?=$page?>">
    </td>
  </tr>
</table>
</form>

</body>

</html>
