<html>
<head>
<title><?=$title . $forumtitle . BBS_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?=BBS_KEYWORD?>" />
<meta name="description" content="<?=BBS_DESC?>" />
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="stylesheet" type="text/css" href="template/ipb/index.css" />

</head>
<body vlink="#333333" link="#333333">
<table cellspacing=1 cellpadding=0 width='100%' class=i_table align=center>
  <tr valign='bottom'>
    <td align='left' id="logobg" onClick="window.open('<?=BBS_INDEX?>','_self')"><span id="logo"></span></td>
  </tr>
  <tr>
    <td align='right' class=cbg colspan=2 height=26> | <a href='faq.php'>帮助</a> |
可选风格
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
<table border="0"  width=100%  align="center">
  <tr >
    <td align="center"  height=5 ></td>
  </tr>
</table>
<?php if($user->groupid==''){?>
<table border="1" bordercolor="#986265" cellpadding="0" cellspacing="0"    style="border-collapse: collapse"  width=100%  align="center">
  <tr bgcolor="#F4E7EA" align="center">
    <td align="center"   height=28 >欢迎游客 <a href=login.php><b>(登录</b></a> |<a href='reg.php'><b>注册)</b></a></td>
  </tr>
</table>
<?php }else{?>
<table border="1" bordercolor="#C2CFDF" cellpadding="0" cellspacing="0"    style="border-collapse: collapse"  width=100%  align="center">
  <tr bgcolor="#F0F5FA" align="center"> 
    <td align="center" height=28><b><?=$user->username?></b>&nbsp;<a href='login.php?action=quit'>退出</a>| <a href=profile.php>控制面板</a> | <a href='message.php' target="_blank">
    	<?php if($user->newpm==1){ ?>
      <font color=red>您有新消息</font>
      <?php }else{ ?>
      短消息
      <?php }?>
    </a>
    | <a href='search.php'>搜索</a>
</td></tr>
</table>
<?php }?>