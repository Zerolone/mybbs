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
  var check_title		= document.add_article_frm.title;
  if (check_title.value == ""){
		alert("请输入文章标题！");
		check_title.focus();
		return false;
	}
	
	add_article_frm.action 			= "update.php?";
	add_article_frm.target				=	"_self";
	add_article_frm.content.value	= frames.monolith_article_body.document.body.innerHTML;
	
	//保存的时候自动复制内容到剪贴板中。
	window.clipboardData.setData("text",add_article_frm.content.value);   
	
	//方法二， 图片可能会有点问题 
//	formattext('selectall');
//	formattext('copy');	
//	alert("已经复制到剪切板！");	
	
	add_article_frm.submit();
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
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;文章管理 &gt;&gt; 文章操作</font></b></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">文章标题：</font></td>
    <td bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <form name="add_article_frm" method="POST">
        <tr>
          <td height="22"><input name="title" type="text" class="InputBox" id="title" style="width:260" value='<?=$title?>' size="80">
            <select name="titlecolor" id="titlecolor" onChange="formattext('ForeColor',selectColour.options[selectColour.selectedIndex].value);">
            	<?php
								if($titlecolor==''){
							?>
              <option value="" selected="selected">颜色</option>
              <?php
								}else{
								
							?>
              <option style="background-color:<?=$titlecolor?>;color: <?=$titlecolor?>" value="<?=$titlecolor?>"><?=$titlecolor?></option>
              <?php
								}
							?>
              <option style="background-color:#000000;color: #000000" value="#000000">#000000</option>
              <option style="background-color:#FFFFFF;color: #FFFFFF" value="#FFFFFF">#FFFFFF</option>
              <option style="background-color:#008000;color: #008000" value="#008000">#008000</option>
              <option style="background-color:#800000;color: #800000" value="#800000">#800000</option>
              <option style="background-color:#808000;color: #808000" value="#808000">#808000</option>
              <option style="background-color:#000080;color: #000080" value="#000080">#000080</option>
              <option style="background-color:#800080;color: #800080" value="#800080">#800080</option>
              <option style="background-color:#808080;color: #808080" value="#808080">#808080</option>
              <option style="background-color:#FFFF00;color: #FFFF00" value="#FFFF00">#FFFF00</option>
              <option style="background-color:#00FF00;color: #00FF00" value="#00FF00">#00FF00</option>
              <option style="background-color:#00FFFF;color: #00FFFF" value="#00FFFF">#00FFFF</option>
              <option style="background-color:#FF00FF;color: #FF00FF" value="#FF00FF">#FF00FF</option>
              <option style="background-color:#C0C0C0;color: #C0C0C0" value="#C0C0C0">#C0C0C0</option>
              <option style="background-color:#FF0000;color: #FF0000" value="#FF0000">#FF0000</option>
              <option style="background-color:#0000FF;color: #0000FF" value="#0000FF">#0000FF</option>
              <option style="background-color:#008080;color: #008080" value="#008080">#008080</option>
            </select>
            点击率：
