<table cellspacing=0 cellpadding=0 width='98%' align=center class=big_table>
  <tr>
    <td><table cellspacing=0 cellpadding=0 width='95%' align=center class=small_table>
    	<tr><td>
<?php if($notices){?>
<br />
<table cellspacing=0 cellpadding=0 width='98%' align=center class=big_table>
  <tr>
    <td>
    <?php foreach($notices as $notice){?>
    <b><a href="notice.php?#<?=$notice['id']?>"><?=$notice['title']?>(<?=$notice['startdate']?>)</a></b>&nbsp;&nbsp;&nbsp;
    <?php }?>
    </td>
  </tr>
</table>
<?php }?>
<br />
<table width="98%" cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td valign=top></td>
    <td align=right class=smalltxt> 共 <b><?=$topics?></b> 篇主题 | <b><?=$posts?></b> 篇帖子 | <b><?=$totalmember?></b> 位会员 | 欢迎新会员 <a href='profile.php?action=show&username=<?=$rawnewuser?>' target=_blank><font color=#ff0000> <?=$newmember?></a></td>
  </tr>
</table>

<!-- 论坛循环 -->
<?php foreach($forums as $forum){
				if(strlen($forum['level'])==2){ ?>
<br />
<table cellspacing=1 cellpadding=5 width='98%' class=i_table align=center>
  <tr>
    <td class=head colspan=5 align=left><?=$forum['logo']?><b><?=$forum['title']?></b></td>
  </tr>
  <tr height=23 align=center class='cbg'>
    <td width=5%></td>
    <td width=54%>&nbsp;</td>
    <td width=8%>发帖|回复</td>
    <td width=21%>最后发表</td>
    <td width=12%>版主</td>
  </tr>
  <?php } else{ ?>
  <tr>
  	<td align=center valign=middle class="forum<?=$forum['pic']?>" onclick="window.open('topic.php?fid=<?=$forum['fid']?>')"></td>
    <td class='f_one' align=left onMouseOver="this.className='f_two'" onMouseOut="this.className='f_one'">
    	<a href='topic.php?fid=<?=$forum['fid']?>' TARGET=_blank><?=$forum['logo']?></a>&nbsp;
      <a href='topic.php?fid=<?=$forum['fid']?>' class='fnamecolor'><b><?=$forum['title']?></b></a><br><span class=smalltxt><?=$forum['content']?></span>
    </td>
    <td align=center class=f_two><b><?=$forum['topic']?></b><br /><?=$forum['post']?></td>
    <td class='smalltxt' bgcolor=#E8E8E8> 主题: <a href="<?=$forum['ft']?>"><?=$forum['t']?></a><br>作者: <?=$forum['author']?><br>时间: <?=$forum['lastpost']?> </td>
    <td class=f_two align=center><?=$forum['forumadmin']?></td>
  </tr>
<?php }}?>
</table>
<br>
<table cellpadding=5 cellspacing=1 width="98%" bgcolor=#E7E3E7 align=center>
  <tr>
    <td colspan=2 class=head><b>论坛相关信息</b></td>
  </tr>
  <tr>
    <td colspan=2 class=index_font>我的信息</td>
  </tr>
  <tr height=40>
    <td class="f_two user" align=center width=5% rowspan=1></td>
    <td class=f_one width=95%> 
    <?php if($user->groupid==''){?>
      请先登录论坛,等级: <b>游客</b><br>
      <table cellpadding=0 cellspacing=0>
      <form action='login.php' method=post>
	      <tr><td>
        用户名: <input type=text size=8 name='username'>
        密码: <input type='password' size=8 name='password'>
        <input type='hidden' name='jumpurl' value='<?=BBS_INDEX?>'>
        <input type='hidden' name='step' value=2>
        <input type='hidden' name='cktime' value='31536000'>
        <input type=submit value='登 录'></td>
        </tr></form></table>
     <?php }else{?>    
    您的等级:<b><?=$group['title']?></b> <?=CREDIT_RVRC?>: <b><?=(int)($user->rvrc/10) . CREDIT_RVRC_EXT?></b> / <?=CREDIT_MONEY?>: <b><?=$user->money . CREDIT_MONEY_EXT?></b> / 
      共发表帖子: <b><?=$user->postnum?></b><br>
      您上次登录时间:<?=get_date($user->lastpost)?> | <a href="search.php?authorid=<?=$user->uid?>"><b>查看我的主题</b></a>
     <?php }?>
      </td>
  </tr>
</table>