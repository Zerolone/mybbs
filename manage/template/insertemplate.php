<html>
<title>文件管理器 Lite</title>
<head>
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
</script>
<script event="onclick" for="Ok" language="JavaScript">
  window.returnValue = isrc.value;
  window.close();
</script>

<script event="onclick" for="Ok2" language="JavaScript">
//  window.returnValue = "UpLoadPic*" + form1.UpLoadPic.value;
  window.returnValue = form1.UpLoadPic.value;
  window.close();
</script>
<script event="onclick" for="Ok4" language="JavaScript">
  window.returnValue = "UpLoadPic*" + UpPicSelectList.value;
  window.close();
</script>
<link href="/css/manage.css" rel="stylesheet" type="text/css">
</head>

<body>

<table cellspacing="0" cellpadding="0" width="490" border="0">
	<tr>
		<td class="tab-on" id="navcell" onClick="switchCell(1)" name="navcell" width="100" height="30" style="font-size: 12pt; font-weight:bold">
&nbsp;上传文件</td>
		<td class="tab-off" id="navcell" onClick="switchCell(2)" name="navcell" width="100" style="font-size: 12pt; font-weight:bold">
&nbsp;插入文件</td>
		<td width="*">&nbsp;
 </td>
	</tr>
	
</table>
<table id="tb" cellspacing="0" cellpadding="0" width="490" border="0" name="tb" style="border: 1px solid #C0C0C0">
	<tr>
		<td>
		<form name="form1" method="post" action="uptemplate.php" target="AAA" enctype="multipart/form-data" style="MARGIN-BOTTOM:0px">
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
					<input type="hidden" value="" name="UpLoadPic"><input type="button" name="InsertUpLoadPic" style="display:none;" value=" 添 加 编 辑 器 " class="InputBox" id="Ok2">
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
&nbsp; 文件地址：<input id="isrc" value="http://" size="30" class="InputBox" style="width=284"></td>
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
<iframe name="AAA" src="about:link" width="1" height="1"></iframe>
</body>

</html>