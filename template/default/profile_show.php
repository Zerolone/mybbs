<br>
<table width='98%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV?> -> 信息资料</b></b></td>
  </tr>
</table>
<br>
<?php require_once(TP.'profile_head.php'); ?><br>
<table width='98%' cellspacing=1 cellpadding=5 align=center bgcolor=#E7E3E7>
  <tr>
    <td align='center' class=head colspan=2>个人信息 (数字ID:
      <?=$userdb['uid']?>
      )</td>
  </tr>
  <tr>
    <td width=35% class='f_two'>用户名</td>
    <td class='f_two'><?=$userdb['username']?>
      (<b>
      <?php if($userdb['thisvisit']+TIME_ONLINETIME*1.5>TIMESTAMP){?>
      在线
      <?php } else{?>
  		离线
      <?php } ?>
      </b>)--- <a href='search.php?authorid=<?=$userdb['uid']?>&step=2'>[用户主题]</a></td>
  </tr>
  <tr>
    <td class='f_two'>会员等级</td>
    <td class='f_two'><?=$systitle?></td>
  </tr>
  <tr>
    <td class='f_one'>发帖</td>
    <td class='f_one'><?=$userdb['postnum']?></td>
  </tr>
  <tr>
    <td class='f_two'><?=CREDIT_RVRC?></td>
    <td class='f_two'><?=$userdb['rvrc']  . CREDIT_RVRC_EXT?></td>
  </tr>
  <tr>
    <td class='f_one'><?=CREDIT_MONEY?></td>
    <td class='f_one'><?=$userdb['money'] . CREDIT_MONEY_EXT?></td>
  </tr>
  <tr>
    <td class='f_two'>头像</td>
    <td class='f_two'><img src="image/face/<?=$userdb['icon']?>" /></td>
  </tr>
  <tr>
    <td class='f_one'>Email</td>
    <td class='f_one'><?=$userdb['email']?></td>
  </tr>
  <tr>
    <td class='f_two'>OICQ:</td>
    <td class='f_two'><?=$userdb['oicq']?></td>
  </tr>
  <tr>
    <td class='f_two'>性别</td>
    <td class='f_two'>
		<?php if($userdb['gender']==1){?>
    男
    <?php }elseif($userdb['gender']==2){?>
    女
    <?php }else{?>
    保密
    <?php }?>
    </td>
  </tr>
  <tr>
    <td class='f_one'>生日</td>
    <td class='f_one'><?=$userdb['bday']?></td>
  </tr>
  <tr>
    <td class='f_two'>个人主页</td>
    <td class='f_two'><a href="" target="_blank"><a href="<?=$userdb['site']?>" target="_blank"><?=$userdb['site']?></a></td>
  </tr>
  <tr>
    <td class='f_one'>签名</td>
    <td class='f_one'><table style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
        <tr>
          <td><?=$tempsign?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class='f_two'>自我简介<br>
      --少于100字节</td>
    <td class='f_two'><table style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
        <tr>
          <td><?=$tempintroduce?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class='f_one'>注册时间</td>
    <td class='f_one'><?=$show_regdate?></td>
  </tr>
  <tr>
    <td class='f_two'>平均每日发帖</td>
    <td class='f_two'><?=$averagepost?>篇 (今日<?=$userdb['todaypost']?>篇)</td>
  </tr>
  <tr>
    <td class='f_one'>最后登录</td>
    <td class='f_one'><?=$lasttime?></td>
  </tr>
  <tr>
    <td class='f_two'>相关动作</td>
    <td class='f_two'><a href='message.php?action=write&touid=<?=$userdb['uid']?>'> <img src='images/blank.gif' id="td_message"></a></td>
  </tr>
</table>
<br>
<center>
  <input type=submit value='返 回' onclick='javascript:history.go(-1)'>
</center>