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
<form name="editid" method="post" action="cate_update.php">
<!-- 论坛循环 -->
<table cellspacing=1 cellpadding=5 width='100%' bgcolor=#E7E3E7 align=center id="">
<?php
foreach($forums as $forum){
	if(strlen($forum['level'])==2){
?>
  <tr height=23 align=center class='cbg'>
    <td width=5%><input name="s_list_level" type="submit" value="更新顺序"></td>
    <td width=30%><input name="s_list_title" type="submit" value="更新板块名"></td>
    <td width=20% colspan="3"><input name="s_add" type="submit" value="添加板块"></td>
    <td width=6%></td>
    <td width=6%></td>
  </tr>
  <tr>
    <td align=center class=head><input type="text" size="4" name="level[]" value="<?=$forum['level']?>"></td>
    <td align=left class=head><input type="text" size="60" name="title[]" value="<?=$forum['title']?>" style="width:300px;"></td>
    <td align=left class=head>&nbsp;</td>
    <td align=center class=head><a title="<?=$forum['lastpost']?>" href="cate_update.php?mode=countall">重新统计所有栏目</a></span></td>
    <td align=center class=head><a href="cate_update.php?mode=repliesall">重计所有回复数</a></td>
    <td class=head align=center><a href="cate_edit.php?fid=<?=$forum['fid']?>">编辑</a></td>
    <td class=head align=center>&nbsp;</td>
  </tr>
  <?php }else{?>
  <tr>
    <td align=center valign=middle class=f_two><input type="text" size="4" name="level[]" value="<?=$forum['level']?>"></td>
    <td align=left class='f_one'><input type="text" size="60" name="title[]" value="<?=$forum['title']?>" style="width:300px;"></td>
    <td align=center class='f_one'><a href="javascript:ffClick('cate/topic.php?fid=<?=$forum['fid']?>','<?=$forum['title']?>');">查看帖子</a></td>
    <td align=center class='f_one'><a title="<?=$forum['lastpost']?>" href="cate_update.php?mode=count&fid=<?=$forum['fid']?>">重新统计T:<?=$forum['topic']?> P:<?=$forum['post']?></a></td>
    <td align=center class='f_one'><a href="cate_update.php?mode=replies&fid=<?=$forum['fid']?>">重计回复数</a></td>
    <td class=f_two align=center><a href="cate_edit.php?fid=<?=$forum['fid']?>">编辑</a></td>
    <td class=f_two align=center><a href="cate_update.php?mode=del&fid=<?=$forum['fid']?>">删除</a></td>
  </tr>
  <?php }?>
  <input type="hidden" name="fid[]" value="<?=$forum['fid']?>">
<?php }?>
</table>
</form>

</body>

</html>
