<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<script>
function switchCell(n, hash) {
	nc=document.getElementsByName("navcell");
	if(nc){
		t=document.getElementsByName("tb")
		for(i=0;i<nc.length;i++){
			nc.item(i).className="tab-off";
			t.item(i).className="hide-table";
		}
		nc.item(n-1).className="tab-on";
		t.item(n-1).className="show-table";
	}else if(navcell){
		for(i=0;i<navcell.length;i++){
			navcell[i].className="tab-off";
			tb[i].className="hide-table";
		}
		navcell[n-1].className="tab-on";
		tb[n-1].className="show-table";
	}
	if(hash){
		document.location="#"+hash;
	}
}

function aaa()
{
	document.zipfile_frm.btncancel.value='上传解压中， 请稍候...';
}
</script>
<script event="onclick" for="Ok" language="JavaScript">
  window.returnValue = isrc.value+"*"+ialt.value+"*"+iborder.value+"*"+ialign.value+"*"+istyle.value;
  window.close();
</script>

<script event="onclick" for="Ok2" language="JavaScript">
  window.returnValue = "UpLoadPic*" + form1.UpLoadPic.value;
  window.close();
</script>
<script event="onclick" for="Ok3" language="JavaScript">
  window.returnValue = "UpLoadPic*" + zipfile_frm.UpLoadPic.value;
  window.close();
</script>
<script event="onclick" for="Ok4" language="JavaScript">
  window.returnValue = "UpLoadPic*" + UpPicSelectList.value;
  window.close();
</script>
<link href="/css/manage.css" rel="stylesheet" type="text/css">
<title>图片管理器</title></head>

<body>

<table cellspacing="0" cellpadding="0" width="490" border="0">
	<tr>
		<td class="tab-on" id="navcell" onClick="switchCell(1)" name="navcell" width="100" height="30" style="font-size: 12pt; font-weight:bold">
&nbsp;上传图片</td>
		<td class="tab-off" id="navcell" onClick="switchCell(2)" name="navcell" width="100" style="font-size: 12pt; font-weight:bold">
&nbsp;插入图片</td>
		<td class="tab-off" id="navcell" onClick="switchCell(3)" name="navcell" width="200" style="font-size: 12pt; font-weight:bold">
上传压缩文件自动解压</td>
		<td class="tab-off" id="navcell" onClick="switchCell(4)" name="navcell" width="120" style="font-size: 12pt; font-weight:bold">
&nbsp;已上传图片</td>
		<td width="*">&nbsp;
 </td>
	</tr>
	
</table>
<table id="tb" cellspacing="0" cellpadding="0" width="490" border="0" name="tb" style="border: 1px solid #C0C0C0">
	<tr>
		<td>
		<form name="form1" method="post" action="upfile.php" target="AAA" enctype="multipart/form-data" style="MARGIN-BOTTOM:0px">
			<input type="hidden" name="act" value="upload"><table border="0" cellspacing="0" cellpadding="0">

				<tr align="center">
					<td align="left" id="upid"><br>
					&nbsp;&nbsp;文件:
					<input type="file" name="upfile" class="InputBox" style="width=400"> </td>
				</tr>
				<tr align="center" valign="middle">
					<td height="24">
					<input type="submit" name="Submit" value=" 上 传 (Alt + U) " class="InputBox" accesskey="U">&nbsp; 
					<input type="button" value=" 取 消 (Alt + N) " onClick="window.close();" class="InputBox">
					<input type="hidden" value="" name="UpLoadPic"><input type="button" name="InsertUpLoadPic" style="display:none;" value=" 添加图片到编辑器 " class="InputBox" id="Ok2">
					</td>
				</tr>
			</table>
		</form>
		</td>
	</tr>
</table>

<table  class="hide-table" id="tb" cellspacing="0" cellpadding="0" width="490" border="0" name="tb" style="border: 1px solid #C0C0C0">
	<tr>
		<td>
		<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0">
			<tr>
				<td height="22">
