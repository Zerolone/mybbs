<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >
<script language="javascript" src="../../js/all.js"></script>

<script type="text/javascript" src="../scripts/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../scripts/mootools-1.2-more.js"></script>


<script language="javascript">
window.addEvent("domready", function() {   
	var notsubmit=true;
	$('addnav').set('disabled',notsubmit);
	
	$('titleurl').addEvent('blur', function(){
		//检测输入
		var title= $('titleurl').get('value');
		var regex='.';
	//	var regex='[\u4e00-\u9fa5]';
		
		$('titleurl').setStyle('border-color', 'red');
		if(title.test(regex)){
			$('titleurl').setStyle('border-color', 'green');
			notsubmit=false;
		}
		$('addnav').set('disabled',notsubmit);
	});	

}); 

function update_check()
{
	edit_nav_bar_frm.action 			= "update.php?";
	edit_nav_bar_frm.target				=	"_self";
	edit_nav_bar_frm.submit();
}

</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <form name="edit_nav_bar_frm" id="AAA" method="POST" target="_blank">
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属栏目：</font></td>
    <td bgcolor="#FFFFFF">
    			<select name="cateid">
          <?php
					if(isset($cate_list))
					{
						foreach ($cate_list as $cate)
						{
							if($cate['group']){
					?>
          <optgroup label="<?=$cate['title']?>"></optgroup>
          <?
							}else{
					?>
          <option value="<?=$cate['id']?>" <?=$cate['selected']?>><?=$cate['title']?></option>
          <?
							}
						}
					}
					?>
        </select></td>
  </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题地址说明：</font></td>
      <td bgcolor="#FFFFFF"><textarea name="titleurl" cols="48" rows="10" class="inputbox" id="titleurl"></textarea>
      <br>
      以网址名+网址+说明形式，例如：<br>
      <hr size="1" color="#0000FF">
      网易http://www.163.com<br>
      一个门户网站，创始人为丁磊。<br>
      <hr size="1" color="#0000FF">
      必须使用http。如果没有说明， 则需要空行。
      每<font color="#FF0000">二</font>行定义<font color="#FF0000">一</font>个网址</td>
    </tr>
  </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺序：</font></td>
      <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList()?></select></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">首页显示：</font></td>
      <td bgcolor="#FFFFFF"><input name="level" type="checkbox" id="checkbox1" value="1"><label for="checkbox1">显示</label></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">是否使用：</font></td>
      <td bgcolor="#FFFFFF"><input name="active" type="radio" id="active_0" value="0" checked><label for="active_0">不使用</label><input type="radio" name="active" id="active_1" value="1"><label for="active_1">使用</label></td>
    </tr>
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF">
        <input name="mode" type="hidden" id="mode" value="<?=$mode?>" />
        <input name="addnav" type="button" class="inputbox" id="addnav" accesskey="Y" onClick="update_check();" value="<?=$mode_title?>" /></td>
    </tr>
  </form>
</table>

