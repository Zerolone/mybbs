<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="<?=SITE_FOLDER?>/css/manage.css" type="text/css" >
<script language="javascript" src="<?=SITE_FOLDER?>/js/all.js"></script>
<script language="javascript" src="<?=SITE_FOLDER?>/js/edit.js"></script>
<script language="javascript">
function update_check(){
  var check_title		= document.add_link_frm.title;
  if (check_title.value == "")  {
		alert("请输入分类名！");
		check_title.focus();
		return false;
	}
	
	add_link_frm.action 			= "cate_update.php?";
	add_link_frm.target				=	"_self";
	add_link_frm.submit();
}

function checkselect(obj){ 
obj=document.getElementById(obj);
for(var i=0;i<obj.length;i++){
	obj.options[i].selected=true;}
}

function uncheckselect(obj){ 
obj=document.getElementById(obj);
for(var i=0;i<obj.length;i++){
	obj.options[i].selected=false;}
}

</script>
</head>
<body>
<div id="Layer1" style="position:absolute; left:200px; top:17px; width:1px; height:1px; z-index:1; visibility:hidden">
	<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#000000" onClick="HiddenLayer();">
		<tr>
			<td><img src="images/loadingpic.gif" name="ViewImg"></td>
		</tr>
	</table>
</div>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <form name="add_link_frm" method="POST">
	<tr bgcolor="#6A6A6A">
    <td colspan="10" height="26"><b><font color="#FFFFFF">&nbsp;分类管理 &gt;&gt; 分类操作</font></b></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">板 块 名：</font></td>
    <td bgcolor="#FFFFFF"><?=$forum['title']?></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">板块Logo：</font></td>
    <td bgcolor="#FFFFFF"><input name="logo" type="text" class="InputBox" id="logo" style="width:300" value="<?=$forum['logo']?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插入图片 (ALT + I) " onClick="insertpic1('logo')" class="inputbox" accesskey="I">
      <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
  </tr>	
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">版主：</font></td>
    <td bgcolor="#FFFFFF"><input name="forumadmin" type="text" class="InputBox" id="forumadmin" style="width:300" value="<?=$forum['forumadmin']?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">板块介绍：</font></td>
    <td bgcolor="#FFFFFF"><textarea name="content" id="content" cols="45" rows="10"><?=$forum['content']?></textarea></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">帖子审核：</font></td>
    <td bgcolor="#FFFFFF">
    	<input name="post_check" type="checkbox" id="post_check" value="1" <?php if($forum['post_check']) echo 'checked' ?>>
      <label for="post_check">发帖审核</label>
      <input name="reply_check" type="checkbox" id="reply_check" value="1" <?php if($forum['reply_check']) echo 'checked' ?>>
      <label for="reply_check">回复审核</label>
      <input name="modify_check" type="checkbox" id="modify_check" value="1" <?php if($forum['modify_check']) echo 'checked' ?>>
      <label for="modify_check">修改审核</label>
    </td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">回复审核：</font></td>
    <td bgcolor="#FFFFFF"></td>
  </tr>      
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">允许访问用户组：</font><br>
      <input type="button" value="全    选" name="B3" class="inputbox" onClick="checkselect('allowvisit[]');" />
      <input type="button" value="全 不 选" name="B4" class="inputbox" onClick="uncheckselect('allowvisit[]');" /></td>
    <td bgcolor="#FFFFFF"><select name="allowvisit[]" size="8" multiple id="allowvisit[]" style="width:300px;">
      <?=getUserGroup($MyDatabase, $forum['allowvisit'])?></select></td>
  </tr>      
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">允许发帖用户组：<br>
      <input type="button" value="全    选" name="B5" class="inputbox" onClick="checkselect('allowpost[]');" />
      <input type="button" value="全 不 选" name="B5" class="inputbox" onClick="uncheckselect('allowpost[]');" />
    </font></td>
    <td bgcolor="#FFFFFF"><select name="allowpost[]" size="8" multiple id="allowpost[]" style="width:300px;"><?=getUserGroup($MyDatabase, $forum['allowpost'])?></select>	</td>
  </tr> 
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">允许回复用户组：<br>
      <input type="button" value="全    选" name="B6" class="inputbox" onClick="checkselect('allowreply[]');" />
      <input type="button" value="全 不 选" name="B6" class="inputbox" onClick="uncheckselect('allowreply[]');" />
    </font></td>
    <td bgcolor="#FFFFFF"><select name="allowreply[]" size="8" multiple id="allowreply[]" style="width:300px;"><?=getUserGroup($MyDatabase, $forum['allowreply'])?></select>	</td>
  </tr>    
  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
      <input type="hidden" name="fid"	value="<?=$fid?>" />
      <input type="hidden" name="mode"	value="<?=$mode?>" />
      <input type="hidden" name="title"	value="<?=$forum['title']?>" />
      <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
      <input type="reset" value=" 重 置 (Alt + N) " name="B2" class="inputbox" accesskey="N" /></td>
  </tr>
</form>
</table>