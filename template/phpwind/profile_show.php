<link rel="stylesheet" type="text/css" href="wind-reset.css" />
<link rel="stylesheet" type="text/css" href="template/phpwind/wind-reset.css" />
<link rel="stylesheet" type="text/css" href="images/user/style.css" />
<link rel="stylesheet" type="text/css" href="template/phpwind/images/user/style.css" />

<div id="user-wrap">
	<?php require_once(TP.'profile_head.php'); ?>
  <div id="user-main">
    <div class="u-m-bg-c cc"> 
      <!--左边栏-->
      <div id="user-sidebar" class="fl">
        <div class="p10">
          <div class="u-face"><img src="<?=TP?>/images/face/<?=$user->icon?>" border=0></div>
          <div class="tac" style="padding:10px 0"><a href="search.php?authorid=<?=$user->uid?>&step=2">用户主题</a></div>
          <ul class="lh24 bor-t-a pt10">
            <li>会员头衔:<?=$systitle?></li>
            <li>UID:<?=$userdb['uid']?></li>
          </ul>
          <div class="c mt10"></div>
          <ul class="lh24 bor-t-a pt10">
            <li>注册时间:<?=$show_regdate?></li>
            <li>最后登入:<?=$lasttime?></li>
          </ul>
        </div>
      </div>
      <!--右边内容-->
      <div id="user-content" class="fr">
        <div class="u-cont-bg"></div>
        <div class="u-cont-bg2"></div>
        <div class="u-cont-bg-c p10" style="border:none;">
          <table width="100%" height="450">
            <tr>
              <td class="vt"><div id="u-cont-mm" class="fr">
                  <div class="u-box-b mt5">
                    <div class="u-box-b-bg">
                      <h2><span class="b">个人信息</span></h2>
                      <div class="p10">
                        <div class="lh24 bor-t-b mt5">
                          <ul class="pt10 list-half cc">
                            <li></li>
                            <li>(<b>
      <?php if($userdb['thisvisit']+TIME_ONLINETIME*1.5>TIMESTAMP){?>
      在线
      <?php } else{?>
  		离线
      <?php } ?>
      </b>)</li>
                            <li>发帖</li>
                            <li><?=$userdb['postnum']?></li>
                            <li><?=CREDIT_RVRC?>:</li>
                            <li><?=$user->rvrc?><?=CREDIT_RVRC_EXT?></li>
                            <li><?=CREDIT_MONEY?>:</li>
                            <li><?=$user->money?><?=CREDIT_MONEY_EXT?></li>                            
                            <li>Email</li>
                            <li><?=$userdb['email']?></li>
                            <li>OICQ</li>
                            <li><?=$userdb['oicq']?></li>
                            <li>性别</li>
                            <li><?php if($userdb['gender']==1){?>
    男
    <?php }elseif($userdb['gender']==2){?>
    女
    <?php }else{?>
    保密
    <?php }?></li>
                            <li>生日</li>
                            <li><?=$userdb['bday']?></li>
                            <li>个人主页</li>
                            <li><a href="" target="_blank"><a href="<?=$userdb['site']?>" target="_blank"><?=$userdb['site']?></a></li>
                            <li>签名</li>
                            <li><table style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
        <tr>
          <td><?=$tempsign?></td>
        </tr>
      </table></li>
                            <li>自我简介</li>
                            <li><table style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
        <tr>
          <td><?=$tempintroduce?></td>
        </tr>
      </table></li>
                            <li>平均每日发帖</li>
                            <li><?=$averagepost?>篇 (今日<?=$userdb['todaypost']?>篇)</li>
                            <li>相关动作</li>
                            <li><a href='message.php?action=write&touid=<?=$userdb['uid']?>'>短信</a></li>

                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
              </div></td>
            </tr>
          </table>
        </div>
        <div class="u-cont-bg2"></div>
        <div class="u-cont-bg"></div>
      </div>
    </div>
    <div class="u-m-bg"></div>
  </div>
</div>
</div>
