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
      <form name="admin_frm" method="POST">
<tr bgcolor="#6A6A6A">
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;注册管理 &gt;&gt; 注册操作</font></b></td>
  </tr>
  <tr>
    <td align="right" width="160" bgcolor="#999999" height="20"><font color="#FFFFFF">您现在的情况：</font></td>
      <td bgcolor="#FFFFFF"><select name="now" id="now">
        <option value="1" <?php if($now==1) echo 'selected';?>>通过网站内的课程介绍已清楚了解教学内容，希望尽快报名确定座位</option>
        <option value="2" <?php if($now==2) echo 'selected';?>>通过在线咨询已了解课程详细情况，希望尽快报名确定座位</option>
        <option value="3" <?php if($now==3) echo 'selected';?>>想参加学习，但对自己个人能力并不了解，不能确定自己适合学习什么课程，希望得到老师的咨询帮助</option>
        <option value="4" <?php if($now==4) echo 'selected';?>>对动漫学堂的课程感兴趣，想先了解一下</option>
      </select></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">您选择的课程是：</font></td>
    <td bgcolor="#FFFFFF"><select name="class" id="class">
      <option value="1" <?php if($class==1) echo 'selected';?>>【插画师】日常班</option>
      <option value="2" <?php if($class==2) echo 'selected';?>>【唯美绘】周末班</option>
      <option value="3" <?php if($class==3) echo 'selected';?>>【游戏设定】周末班</option>
      <option value="4" <?php if($class==4) echo 'selected';?>>【无纸动画师】日常班</option>
    </select></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">姓　　名：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="name" type="text" class="InputBox" id="name" style="width:300" onMouseOver="select();" value="<?=$name?>" size="80"></td>
  </tr>  
  
  <tr>
    <td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">性　　别：</font></td>
    <td bgcolor="#FFFFFF"><input name="sex" id="sex1" type="radio" value="1" <?php if($sex==1) echo 'checked';?>><label for="sex1">男</label><input name="sex" id="sex2" type="radio" value="2" <?php if($sex==2) echo 'checked';?>><label for="sex2">女</label></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">年　　龄：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="age" type="text" class="InputBox" id="age" style="width:300" onMouseOver="select();" value="<?=$age?>" size="80"></td>
  </tr>
    <tr>
    <td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">您目前的职业身份：</font></td>
      <td bgcolor="#FFFFFF"><select name="job" id="job">
        <option value="1" <?php if($job==1) echo 'selected';?>>在校</option>
        <option value="2" <?php if($job==2) echo 'selected';?>>在职人员</option>
        <option value="3" <?php if($job==3) echo 'selected';?>>待业</option>
        <option value="4" <?php if($job==4) echo 'selected';?>>其他</option>
      </select></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">美术教育基础：</font></td>
    <td bgcolor="#FFFFFF"><select name="art" id="art">
      <option value="1" <?php if($art==1) echo 'selected';?>>良好</option>
      <option value="2" <?php if($art==2) echo 'selected';?>>普通</option>
      <option value="3" <?php if($art==3) echo 'selected';?>>无</option>
    </select></td>
  </tr>	
	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">绘画软件基础：</font></td>
	  <td bgcolor="#FFFFFF"><select name="paint" id="paint">
	    <option value="1" <?php if($paint==1) echo 'selected';?>>熟练</option>
	    <option value="2" <?php if($paint==2) echo 'selected';?>>普通</option>
	    <option value="3" <?php if($paint==3) echo 'selected';?>>不熟练</option>
	    <option value="4" <?php if($paint==4) echo 'selected';?>>不了解</option>
	    </select></td>
	  </tr>	  
	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">联系电话：</font></td>
	  <td bgcolor="#FFFFFF"><input name="phone" type="text" class="InputBox" id="phone" style="width:300" onMouseOver="select();" value="<?=$phone?>" size="80"></td>
	  </tr>	  	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">电子邮件：</font></td>
	  <td bgcolor="#FFFFFF"><input name="mail" type="text" class="InputBox" id="mail" style="width:300" onMouseOver="select();" value="<?=$mail?>" size="80"></td>
	  </tr>	  	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">QQ：</font></td>
	  <td bgcolor="#FFFFFF"><input name="qq" type="text" class="InputBox" id="qq" style="width:300" onMouseOver="select();" value="<?=$qq?>" size="80"></td>
	  </tr>	  	
    <script type="text/javascript" language="javascript" src="../../js/PCASClass.js"></script>
    <tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">您现在的所在地：</font></td>
	  <td bgcolor="#FFFFFF"><select name="prov" id="prov"></select>
                  <select name="city" id="city"></select>
        <select name="area" id="area"></select>
      <input name="street" type="text" class="InputBox" id="street" style="width:300" onMouseOver="select();" value="<?=$street?>" size="80">                  <script language="javascript">
										new PCAS("prov","city","area", "<?=$prov?>", "<?=$city?>", "<?=$area?>");
									</script>		</td>
	  </tr>	  	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">是否需要为您提供住宿帮助：</font></td>
	  <td bgcolor="#FFFFFF"><input name="sleep" id="sleep1" type="radio" value="1" <?php if($sleep==1) echo 'checked';?>>
	    <label for="sleep1">是</label>
	    <input name="sleep" id="sleep2" type="radio" value="2" <?php if($sleep==2) echo 'checked';?>>
	    <label for="sleep2">否</label></td>
	  </tr>	  	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">你的学习目的：</font></td>
	  <td bgcolor="#FFFFFF"><select name="study" id="study">
	    <option value="1" <?php if($study==1) echo 'selected';?>>进修后提高个人的未来就业能力</option>
	    <option value="2" <?php if($study==2) echo 'selected';?>>因为工作需要提高自己</option>
	    <option value="3" <?php if($study==3) echo 'selected';?>>纯粹出于个人爱好</option>
	    <option value="4" <?php if($study==4) echo 'selected';?>>公司或者单位安排的培训任务</option>
	    <option value="5" <?php if($study==5) echo 'selected';?>>为家人或朋友咨询</option>
	    </select>
	    其他：
	    <input name="study_other" type="text" class="InputBox" id="study_other" style="width:300" onMouseOver="select();" value="<?=$study_other?>" size="80"></td>
	  </tr>	  	<tr>
	  <td height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">渠道了解到动漫学堂的：</font></td>
	  <td bgcolor="#FFFFFF"><select name="know" id="know">
	    <option value="1" <?php if($know==1) echo 'selected';?>>自己通过搜索网站找到的</option>
	    <option value="2" <?php if($know==2) echo 'selected';?>>通过朋友推荐的</option>
	    <option value="3" <?php if($know==3) echo 'selected';?>>通过动漫以及其他报刊网站知道的</option>
	    <option value="4" <?php if($know==4) echo 'selected';?>>通过院校宣传以及行业讲座知道的</option>
	    </select>
其他：
<input name="know_other" type="text" class="InputBox" id="know_other" style="width:300" onMouseOver="select();" value="<?=$know_other?>" size="80"></td>
	  </tr>	    <tr>
	    <td bgcolor="#999999"></td>
	    <td bgcolor="#FFFFFF">
	      <input type="hidden" name="id"				value="<?=$id?>" />
	      <input type="hidden" name="mode"			value="<?=$mode?>" />
	      <input type="hidden" name="pagenum"		value="<?=$pagenum?>" />
	      <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
	      <input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="history.back(-1)" class="inputbox" accesskey="B">				</td>
	    </tr>
 </form>
</table>
