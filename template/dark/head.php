<html>
<head>
<title><?=$title . $forumtitle . BBS_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?=BBS_KEYWORD?>" />
<meta name="description" content="<?=BBS_DESC?>" />
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="stylesheet" type="text/css" href="template/dark/index.css" />

</head>
<body vlink='#000000' link='#000000'>
<table cellspacing=0 cellpadding=0 width='100%' bgcolor=#1F1F1F align=center>
  <tr>
    <td align='center'><table width="95%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align='left' id="logo" onClick="window.open('<?=BBS_INDEX?>','_self')"></td>
          <td align="right">&nbsp;</td>
        </tr>
      </table></td>
  </tr>  
  
  <tr>
  	<td align='center' class=smalltxt height=30>&raquo;
      <?php if($user->groupid==''){?>
      您尚未 <a href="login.php"><font color=ffc600><b>登录</b></font></a> &nbsp; <a href="reg.php"><font color=ffc600><b>注册</b></font></a>
      <?php }else{?>
      <b><?=$user->username?></b>&nbsp;<a href="login.php?action=quit">退出</a> | <a href="profile.php">控制面板</a> | <a href='message.php' target="_blank">
      <?php if($user->newpm==1){ ?>
      <font color=yellow>您有新消息</font></a>
      <?php }else{ ?>
      短消息</a>
      <?php }?>
      | <a href='search.php'>搜索</a>
      <?php } 
?>
      | <a href='faq.php'>帮助</a>
      | 可选风格
      	<select name="jumpMenu" id="jumpMenu" onChange="Theme(this.options[this.selectedIndex].value);">
	        <option value="default" <?php if($user->theme=='default') echo 'selected' ?>>默认风格</option>
	        <option value="dark"    <?php if($user->theme=='dark')    echo 'selected' ?>>酷黑</option>
	        <option value="ipb"     <?php if($user->theme=='ipb')     echo 'selected' ?>>IPB</option>
        </select>
				<script type="text/javascript">
					function Theme(value){	window.open('job.php?action=theme&value='+value + '&reurl=<?=$_SERVER ['REQUEST_URI']?>','_self');}
        </script>      
      </td>
  </tr>
</table>
<br>