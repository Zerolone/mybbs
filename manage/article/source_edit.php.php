<html>
<head>
<title>数据源详细信息修改</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="/css/manage.css" type=text/css rel=stylesheet>
<script language="JavaScript" src="/js/all.js"></script>
</head>
<body>
<form name="form1" action="source_edit_update.php" method="post">
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
    <tr bgcolor="#6A6A6A" height="26">
      <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;文章采集管理 &gt;&gt; 修改采集规则 </font></b>
			<a href="javascript:ffClick('article/snatch_title.php?id=<?=$id?>','采集：<?=$title?>')"><font color="#FFFFFF">采集标题</font></a>
			<a href="javascript:ffClick('article/snatch_content_unsnatch.php?id=<?=$id?>&cateid=<?=$cateid?>','采集数据：<?=$title?>')"><font color="#FFFFFF">采集未采集数据</font></a>
			</td>
    </tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" 
          bgcolor=#999999 align="right"><font color="#FFFFFF">标　　题:</font></td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" class="inputbox" id="title" value="<?=$title?>" size="72"></td>
    </tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" bgcolor=#999999  align="right"><font color="#FFFFFF">网　　址:</font></td>
      <td bgcolor="#FFFFFF"><input name="url" type="text" class="inputbox" value="<?=$url?>"  size="72" maxlength="255" >
      +
        (
        <input name="url1" type="text" class="inputbox" id="url1" value="<?=$url1?>"  size="2" maxlength="2" >
      	<input name="url2" type="text" class="inputbox" id="url2" value="<?=$url2?>"  size="2" maxlength="2" >
      		)+
      		<input name="urlext" type="text" class="inputbox" id="urlext" value="<?=$urlext?>"  size="9" ></td>
    </tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" bgcolor=#999999 align="right"><font color="#FFFFFF">地址补全:</font></td>
      <td bgcolor="#FFFFFF"><input name="urlfill" type="text" class="inputbox" id="urlfill" value="<?=$urlfill?>"  size="72" maxlength="255" >
      由小到大，为0是不使用</td>
    </tr>
		<tr>
			<td width="100" bgcolor="#999999" align="right"><font color="#FFFFFF">所属文章分类:</font></td>
			<td bgcolor="#FFFFFF"><select name="cateid">
        <?php
					if(isset($menu_list))
					{
						foreach ($menu_list as $menu)
						{
					?>
        <option value="<?=$menu['id']?>" <?=$menu['selected']?>>
          <?=$menu['title']?>
          </option>
        <?
						}
					}
					?>
      </select>

			<input type="checkbox" name="utf8" id="utf8" <?php if($utf8) echo 'checked' ?>><label for="utf8">内容为UTF-8编码</label>
			</td>
		</tr>		<tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" bgcolor=#999999 align="right"><font color="#FFFFFF">列表起始:</font></td>
      <td bgcolor="#FFFFFF"><textarea name="flagstart" cols="70" rows="5" class="inputbox" id="flagstart" ><?=$flagstart?>
</textarea></td>
    </tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" bgcolor=#999999 align="right"><font color="#FFFFFF">列表结束:</font></td>
      <td bgcolor="#FFFFFF"><textarea name="flagend" cols="70" rows="5" class="inputbox" id="flagend" ><?=$flagend?></textarea></td>
    </tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" bgcolor=#999999 align="right"><font color="#FFFFFF">内容开始:</font></td>
      <td bgcolor="#FFFFFF"><textarea name="flagcontentstart" cols="70" rows="5" class="inputbox" id="flagcontentstart" ><?=$flagcontentstart?>
</textarea></td>
    </tr>
    <tr bgcolor=#e7f3ff>
      <td  width="100" bgcolor=#999999 align="right"><font color="#FFFFFF">内容结束:</font></td>
      <td bgcolor="#FFFFFF"><textarea name="flagcontentend" cols="70" rows="5" class="inputbox" id="flagcontentend" ><?=$flagcontentend?>
