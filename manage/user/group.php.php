<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="<?=SITE_FOLDER?>/css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
<style type="text/css">
<!--
.head {color: #FFFFFF;background: #84AACE;padding: 5px;font-weight:bold;}
-->
</style>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="JavaScript" src="<?=SITE_FOLDER?>/js/all.js"></script>
<script language="JavaScript" src="<?=SITE_FOLDER?>/js/trcolor.js"></script>
<script language="JavaScript">
function goto(pagenum){
	article_list_frm.pagenum.value	= pagenum;
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
  <form name="form1" action="group_update.php" method="post">
  <tr bgcolor="#6A6A6A">
    <td colspan="14" height="26"><b><font color="#FFFFFF">&nbsp;用户管理 &gt;&gt; 用户组查看</font></b></td>
  </tr>
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999 height=20 align="center"><input name="s_list_order" type="submit" class="inputbox" value="顺序"></td>
      <td width="0" bgcolor=#999999><input name="s_list_title" type="submit" value=" 更 新 组 名 "  class="inputbox" >
      <input name="s_add" type="submit" value="添加用户组"  class="inputbox" id="s_add" ></td>
      <td width="-1" bgcolor=#999999><font color="#FFFFFF">离线图标</font></td>
      <td width="-1" bgcolor=#999999><font color="#FFFFFF">在线图标</font></td>
      <td width="29" bgcolor=#999999><input name="s_list_post" type="submit" value="升级贴数"  class="inputbox" id="s_list_post" ></td>
      <td width="30" bgcolor=#999999><input name="s_list_edittime" type="submit" value="编辑时间"  class="inputbox" id="s_list_post2" ></td>
      <td width="40" bgcolor=#999999>&nbsp;</td>
    </tr>
		<?php
			if(isset($groups)){
				foreach ($groups as $group){
		?>
		<label for="del<?=$group['gid']?>">
    <tr>
      <td><input type="hidden" name="gid[]" value="<?=$group['gid']?>"><select name="order[]" class="inputbox"><?=getOrderList($group['order'])?></select></td>
      <td>&nbsp;<input type="text" size="60" name="title[]" value="<?=$group['title']?>" style="width:250px;"></td>
      <td><img src="<?=$group['online']?>"></td>
      <td><img src="<?=$group['offline']?>"></td>
      <td><input type="text" size="60" name="post[]" value="<?=$group['post']?>" style="width:60px;"></td>
      <td><input name="edittime[]" type="text" id="edittime[]" style="width:60px;" value="<?=$group['edittime']?>" size="60"></td>
      <td align="center">
      	[<a href="javascript:ffClick('user/user.php?gid=<?=$group['gid']?>','<?=$group['title']?>');">查看用户</a>] 
      	[<a href="group_edit.php?gid=<?=$group['gid']?>">修改</a>] 
        [<a onClick="return confirm('确定删除选定内容？');" href="group_update.php?gid=<?=$group['gid']?>&mode=del">删除</a>]</td>
    </tr>
		</label>
    <?php
				}
		}	
		?>
    <tr></tr>
    <tr></tr>
  	</form>
	</table>
</body>
</html>
