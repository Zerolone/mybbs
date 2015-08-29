<html>
<head>
<title><?=$title . $forumtitle . BBS_NAME?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?=BBS_KEYWORD?>" />
<meta name="description" content="<?=BBS_DESC?>" />
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="stylesheet" type="text/css" href="template/56k/index.css" />

</head>
<body vlink="#666666" link="#666666">
<table cellspacing=0 cellpadding=0 width='98%' align=center>
  <tr valign='bottom'>
    <td align='left' id="logobg" onClick="window.open('<?=BBS_INDEX?>','_self')"><span id="logo"></span></td>
  </tr>
  <tr >
    <td align="center"  height=10 bgcolor=#D5D5D5></td>
  </tr>
  <tr bgcolor="#F0F5FA" align="center"> 
     <td align='center' bgcolor=#D5D5D5 height=26>
		 <?php if($user->groupid==''){?>
     欢迎游客 <a href=login.php><b>(登录</b></a> |<a href='reg.php'><b>注册)</b></a>
		 <?php }else{?>
     <b><?=$user->username?></b>&nbsp;<a href='login.php?action=quit'>退出</a>| <a href=profile.php>控制面板</a> | <a href='message.php' target="_blank">
    	<?php if($user->newpm==1){ ?>
      <font color=red>您有新消息</font>
      <?php }else{ ?>
      短消息
      <?php }?>
    </a>
    | <a href='search.php'>搜索</a>
    | <a href='faq.php'>帮助</a> |
</td></tr>
</table>
<?php }?>