</textarea></td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FFFFFF"><table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>
						<?
							for($i=0;$i<count($flagadstartarray);$i++)
							{
						?>
						<table  border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="100" bgcolor="#999999" align="right"><font color="#FFFFFF">广告开始:</font> </td>
                  <td bgcolor="#FFFFFF"><textarea name="flagadstart[]" cols="70" rows="2" class="inputbox" id="adstartflag"><?=$flagadstartarray[$i]?></textarea></td>
                </tr>
                <tr>
                  <td width="100" bgcolor="#999999" align="right"><font color="#FFFFFF">广告结束:</font> </td>
                  <td bgcolor="#FFFFFF"><textarea name="flagadend[]" cols="70" rows="2" class="inputbox" id="adendflag"><?=$flagadendarray[$i]?></textarea></td>
                </tr>
              </table>
						<?
							}
						?>
              <span id="upid" ></span></td>
          </tr>
        </table></td>
    </tr>
		<tr>
		  <td colspan="2" bgcolor="#FFFFFF">
			<?
				for($i=0;$i<count($flagsinglearray);$i++)
				{
			?>
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					 <td width="100" bgcolor="#999999" align="right"><font color="#FFFFFF">单项替换:</font> </td>
					 <td bgcolor="#FFFFFF"><textarea name="flagsingle[]" cols="70" rows="2" class="inputbox" id="flagsingle"><?=$flagsinglearray[$i]?></textarea></td>
				</tr>
			</table>
			<?
				}
			?>
		<span id="upid1" ></span>
		</td>
   </tr>
    </tr>		
    <tr bgcolor=#b6cdef>
      <td width="100" bgcolor="#999999"><font color="#FFFFFF">&nbsp;</font></td>
      <td bgcolor="#FFFFFF"><input name="button" type="button" class="inputbox" onClick="setid();" value="添 加 屏 蔽 广 告 " >
			<input name="addsingleflag" type="button" class="inputbox" onClick="setid1();" value=" 添 加 单 项 替 换 " >
        <input name="s_edit" type="submit" class="inputbox" value=" 修 改 采 集 列 表 ">
        <input type="hidden" name="id" value="<?=$id?>"></td>
    </tr>
    </TBODY>
    
  </table>
</form>
<script language="javascript">
<!--
//动态添加
function setid()
{
reval  = "";
reval += "	<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
reval += "		<tr>";
reval += "			<td width=\"100\" bgcolor=\"#999999\" align=\"right\">";
reval += "				<font color=\"#FFFFFF\">广告开始:</font>			</td>";
reval += "			<td bgcolor=\"#FFFFFF\">";
reval += "			<textarea name=\"flagadstart[]\" cols=\"70\" rows=\"2\" id=\"flagadstart\" class=\"inputbox\"></textarea></td>";
reval += "		</tr>";
reval += "		<tr>";
reval += "			<td width=\"100\" bgcolor=\"#999999\" align=\"right\">";
reval += "				<font color=\"#FFFFFF\">广告结束:</font>			</td>";
reval += "			<td bgcolor=\"#FFFFFF\">";
reval += "			<textarea name=\"flagadend[]\" cols=\"70\" rows=\"2\" id=\"flagadend\" class=\"inputbox\"></textarea></td>";
reval += "		</tr>";
reval += "		</table>";

	upid.innerHTML=upid.innerHTML + reval;
//	alert(reval);
}

function setid1()
{
reval  = "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
reval += "	<tr>";
reval += "		<td width=\"100\" bgcolor=\"#999999\" align=\"right\">";
reval += "			<font color=\"#FFFFFF\">单项替换:</font>			</td>";
reval += "		<td bgcolor=\"#FFFFFF\">";
reval += "		<textarea name=\"flagsingle[]\" cols=\"70\" rows=\"2\" id=\"flagsingle\" class=\"inputbox\"></textarea></td>";
reval += "	</tr>";
reval += "	</table>";
upid1.innerHTML=upid1.innerHTML + reval;
//alert(reval);

}
-->		
</script>
</body>
</html>
