<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="zh-cn">
<link href="<?=SITE_FOLDER?>/css/manage.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=SITE_FOLDER?>/js/all.js"></script>
<script language="javascript" src="<?=SITE_FOLDER?>/js/mdiwin.js"></script>
<script language="javascript">
<!--
function showleftbar()
	{
		window.top.Frame_Main.cols="180,*";
    LeftBar.style.display="none";
	}
	
function hideleftbar()
  {top.Frame_Main.cols="0,*";
   LeftBar.style.display="";
   show=false;
  }

function removewin(window)
{
	if (window == 0)
	{
		if(!confirm("注意：\n \n    是否要关闭所有页面? "))
		{
			return false;
		}
		else
		{
			win.removeall();
		}
	}
	else
	{
			win.removewin(win.currentwin);
	}
}
-->
</script>
<base target="_self">
</head>

<body  onload="init()"  scroll="no">
<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td height="21">
			<table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed" bgcolor="#D6D3CE">
				<tr height="21" bgcolor="#D6D3CE">
					<td valign="bottom" nowrap width="*">
						<div style="overflow:hidden;width:100%">
							<div id="titlelist" style="margin-left:0;z-index:-1">
							</div>
						</div>
					</td>
					<td align="center" class="menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" width="24" height="15" title="显示菜单" id="LeftBar" onClick="showleftbar()" style="display:none;"><img src="images/menu_show.gif"></td>
					<td align="center" class="menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" width="15" height="15" title="向左移动" onMouseDown="tabscroll('left')"  onmouseup="tabscrollstop()"><img src="images/move_left.gif"></td>
					<td align="center" class="menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" width="15" height="15" title="向右移动" onMouseDown="tabscroll('right')" onMouseUp="tabscrollstop()"><img src="images/move_right.gif"></td>
					<td align="center" class="menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" width="20" height="20" title="关闭一个窗口" onClick="removewin(1)"><img src="images/close_one.gif"></td>
					<td align="center" class="menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" width="20" height="20" title="关闭所有窗口" onClick="removewin(0)"><img src="images/close_all.gif"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="*">
			<table height="100%" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td id="mywindows" colspan="5" bgcolor="#D6D3CE" height="100%" width="100%"><p align="center"><br>
					  欢迎使用 Monolith Cms 
					    后台管理系统，请点击左边菜单进行操作。                      
				  <p align="center">追求和WORD一样方便易用的内容管理系统。<br>
				   &nbsp; <br>
				  </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<iframe name="tabWin" marginwidth="1" marginheight="1" scrolling="no" border="0" frameborder="0" src="about:link" width="0" height="0">浏览器不支持嵌入式框架，或被配置为不显示嵌入式框架。</iframe>
</body>
</html>