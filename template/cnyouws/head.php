<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>
<?=$title . $forumtitle . BBS_NAME?>
</title>
<meta name="generator" content="zerolone.com" />
<meta name="keywords" content="<?=BBS_KEYWORD?>" />
<meta name="description" content="<?=BBS_DESC?>" />
<link rel="stylesheet" type="text/css" href="res.css" />
<link rel="stylesheet" type="text/css" href="index.css" />
<link rel="stylesheet" type="text/css" href="template/mybbs/res.css" />
<link rel="stylesheet" type="text/css" href="template/mybbs/index.css" />
</head>
<body>
<div class="bg">
  <div class="cnyouws">
    <div id="header">
      <div id="head"><a href="" class="fl" id="tlogo"></a></div>
      <div class="new_topbar_wrap">
        <div class="new_topbar" > <span class="new_topbar_left">
          <?php if($user->groupid==''){?>
          <a href="login.php">我要登录</a> <a href="reg.php">注册帐号</a>
          <?php }else{?>
          <a href="#"><?=$user->username?></a> <a href="profile.php">控制面板</a>
          <?php if($user->newpm==1){ ?>
          <a href='message.php' target="_blank"><font color=red>您有新消息</font></a>
          <?php }else{ ?>
          <a href='message.php' target="_blank">短消息</a>
          <?php }?>
          <a href='search.php'>搜索</a> <a href="login.php?action=quit">退出</a>
          <?php } 
?>
          </span> </div>
      </div>
      <div class="nav-wrap">
        <div id="nav">
          <div id="nav-global">
            <div class="youbian"> <a href="faq.php">帮助</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