&nbsp; 图片地址：<input id="isrc" value="http://" size="30" class="InputBox" style="width=284"></td>
			</tr>
			<tr>
				<td height="22">
&nbsp; 标识文字：<input id="ialt" size="12" class="InputBox" style="width=100">&nbsp;&nbsp;&nbsp; 图片边框：<input id="iborder" value="0" size="2" maxlength="2" class="InputBox" style="width=100"></td>
			</tr>
			<tr>
				<td height="22">
&nbsp; 特殊效果：
<select name="select" class="InputBox" id="istyle" style="width=100">
  <option>不应用</option>
  <option value="filter:blur(add=1,direction=14,strength=15)">模糊效果</option>
  <option value="filter:gray">黑白照片</option>
  <option value="filter:flipv">颠倒显示</option>
  <option value="filter:fliph">左右反转</option>
  <option value="filter:xray">X光照片</option>
  <option value="filter:invert">颜色反转</option>
</select>&nbsp;&nbsp;&nbsp; 图片位置：
<select id="ialign" class="InputBox" style="width=100">
				<option>默认位置</option>
				<option value="left">居左</option>
				<option value="right">居右</option>
				<option value="top">顶部</option>
				<option value="middle">中部</option>
				<option value="bottom">底部</option>
				<option value="absmiddle">绝对居中</option>
				<option value="absbottom">绝对底部</option>
				<option value="baseline">基线</option>
				<option value="texttop">文本顶部</option>
				</select></td>
			</tr>
			<tr>
				<td height="35">
				<p align="center">&nbsp;<input type="submit" value=" 确 定 (Alt + Y) " id="Ok" class="InputBox" accesskey="Y">&nbsp; 
				<input type="button" value=" 取 消 (Alt + N) " onClick="window.close();" class="InputBox" accesskey="N"></p>				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<table  class="hide-table" id="tb" cellspacing="0" cellpadding="0" width="490" border="0" name="tb" style="border: 1px solid #C0C0C0">
	<tr>
		<td>
		<form name="zipfile_frm" method="post" action="upfilezip.php" target="AAA" enctype="multipart/form-data" style="MARGIN-BOTTOM:0px" onSubmit="aaa();">
			<input name="myaction" type="hidden" id="myaction" value="dounzip"><table border="0" cellspacing="0" cellpadding="0">

				<tr align="center">
					<td align="left" id="upid"><br>
					&nbsp;&nbsp;ZIP文件:
					<input name="upfile" type="file" id="upfile" class="InputBox" style="width=400"> </td>
				</tr>
				<tr align="center" valign="middle">
					<td height="24">
					<input type="submit" name="Submit" value=" 解 压 (Alt + U) " class="InputBox" accesskey="U">&nbsp; 
					<input type="button" name="btncancel" value=" 取 消 (Alt + N) " onClick="window.close();" class="InputBox">
					<input type="hidden" value="" name="UpLoadPic"><input type="button" name="InsertUpLoadPic" style="display:none;" value=" 添加图片到编辑器 " class="InputBox" id="Ok3">
					</td>
				</tr>
			</table>
		</form>
		</td>
	</tr>
</table>
<table id="tb" cellspacing="0" cellpadding="0" width="490" border="0" name="tb" class="hide-table" style="border: 1px solid #C0C0C0">
	<tr>
		<td height="270">
		<iframe name="I1" src="uploaded_pic.php" marginwidth="1" marginheight="1" height="100%" width="100%" border="0" frameborder="0">
		浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe>
		</td>
	</tr>
	<tr>
	<td>
			<form name="form2" style="MARGIN-BOTTOM:0px">
			<input type="hidden" value="" name="UpPicSelectList">
			<p align="center"><input type="button" name="InsertUpLoadPic0" value=" 添 加 图 片 到 编 辑 器 " class="InputBox" id="Ok4">
			</form>
			</td>
	</tr>
</table>
<iframe name="AAA" src="about:link" width="1" height="1"></iframe>
</body>

</html>