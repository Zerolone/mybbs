<div class="bg">
<div class="cnyouws" style="padding:1px 0">
    <ul class="user-nav fl">
    	<li><a href='profile.php'>控制面板首页</a></li>
    	<li><a href="profile.php?action=show&uid=<?=$user->uid?>">查看个人资料</a></li>
    	<li><a href='profile.php?action=modify'>编辑个人资料</a></li>      
    </ul>
<!--左边栏-->
<div id="user-sidebar" class="fl">
  <div class="p10">
    <div class="u-face"><img src="image/face/<?=$user->icon?>" border=0></div>
    <div class="tac" style="padding:10px 0"><a href="search.php?authorid=<?=$user->uid?>&step=2">[我的主题]</a></div>
    <ul class="lh24 bor-t-a pt10">
      <li>会员等级: <?=$systitle?></li>
      <li>UID:<?=$user->uid?></li>
    </ul>
    <div class="c mt10"></div>
    <ul class="lh24 bor-t-a pt10">
      <li>注册时间: <?=$user->regdate?></li>
      <li>最后登入: <?=$user->lastvisit?></li>
    </ul>
  </div>
</div>
<!--右边内容-->
<div id="user-content" class="fr">
<div class="u-cont-bg-c p10" style="border:none;">
  <table width="100%" height="450">
    <tr>
      <td class="vt"><div id="u-cont-m" class="fl">
          <h1 class="f20 b p10">zerolone你好,欢迎回来!</h1>
          <div class="p10">
            <div class="u-box-a"> <span class="f14 b lh24">我的资料</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://cnyouw.com/profile.php?action=modify" class="green">修改资料&nbsp;&gt;&gt;</a></div>
          </div>
        </div></td>
    </tr>
  </table>
</div>
