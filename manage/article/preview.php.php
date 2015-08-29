<HTML>
<HEAD>
<TITLE>预览获取到的信息</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="/css/manage.css" type=text/css rel=stylesheet>
<META content="MSHTML 6.00.2800.1106" name=GENERATOR>
</HEAD>
<BODY>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
    <tr bgcolor="#6A6A6A" height="26">
      <td width="100" height="20" bgcolor="#999999" align="right"><nobr><font color="#FFFFFF">[<a href="snatch_content_one.php?id=<?=$id?>" target="_blank"><font color="#FFFFFF">重新采集</font></a>]标题:</font></nobr></td>
      <td height="20" bgcolor="#FFFFFF" ><?=$title?></td>
    </tr>
    <tr bgcolor="#6A6A6A" height="26">
      <td width="100" height="20" bgcolor="#999999" align="right"><font color="#FFFFFF">地址:</font></td>
      <td height="20" bgcolor="#FFFFFF"><?=$url?></td>
    </tr>
    <tr bgcolor="#6A6A6A" height="26">
      <td width="100" height="20" valign="top"  bgcolor="#999999" align="right"><font color="#FFFFFF">内容:</font></td>
      <td height="20" bgcolor="#FFFFFF"><pre><?=DeCodeStr2($content)?></pre></td>
    </tr>
</TABLE>
</BODY>
</HTML>