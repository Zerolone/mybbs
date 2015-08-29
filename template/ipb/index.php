<?php if($notices){?>
<br>
<table cellspacing=0 cellpadding=0 width='100%' align=center>
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
<table border="1" bordercolor="#C2CFDF" cellpadding="0" cellspacing="0"    style="border-collapse: collapse"  width=100%  align="center">
  <tr bgcolor="#F0F5FA" align="center">
    <td align="center"><table cellspacing="4" cellpadding="5" border="0" width="100%" >
        <tr class="mediumtxt">
          <td >
	          <?php if($user->groupid==''){?>
            请先登陆论坛,等级: <b>游客</b><br>
            <table cellpadding=0 cellspacing=0>
            <form action='login.php' method=post>
              <tr>
                <td>
                	<input type=text size=8 name='username'>
                  <input type='password' size=8 name='password'>
                  <input type='hidden' name='jumpurl' value='<?=BBS_INDEX?>'>
                  <input type='hidden' name='step' value=2>
                  <input type='hidden' name='cktime' value='31536000'>
                  <input type=submit value='登 录'>              
                </td>
              </tr>
            </form>
            </table>
            <?php }else{?>
            您的 <?=CREDIT_RVRC?> <b><?=(int)($user->rvrc/10)?></b> <?=CREDIT_RVRC_EXT?> / 等级: <b><?=$group['title']?></b> <br>
            <?=CREDIT_MONEY?>: <b><?=$user->money?></b> <?=CREDIT_MONEY_EXT?> RMB / 共发表帖子: <b><?=$user->postnum?></b> <br>
            您上次访问是在 <?=get_date($user->lastpost)?>
            <?php }?>
          </td>
          <td align="right" nowrap valign="bottom">
            共 <span class="bold"><?=$topics?></span> 篇主题 
            / <span class="bold"><?=$posts?></span> 篇帖子 / <span class="bold"><?=$totalmember?></span> 位会员<br>
            欢迎新会员 <a href='profile.php?action=show&username=<?=$rawnewuser?>' target=_blank><span class="bold"> <?=$newmember?></span></a></td>
        </tr>
      </table></td>
  </tr>
</table>

<!-- 论坛循环 -->
<?php
$i=0;
foreach($forums as $forum){
	$i++;
	if(strlen($forum['level'])==2){ 
		if($i>1) echo '</table>';
?>
<br />
<table cellspacing=1 cellpadding=5 width='100%' class=i_table align=center>
  <tr>
    <td class=head colspan=6 align=left><b><?=$forum['title']?></b>&nbsp; <b>分类版主：</b><?=$forum['forumadmin']?></td>
  </tr>  
  <tr height=23 align=center class='cbg'>
    <td width=5%></td>
    <td width=50%>论坛</td>
    <td width=6%>主题</td>
    <td width=6%>文章</td>
    <td width=21%>最后发表</td>
    <td width=12%>版主</td>
  </tr>
  <?php } else{ ?>
  <tr>
  	<td align=center valign=middle class="f_one forum<?=$forum['pic']?>" onclick="window.open('topic.php?fid=<?=$forum['fid']?>')"></td>
    <td class='f_one' align=left>
    	<a href='topic.php?fid=<?=$forum['fid']?>' TARGET=_blank><?=$forum['logo']?></a>&nbsp;
      <a href='topic.php?fid=<?=$forum['fid']?>' class='fnamecolor'><b><?=$forum['title']?></b></a><br><span class=smalltxt><?=$forum['content']?></span>
    </td>
    <td align=center class=f_two><b><?=$forum['topic']?></b></td>
    <td align=center class=f_two><?=$forum['post']?></td>
    <td class='smalltxt f_two' bgcolor=#FFFFFF> 主题: <a href="<?=$forum['ft']?>"><?=$forum['t']?></a><br>作者: <?=$forum['author']?><br>时间: <?=$forum['lastpost']?> </td>
    <td class=f_two align=center><?=$forum['forumadmin']?></td>
  </tr>
<?php }}?>
</table>