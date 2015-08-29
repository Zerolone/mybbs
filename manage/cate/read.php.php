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
<form name="editid" method="post" action="read_update.php">
<!-- 论坛循环 -->
<table cellspacing=1 cellpadding=5 width='100%' bgcolor=#E7E3E7 align=center>
  <tr>
    <td align=center class=head>发帖人</td>
    <td colspan="2" align=left class=head><input name="s_list_all" type="submit" value="更新内容" id="s_list_all"></td>
    </tr>
  <?php
		foreach($readdb as $read) {
			if($read){
			$table_id=$td_id=$a_id='';
	?>
  <tr>
    <td align=center valign=middle class=f_two><input type="hidden" name="id[]" value="<?=$read['id']?>"><a href="../../?id=<?=$read['authorid']?>"><?=$read['author']?></a></td>
    <td align=left class='f_one'><p>
      <input type="text" size="60" name="title[]" value="<?=$read['title']?>" class="inputbox" style="width:500px;">
      <br>
      <textarea name="content[]" id="content[]" cols="60" rows="5" class="inputbox" style="width:500px;"><?=$read['content']?></textarea>
    </p></td>
    <td align=center class='f_one'><a href="#tid=<?=$read['tid']?>">删除</a></td>
  </tr>
<?php }}?>
	<tr class=cbg>
  	<td colspan=3>
			<?=$pages?>&nbsp;&nbsp;<?=PAGE_PER?>/页&nbsp;<?=$count?>篇文章
      <input type="hidden" name="tid" value="<?=$tid?>">
      <input type="text" name="page" value="<?=$page?>">
    </td>
  </tr>
</table>
</form>

</body>

</html>
