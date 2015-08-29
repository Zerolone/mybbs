<?php if($notices){?>
<table cellspacing=0 cellpadding=0 width='95%' align=center>
  <tr>
    <td id="nav">
    <?php foreach($notices as $notice){?>
    <a href="notice.php?#<?=$notice['id']?>"><font color=yellow><?=$notice['title']?></font>(<?=$notice['startdate']?>)</a>&nbsp;&nbsp;&nbsp;
    <?php }?>
    </td>
  </tr>
</table>
<br />
<?php }?>

<table width='95%' cellspacing=2 cellpadding=2 align=center>
  <tr>
	  <?php if($user->groupid==''){?>
    <td class=smalltxt> 请先<span class="style1"><a href="reg.php">注册</a></span>或登陆,您当前等级为游客<br>
      <table cellpadding=0 cellspacing=0>
        <form action='login.php' method=post>
          <tr>
            <td>
              用户名: <input type=text size=8 name='username'>
              密码: <input type='password' size=8 name='password'>
              <input type='hidden' name='jumpurl' value='<?=BBS_INDEX?>'>
              <input type='hidden' name='step' value=2>
              <input type='hidden' name='cktime' value='31536000'>
              <input type=submit value='登 录'>              
            </td>
          </tr>
        </form>
      </table></td>
      <?php }else{?>
      <td class=smalltxt><font color=#A4A4A4>您的等级: <b><?=$group['title']?></b>, <?=CREDIT_RVRC?>: <?=(int)($user->rvrc/10) . CREDIT_RVRC_EXT?> , <?=CREDIT_MONEY?>: <?=$user->money . CREDIT_MONEY_EXT?><br>
      发表帖子: 共 <?=$user->postnum?> 篇, 您上次登陆在: <?=get_date($user->lastpost)?></font></td>
			<?php }?>      
    <td align=right class=smalltxt><br>
      <a href='search.php?authorid=<?=$user->uid?>'>我的话题</a> | 欢迎新会员 &raquo; <a href='profile.php?action=show&username=<?=$rawnewuser?>' target=_blank><font color=#ffc600> <?=$newmember?></a></td>
      
  </tr>
</table>

<!-- 论坛循环 -->
<table cellspacing=1 cellpadding=5 width='95%' bgcolor=#1F1F1F align=center>
<?php foreach($forums as $forum){
				if(strlen($forum['level'])==2){ ?>
  <tr><td class=head1 colspan=6></td></tr>  
  <tr>
    <td class="tcat" colspan=6 align=left><?=$forum['logo']?><b><?=$forum['title']?></b></td>
  </tr>

  <tr height=23 align=center class='cbg'>
    <td width=55% colspan=2>论坛</td>
    <td width=6%>主题</td>
    <td width=6%>文章</td>
    <td width=21%>最后发表</td>
    <td width=12%>版主</td>
  </tr>
  <?php } else{ ?>
  <tr>
  	<td class="f_two forum<?=$forum['pic']?>" width='5%' onclick="window.open('topic.php?fid=<?=$forum['fid']?>')">&nbsp;</td>
    <td class='f_one' align=left onMouseOver="this.className='f_two'" onMouseOut="this.className='f_one'">
    	<a href='topic.php?fid=<?=$forum['fid']?>' TARGET=_blank><?=$forum['logo']?></a>&nbsp;
      <a href='topic.php?fid=<?=$forum['fid']?>' class='fnamecolor'><b><?=$forum['title']?></b></a><br><span class=smalltxt><?=$forum['content']?></span>
    </td>
    <td class=f_two align=center> <?=$forum['topic']?></td>
    <td class=f_two align=center> <?=$forum['post']?></td>
    <td class='f_one'  align=right><a href="<?=$forum['ft']?>"><?=$forum['t']?></a><br><?=$forum['lastpost']?><br />by: <?=$forum['author']?></td>
    <td class=f_two align=center style='word-break: keep-all'><?=$forum['forumadmin']?></td>
  </tr>
<?php }}?>
</table>