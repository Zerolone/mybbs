<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="/css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="JavaScript" src="/js/all.js"></script>
<script language="JavaScript" src="/js/trcolor.js"></script>

  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
    <tr height="26">
      <td height="26" colspan="8" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;报名管理 &gt;&gt; 当前状态统计</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td width="100%" bgcolor=#999999 height=20>&nbsp;</td>
    </tr>
    <tr>
    	<td>
		<?php
			$i=1;
			$step=100;
			if(isset($now_list)){
				foreach ($now_list as $now){
					$width	= round($now['count']/$count * $step);
					$width_blank	= $step-$width;
		?>    
    <p><img src="img/v<?=$i?>.gif" width="2" height="10" /><img src="img/vbg<?=$i?>.gif" width="<?=$width?>" height="10" /><img src="img/v<?=$i?>b.gif" width="2" height="10" /><img src="img/bg.jpg" width="<?=$width_blank?>" height="10" /> <?=$width?>% (<?=$now['count']?>) <?=$now['title']?></p>
    <?php
					$i++;
				}
		}	
		?>
    </td>
    </tr>
		<tr height="22" valign="bottom">
    <td colspan="8" width="100%" align="right">
		<input type="button" class="inputbox" onclick='history.go(0);' value=" 刷 新 页 面 "></td>
	</tr>
	</table>
</body>
</html>
