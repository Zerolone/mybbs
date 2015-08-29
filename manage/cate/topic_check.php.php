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
<form name="topic_check" method="post" action="topic_check_update.php">
<!-- 论坛循环 -->
<table cellspacing=1 cellpadding=5 width='100%' bgcolor=#E7E3E7 align=center>
  <tr>
    <td align=center class=head><input name="s_list_top" type="submit" value="更新置顶" id="s_list_top"></td>
    <td align=center class=head><input name="s_list_check" type="submit" value="更新审核" id="s_list_check"></td>
    <td align=left class=head><input name="s_update_cate" type="submit" value="更新所属栏目" id="s_update_cate"></td>
    <td align=left class=head><input name="s_list_topic" type="submit" value="更新主题并审核" id="s_list_topic"></td>
    <td align=left class=head>&nbsp;</td>
    </tr>
  <tr class=cbg><td><b>待审主题</b></td>
    <td align="center">
    	<input name="btncheck" type="button" value="全选" id="btncheck" onClick="selectall('topic_check', 'check[]');">
      <input name="btncheck" type="button" value="全不选" id="btncheck" onClick="selectall('topic_check', 'check[]');">
    </td>
    <td>所属栏目</td>
    <td>内容</td>
    <td>&nbsp;</td>
    </tr>
<?php
if(isset($topics)){
	foreach($topics as $topic){
?>
  <tr>
    <td align=center valign=middle class=f_two><input type="hidden" name="tid[]" value="<?=$topic['tid']?>"><input type="text" size="2" name="top[]" value="<?=$topic['top']?>" class="inputbox"></td>
    <td align=center valign=middle class=f_two>
    <input name="check[]" type="checkbox" id="check<?=$topic['tid']?>" value="<?=$topic['tid']?>"><label for="check<?=$topic['tid']?>">审核</label></td>
    <td align=left class='f_one'><select name="level[]" class="inputbox" style="width:120px;"><?=getForumsListById($MyDatabase, $topic['fid'])?></select></td>
    <td align=left class='f_one'><input type="text" size="60" name="title[]" value="<?=$topic['title']?>" class="inputbox" style="width:400px;">
      <br><textarea name="content[]" id="content[]" cols="60" rows="5" class="inputbox" style="width:400px;"><?=$topic['content']?></textarea></td>
    <td align=center class='f_one'><a href="#">删除</a></td>
    </tr>
<?php }}?>
	<tr class=cbg><td colspan=5>
  	&nbsp; <?=$pages?>&nbsp;&nbsp;<?=PAGE_PER_B?>/页&nbsp;<?=$count?>篇文章
    <input type="hidden" name="fid" value="<?=$fid?>">
    <input type="hidden" name="page" value="<?=$page?>">
    </td>
  </tr>
</table>
</form>

</body>

</html>
