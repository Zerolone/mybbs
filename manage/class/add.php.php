<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="/css/manage.css" type="text/css" >
<script language="javascript" src="/js/all.js"></script>
<script language="javascript" src="/js/edit.js"></script>
<script language="javascript">
function update_check(){
  var check_title		= document.admin_frm.title;
  if (check_title.value == ""){
		alert("请输入标题！");
		check_title.focus();
		return false;
	}
	
	admin_frm.action 			= "update.php?";
	admin_frm.target				=	"_self";
	admin_frm.submit();
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
  <tr bgcolor="#6A6A6A">
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;课程管理 &gt;&gt; 课程操作</font></b></td>
  </tr>
      <form name="admin_frm" method="POST">
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="title" type="text" class="InputBox" id="title" style="width:300" value="<?=$title?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">学习周期：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="cycle" type="text" class="InputBox" id="cycle" style="width:300" value="<?=$cycle?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">学习软件：</font></td>
      <td bgcolor="#FFFFFF"><input name="soft" type="text" class="InputBox" id="soft" style="width:300" value="<?=$soft?>" size="80"></td>
  </tr>	
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">对应图片1：</font></td>
      <td bgcolor="#FFFFFF"><input name="pic1" type="text" class="InputBox" id="pic1" style="width:300" value="<?=$pic1?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('pic1')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic1.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">对应图片2：</font></td>
      <td bgcolor="#FFFFFF"><input name="pic2" type="text" class="InputBox" id="pic2" style="width:300" value="<?=$pic2?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('pic2')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic2.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>   
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">对应图片3：</font></td>
      <td bgcolor="#FFFFFF"><input name="pic3" type="text" class="InputBox" id="pic3" style="width:300" value="<?=$pic3?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('pic3')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic3.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>       
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
      <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($order)?></select></td>
  </tr>		
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">主讲老师：</font></td>
      <td bgcolor="#FFFFFF"><input name="teacher" type="text" class="InputBox" id="teacher" style="width:300" value="<?=$teacher?>" size="80"></td>
  </tr>	
      <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">学习目标：</font></td>
      <td bgcolor="#FFFFFF"><input name="study" type="text" class="InputBox" id="study" style="width:300" value="<?=$study?>" size="80"></td>
  </tr>	

      <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">课程介绍：</font></td>
      <td bgcolor="#FFFFFF"><input name="intro" type="text" class="InputBox" id="intro" style="width:300" value="<?=$intro?>" size="80"></td>
  </tr>	    <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">招生对象：</font></td>
      <td bgcolor="#FFFFFF"><input name="object" type="text" class="InputBox" id="object" style="width:300" value="<?=$object?>" size="80"></td>
  </tr>	
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">讲师作品1小图：</font></td>
      <td bgcolor="#FFFFFF"><input name="works1s" type="text" class="InputBox" id="works1s" style="width:300" value="<?=$works1s?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('works1s')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(works1s.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>    
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">讲师作品1大图：</font></td>
      <td bgcolor="#FFFFFF"><input name="works1" type="text" class="InputBox" id="works1" style="width:300" value="<?=$works1?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('works1')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(works1.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>   
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">讲师作品1小图：</font></td>
      <td bgcolor="#FFFFFF"><input name="works2s" type="text" class="InputBox" id="works2s" style="width:300" value="<?=$works2s?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('works2s')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(works2s.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>     
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">讲师作品2大图：</font></td>
      <td bgcolor="#FFFFFF"><input name="works2" type="text" class="InputBox" id="works2" style="width:300" value="<?=$works2?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插 入 图 片 (ALT + I) " onClick="insertpic1('works2')" class="inputbox" accesskey="I">
	   <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(works2.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
	  </td>
  </tr>  
<tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">对应文章编号：</font></td>
      <td bgcolor="#FFFFFF"><input name="articleid" type="text" class="InputBox" id="articleid" style="width:300" value="<?=$articleid?>" size="80"></td>
  </tr>	  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
      <input type="hidden" name="id"	value="<?=$id?>" />
      <input type="hidden" name="cateid"	value="<?=$cateid?>" />
      <input type="hidden" name="mode"	value="<?=$mode?>" />
      <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" /></td>
  </tr>
 </form>
</table>
