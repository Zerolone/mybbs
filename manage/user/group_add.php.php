<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="<?=SITE_FOLDER?>/css/manage.css" type="text/css" >
<script language="JavaScript" src="<?=SITE_FOLDER?>/js/all.js"></script>
<script language="javascript" src="<?=SITE_FOLDER?>/js/edit.js"></script>
<script language="javascript">
function update_check(){
  var check_title		= document.admin_frm.title;
  if (check_title.value == ""){
		alert("请输入用户组名！");
		check_title.focus();
		return false;
	}
	
	admin_frm.action 			= "group_update.php?";
	admin_frm.target				=	"_self";
	admin_frm.submit();
}
</script>
</head>
<body>
<div id="Layer1" style="position:absolute; left:200px; top:17px; width:1px; height:1px; z-index:1; visibility:hidden">
	<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#000000" onClick="HiddenLayer();">
		<tr>
			<td><img name="ViewImg"></td>
		</tr>
	</table>
</div>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <form name="admin_frm" method="POST">
<tr bgcolor="#6A6A6A">
    <td colspan="10" height="26"><b><font color="#FFFFFF">&nbsp;用户组管理 &gt;&gt; 用户组操作</font></b></td>
  </tr>  
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">用户组名：</font></td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$group['title']?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
      <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($group['order'])?></select>
      </td>
    </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">在线图标：</font></td>
    <td bgcolor="#FFFFFF"><input name="online" type="text" class="InputBox" id="online" style="width:300" value="<?=$group['online']?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插入图片 (ALT + I) " onClick="insertpic1('online')" class="inputbox" accesskey="I">
      <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(online.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
  </tr>	 
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">离线图标：</font></td>
    <td bgcolor="#FFFFFF"><input name="offline" type="text" class="InputBox" id="offline" style="width:300" value="<?=$group['offline']?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插入图片 (ALT + I) " onClick="insertpic1('offline')" class="inputbox" accesskey="I">
      <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(offline.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
  </tr>	     
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">升级点数需求：</font></td>
      <td bgcolor="#FFFFFF"><input name="post" type="text" class="InputBox" id="post" style="width:300" onMouseOver="select();" value="<?=$group['post']?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">自定义头像：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowicon"><input name="allowicon" type="checkbox" id="allowicon" value="1" <?php if($group['allowicon']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">发表主题：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowpost"><input name="allowpost" type="checkbox" id="allowpost" value="1" <?php if($group['allowpost']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">回复主题：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowreply"><input name="allowreply" type="checkbox" id="allowreply" value="1" <?php if($group['allowreply']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">搜索：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowsearch"><input name="allowsearch" type="checkbox" id="allowsearch" value="1" <?php if($group['allowsearch']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">查看会员资料：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowprofile"><input name="allowprofile" type="checkbox" id="allowprofile" value="1" <?php if($group['allowprofile']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">发送短消息：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowmessege"><input name="allowmessege" type="checkbox" id="allowmessege" value="1" <?php if($group['allowmessege']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">上传附件：</font></td>
      <td bgcolor="#FFFFFF"><label for="allowupload"><input name="allowupload" type="checkbox" id="allowupload" value="1" <?php if($group['allowupload']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">编辑时间约束：</font></td>
      <td bgcolor="#FFFFFF"><input name="edittime" type="text" class="InputBox" id="edittime" style="width:300" onMouseOver="select();" value="<?=$group['edittime']?>" size="80">(分钟)</td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">发贴审核：</font></td>
      <td bgcolor="#FFFFFF"><label for="post_check"><input name="post_check" type="checkbox" id="post_check" value="1" <?php if($group['post_check']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">回复审核：</font></td>
      <td bgcolor="#FFFFFF"><label for="reply_check"><input name="reply_check" type="checkbox" id="reply_check" value="1" <?php if($group['reply_check']) echo 'checked';?>>允许</label></td>
    </tr>
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF">
      	<input type="hidden" name="gid"	value="<?=$gid?>" />
        <input type="hidden" name="mode"	value="<?=$mode?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
      </td>
    </tr>
  </form>
</table>
