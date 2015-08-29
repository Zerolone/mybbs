<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="<?=SITE_FOLDER?>/css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" scroll="no">
<script language="JavaScript" src="<?=SITE_FOLDER?>/js/all.js"></script>
<script language="JavaScript" src="<?=SITE_FOLDER?>/js/trcolor.js"></script>
<script language="JavaScript">
function goto(pagenum){
	article_list_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
  <form name="form2" method="post">
  <tr bgcolor="#6A6A6A">
    <td colspan="10" height="26"><b><font color="#FFFFFF">&nbsp;用户管理 &gt;&gt; 用户查看</font></b>      
        <input type="text" name="username" id="username" class="inputbox">
        <input type="hidden" name="gid" value="<?=$gid?>">
        <a href="user.php"><font color="#FFFFFF">全部显示</font></a></td>
  </tr>
  </form>
  <form name="form1" action="update.php" method="post">
    <tr valign=center align=middle>
      <td width="60" bgcolor=#999999 height=20><font color="#FFFFFF">用户名</font></td>
      <td width="*" bgcolor=#999999><input name="s_usergroup" type="submit" value="更新用户组"  class="inputbox" id="s_usergroup" ></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
    </tr>
		<?php
			if(isset($users_list)){
				foreach ($users_list as $user){
		?>
		<label for="del<?=$user['uid']?>">
    <tr>
      <td>&nbsp;<input type="hidden" name="uid[]" value="<?=$user['uid']?>"><?=$user['username']?></td>
      <td>&nbsp;<select name="groupid[]" id="groupid[]"><?=getUserGroup($MyDatabase, $user['groupid'])?></select></td>
			<td><input name="del[]" type="checkbox" id="del<?=$user['uid']?>" value="<?=$user['uid']?>">删除</td>
      <td>&nbsp;<a href="edit.php?uid=<?=$user['uid']?>">修改</a></td>
    </tr>
		</label>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="6" align=right>
	      <input type="hidden" name="pagenum" value="<?=$pagenum?>">
	      <input type="hidden" name="gid" value="<?=$gid?>">
	      <input type="hidden" name="username" value="<?=$username?>">
        <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除">
        <input type="reset" class="inputbox" value="全不选">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
			</td>
    </TR>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="6" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       	      <input type="hidden" name="gid" value="<?=$gid?>">
	      <input type="hidden" name="username" value="<?=$username?>">
<?=SplitPage($recordcount, $pagenum, $pagesize);?>
</form>			</td>
	</tr>
	</table>
  
<script language="JavaScript">   
var r   =   document.body.createTextRange();
var thefindText = '<?=$username?>';
if (thefindText!=''){
	for(var i=0;r.findText(thefindText);i++){   
		r.execCommand('bold',  		 'false');   
		r.execCommand('ForeColor',   'false',   'red');   
		r.execCommand('BackColor',   'false',   'yellow');
		r.collapse(false);   
	 }
}   
</script>     
</body>
</html>
