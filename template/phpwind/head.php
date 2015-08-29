<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
<?=$title . $forumtitle . BBS_NAME?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?=BBS_KEYWORD?>" />
<meta name="description" content="<?=BBS_DESC?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<link rel="stylesheet" type="text/css" href="wind-reset.css" />
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="stylesheet" type="text/css" href="template/phpwind/wind-reset.css" />
<link rel="stylesheet" type="text/css" href="template/phpwind/index.css" />
</head>
<body>
<div class="new_topbar_wrap">
  <div class="new_topbar">
    <div class="cc">
			<?php if($user->groupid==''){?>
      <a href="login.php">登录</a>
      <a href="reg.php">注册</a>
      <?php }else{?>
    	<span class="new_topbar_left"><span id="span_userinfomore"><?=$user->username?></span></span>
      <a href="login.php?action=quit" hidefocus="true">退出</a>
      <span id="span_profile"><a href="profile.php" >设置</a></span> 
      <a id="td_msg" href="message.php"  target="_blank" class="backend">
			<?php if($user->newpm==1){ ?>
      <font color=red>您有新消息</font></a>
      <?php }else{ ?>
      短消息</a>
      <?php }?>      
      <a href='search.php'>搜索</a>
      <a href='faq.php'>帮助</a>
      </span> 
      <?php } ?>
    </div>
  </div>
</div>
<div id="header">
  <div id="head">
    <table cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td align='left' id="logo" onClick="window.open('<?=BBS_INDEX?>','_self')" height="90"></td>
      </tr>
    </table>
  </div>
</div>