<input name="hits" type="text" class="InputBox" id="hits" style="width:30" value="<?=$hits?>" size="10"></td>
          <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForReUrl')" bgcolor="#C0C0C0"> 跳转地址</td>
          <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForTitle2')" bgcolor="#C0C0C0"> 副标题</td>
          <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForTitle')" bgcolor="#C0C0C0"> 显示参照</td>

          <!--
          <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="Count_Article_Title('title','title2')" bgcolor="#C0C0C0"> 统计字符</td>
          -->
          <td width="*">&nbsp; 　</td>
        </tr>
    </table></td>
  </tr>
  <tr id="TrForTitle2" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">第二标题：</font></td>
    <td  bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="560" height="22"><input name="title2" type="text" class="InputBox" id="title2" style="width:480" value="<?=$title2?>" size="80"></td>
        <td width="*">&nbsp; 　</td>
      </tr>
    </table></td>
  </tr>
  <tr id="TrForReUrl" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">跳转地址：</font></td>
    <td  bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="560" height="22"><input name="reurl" type="text" class="InputBox" id="reurl" style="width:480" value="<?=$reurl?>" size="80"></td>
        <td width="*">&nbsp; 　</td>
      </tr>
    </table></td>
  </tr>

  <tr id="TrForTitle" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">参&nbsp;&nbsp;&nbsp; 照：</font></td>
    <td bgcolor="#FFFFFF"><input readonly type="text" name="_Title" size="80" class="InputBox" value="一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十一二三四五六七八九十" style="background-color: #C0C0C0; width=480"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属栏目：</font></td>
    <td bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><select name="cateid" style="width:230px;">
          <?php
					if(isset($cate_list))
					{
						foreach ($cate_list as $cate)
						{
					?>
          <option value="<?=$cate['id']?>" <?=$cate['selected']?>>
            <?=$cate['title']?>
            </option>
          <?
						}
					}
					?>
        </select></td>
        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForText')" title="显示隐藏调用的文字" bgcolor="#C0C0C0"> 调用文字</td>
        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForPic')" title="显示隐藏调用的图片" bgcolor="#C0C0C0"> 调用图片</td>
        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ResetDefault()" title="编辑环境恢复为默认" bgcolor="#C0C0C0"> 设置默认</td>
        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowAll()" title="显示编辑环境所有工具" bgcolor="#C0C0C0"> 完整显示</td>
        <td width="*">&nbsp; 　</td>
      </tr>
    </table></td>
  </tr>

  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">作&nbsp;&nbsp;&nbsp; 者：</font></td>
    <td bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td  bgcolor="#FFFFFF"><input name="author" type="text" class="InputBox" id="author" style="width:120" onClick="ShowCombo('layer_lst');ShowCombo('lst_author');" value="<?=$author?>" size="30">
          来&nbsp;&nbsp; 源：
          <input name="from" type="text" class="InputBox" id="from" style="width:120" onClick="ShowCombo('layer_lst');ShowCombo('lst_from');" value="<?=$from?>" size="30"></td>

        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForNewsArea')" title="新闻显示位置" bgcolor="#C0C0C0"> 显示顺序</td>
        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForEToolBar1')" title="扩展工具栏一" bgcolor="#C0C0C0"> 扩展栏一</td>
        <td width="60" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ShowOrHideTr('TrForEToolBar2')" title="扩展工具栏二" bgcolor="#C0C0C0"> 扩展栏二</td>
        <td width="*">&nbsp; 　</td>
      </tr>
    </table></td>
  </tr>
  <tr id="TrForNewsArea" style="display:none;">
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">显示顺序：</font></td>
    <td bgcolor="#FFFFFF">
				 
      显示顺序:
    <input name="order" type="text" class="InputBox" id="order" style="width:124" value="<?=$order?>" size="80"></td>
  </tr>	
  <tr>
    <td colspan="2"><div id="layer_lst" style="position:absolute; z-index:1; visibility=hidden" onClick="HideCombo('layer_lst');">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td>　　　　　　　　
                <select name="lst_author" size="24" class="inputbox" id="lst_author" style="width:125;visibility=hidden" onChange="addtext('author', 'r');" onClick="HideCombo('lst_author');">
								<?php
								if(isset($author_list))
								{
									foreach ($author_list as $author)
									{
								?>
                  <option value="<?=$author['name']?>"><?=$author['name']?></option>
								<?php
									}
								}
								?>
                </select>
            　　　
            <select name="lst_from" size="24" class="InputBox" id="lst_from" style="width:125;visibility=hidden" onChange="addtext('from','r');" onClick="HideCombo('lst_from');">
								<?php
								if(isset($from_list))
								{
									foreach ($from_list as $from)
									{
								?>
                  <option value="<?=$from['name']?>"><?=$from['name']?></option>
								<?php
									}
								}
								?>            </select></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr id="TrForText" style="display:none;">
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">调用文字：</font></td>
    <td bgcolor="#FFFFFF"><textarea rows="4" name="memo" cols="55" class="InputBox" style="width=580"><?=$memo?></textarea></td>
  </tr>
  <tr id="TrForPic" style="display:none;">
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">图 片 一：</font></td>
    <td bgcolor="#FFFFFF"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td height="22">
          <input name="pic1" type="text" class="InputBox" id="pic1" style="width:150" value="<?=$pic1?>" size="30"></td>
        <td width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="insertpic1('pic1')" bgcolor="#C0C0C0"> 插 入 </td>
        <td width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic1.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick="HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </td>
        <td width="20">　</td>
        <td height="22">图 片 二:
          <input name="pic2" type="text" class="InputBox" id="pic2" style="width:150" value="<?=$pic2?>" size="30">
        </td>
        <td width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="insertpic1('pic2')" bgcolor="#C0C0C0"> 插 入 </td>
        <td width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic2.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </td>
        <td width="170">&nbsp; 　</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="100" height="20" rowspan="2" align="right" bgcolor="#999999"><font color="#FFFFFF">详细内容：</font></td>
    <td bgcolor="#FFFFFF"><? require('article_banner.inc.php');?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" height="375" id="TrForBody"><iframe id="monolith_article_body" width="100%" height="100%" marginwidth="1" marginheight="1"></iframe></td>
  </tr>
  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
				<input type="hidden" name="id"	value="<?=$id?>" />
				<input type="hidden" name="pagenum"	value="<?=$pagenum?>" />
				<input type="hidden" name="mode"	value="<?=$mode	?>" />
				<input type="hidden" name="content" />
        <input type="checkbox" value="1" name="notshowlist" id="notshowlist" <? if($notshowlist) echo 'checked' ?> /><label for="notshowlist">不显示在列表</label>
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
        <input type="button" value="预览内容" name="btnpreview" onClick="previewbody();" class="inputbox" accesskey="P">
		&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" name="buttonj2f" id="buttonj2f" class="inputbox" onClick="j2f();" value="繁->简">
				<label for="ifblank"><input name="ifblank" type="checkbox" id="ifblank" checked> 
				段前空格?</label>
				<input name="formatbutton" type="button" class="inputbox" onClick="FormatText()" value="格式化">
				<iframe name="AAA" width="0" height="0"></iframe>
			<div style="border-style:solid; border-width:1px; position: absolute; width: 90%; height: 100px; z-index: 1; left: 18px; top: 200px; visibility:hidden" id="LayerPicToRemote">
				<div align="center">
					<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" height="100%" bordercolor="#CCCCCC">
						<tr>
							<td bgcolor="#C0C0C0">
							<p align="center">文件远程保存中 ，<font color="#FF0000">请勿进行操作</font>。请稍候...</p>
							</td>
						</tr>
					</table>
				</div>
			</div>				
		</td>
  </tr>
 </form>
</table>
<script language="javascript">
monolith_article_body.document.designMode = "On";
window.onload = function() { 
monolith_article_body.document.body.innerHTML='<?=$content	?>';
}
</script>