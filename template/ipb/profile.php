<br>
<table width='100%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV?>
      <?php if($action=='forumright'){?>
      -> 版块权限查看 -> <a href="topic.php?fid=<?=$fid?>">
      <?=$rt['name']?>
      </a>
      <?php }else{?>
      -&gt 信息资料
      <?php }?>
      </b></td>
  </tr>
</table>
<br>
<?php require_once(TP.'profile_head.php'); ?>
<br>
<table width='100%' cellspacing=1 cellpadding=4 align=center>
  <tr>
    <td width='23%' valign="top"><table width='100%' cellspacing=1 cellpadding=4 align=center class=i_table>
        <tr>
          <td class="head" align="center"><b>用户头像</b></td>
        </tr>
        <tr>
          <td class="f_one" align="center"><img src="<?=TP?>/images/face/<?=$user->icon?>" border=0><br><br><a href="search.php?authorid=<?=$user->uid?>&step=2">[我的主题]</a></td>
        </tr>
      </table>
      <br>
      <table width='100%' cellspacing=1 cellpadding=4 align=center class=i_table>
        <tr>
          <td class="head" align="center"><b>基本信息</b></td>
        </tr>
        <tr>
          <td class="f_one">
          	用户名:		<?=$user->username?><br>
            会员等级:	<?=$systitle?><br>
            发帖:     <?=$user->postnum?><br>
            <?=CREDIT_RVRC?>:<?=$user->rvrc?><?=CREDIT_RVRC_EXT?><br>
            <?=CREDIT_MONEY?>:<?=$user->money?><?=CREDIT_MONEY_EXT?><br>
            注册时间: <?=$user->regdate?><br>
            最后登录: <?=$user->lastvisit?><br></td>
        </tr>
      </table>
      <br></td>
    <td valign="top"><table width='100%' cellspacing=1 cellpadding=4 align=center class=i_table>
        <tr>
          <td class="head" colspan="6"><b>最新十五条短消息</b></td>
        </tr>
        <tr class="cbg" align="center">
          <td width="5%">ID</td>
          <td width="35%">标题</td>
          <td width="15%">发件人</td>
          <td width="15%">收件人</td>
          <td width="20%">时间</td>
          <td width="5%">已读</td>
        </tr>
        <?php
$id=0;
foreach($msgdb as $key => $value){
	$id++;
?>
        <tr class="f_one" align="center"> 
        	<td><?=$id?></td>
          <td><a href="message.php?action=read&mid=<?=$value['mid']?>" target="_blank"><?=$value['title']?></a></td>
          <td><a href="profile.php?action=show&uid=<?=$value['fromuid']?>"><?=$value['username']?></a></td>
          <td><a href="profile.php?action=show&uid=<?=$value['touid']?>"><?=$value['to']?></a></td>
          <td><?=$value['mdate']?></td>
          <td><?=$value['ifnew']?></td>
        </tr>
        <?php
}
?>
      </table>
    <br></td>
  </tr>
</table>