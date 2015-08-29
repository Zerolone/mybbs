<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="/css/manage.css" type="text/css" >
<script language="javascript" src="/js/all.js"></script>
<script language="javascript" src="/js/edit.js"></script>
<script language="javascript">
function update_check()
{
  var check_title		= document.admin_frm.title;
  if (check_title.value == "")
  {
		alert("请输入标题！");
		check_title.focus();
		return false;
	}
	
	admin_frm.action 			= "module_update.php?";
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
  <form name="admin_frm" method="POST">
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$title?>" size="80"></td>
  </tr>
  <tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
    <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($order)?></select>   </td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题图片：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="pic" type="text" class="InputBox" id="pic" style="width:300" onMouseOver="select();" value="<?=$pic?>" size="80">
      <input name="insertpic" type="button" class="inputbox" id="insertpic" onClick="insertpic1('pic')" value=" 插 入 ">
      <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span>
      </td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">更多地址：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="url" type="text" class="InputBox" id="url" style="width:300" onMouseOver="select();" value="<?=$url?>" size="80"></td>
  </tr>
  <tr>
		<td align="right" width="100" bgcolor="#999999" height="24"><font color="#FFFFFF">模块调用方法：</font></td>
    <td bgcolor="#FFFFFF">
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td height="22" width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowHideTr('kind1')"  bgcolor="#C0C0C0"> 图文列表 </td>					
					<td height="22" width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowHideTr('kind2')"  bgcolor="#C0C0C0"> 视频播放 </td>					
					<td height="22" width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowHideTr('kind3')"  bgcolor="#C0C0C0"> 单调文章 </td>
					<td height="22" width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowHideTr('kind4')"  bgcolor="#C0C0C0"> 调用投票 </td>
					<td height="22" width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowHideTr('kind5')"  bgcolor="#C0C0C0"> 调用留言 </td>
					<td height="22" width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowHideTr('kind6')"  bgcolor="#C0C0C0"> 调用轮显 </td>



					</tr>
			</table>		</td>	
	</tr>
	<tr id="kind1" style="display:none;">
    <td width="100" height="20" align="right" valign="top" bgcolor="#999999"><font color="#FFFFFF">文章列表：</font></td>
      <td bgcolor="#FFFFFF">
			显示条数：
        <input name="kind1_count" type="text" class="InputBox" id="kind1_count" style="width:300" onMouseOver="select();" value="<?=$kind1_count?>" size="80">
        <br>
        每行条数：
        <input name="kind1_perline" type="text" class="InputBox" id="kind1_perline" style="width:300" onMouseOver="select();" value="<?=$kind1_perline?>" size="80">
        <br>
        每行字数：
        <input name="kind1_txt" type="text" class="InputBox" id="kind1_txt" style="width:300" onMouseOver="select();" value="<?=$kind1_txt?>" size="80">
        <br>
        排　　序：
        <select name="kind1_orderby" id="kind1_orderby">
          <option value="id"		<?php if($kind1_orderby=='id') echo 'selected'?>		>编号</option>
          <option value="order"	<?php if($kind1_orderby=='order') echo 'selected'?>>顺序</option>
        </select>
        排序方式：
        <select name="kind1_ordersort" id="kind1_ordersort">
          <option value="DESC"	<?php if($kind1_ordersort=='DESC') echo 'selected'?>>倒序</option>
          <option value="ASC"		<?php if($kind1_ordersort=='ASC') 	echo 'selected'?>>顺序</option>
        </select>
        <br>				
        所属栏目：
        <select name="kind1_cateid[]" size="10" multiple id="kind1_cateid[]" style="width:300">
          <?php
					if(isset($kind1_cate_list))
					{
						foreach ($kind1_cate_list as $cate)
						{
					?>
          <option value="<?=$cate['id']?>" <?=$cate['selected']?>>
          <?=$cate['title']?>
          </option>
          <?
						}
					}
					?>
        </select>			</td>
  </tr>	
	<tr id="kind2" style="display:none;">
    <td width="100" height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">视频播放 ：</font></td>
      <td bgcolor="#FFFFFF"><textarea name="kind2_url" cols="80" rows="8" class="InputBox" id="kind2_url" style="width:300" onMouseOver="select();"><?=$kind2_url?></textarea>
      <input name="Submit" type="button" class="inputbox" value=" 插 入 " onClick="Allmedia1('kind2_url')"></td>
	</tr>	
	<tr id="kind3" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">文章编号：</font></td>
      <td bgcolor="#FFFFFF"><input name="kind3_id" type="text" class="InputBox" id="kind3_id" style="width:300" onMouseOver="select();" value="<?=$kind3_id?>" size="80">
      <input type="button" name="Submit22" value=" 选 择 (ALT + S) " onClick="insertArticleid('kind3_id');" class="inputbox" accesskey="B"></td>
  </tr>	
	<tr id="kind4" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">投票编号：</font></td>
      <td bgcolor="#FFFFFF"><input name="kind4_id" type="text" class="InputBox" id="kind4_id" style="width:300" onMouseOver="select();" value="<?=$kind4_id?>" size="80"></td>
  </tr>	
	<tr id="kind5" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">留言编号：</font></td>
      <td bgcolor="#FFFFFF"><input name="kind5_id" type="text" class="InputBox" id="kind5_id" style="width:300" onMouseOver="select();" value="<?=$kind5_id?>" size="80"></td>
  </tr>
	<tr id="kind6" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">轮显编号：</font></td>
      <td bgcolor="#FFFFFF"><input name="kind6_id" type="text" class="InputBox" id="kind6_id" style="width:300" onMouseOver="select();" value="<?=$kind6_id?>" size="80"></td>
  </tr>
  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
				<input type="hidden" name="id"	value="<?=$id?>" />
				<input type="hidden" name="parentid"	value="<?=$parentid?>" />
				<input type="hidden" name="mode"	value="<?=$mode?>" />
				<input type="hidden" name="kind"	value="<?=$kind?>" />
				<input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
				<input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="history.back(-1)" class="inputbox" accesskey="B">				</td>
  </tr>
 </form>
</table>
