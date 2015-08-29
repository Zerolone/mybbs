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
          <div class="tac" style="padding:10px 0"><a href="search.php?authorid=<?=$user->uid?>&step=2">我的主题</a></div>
          <ul class="lh24 bor-t-a pt10">
            <li>会员头衔:
              <?=$systitle?>
            </li>
            <li>UID:
              <?=$user->uid?>
            </li>
          </ul>
          <div class="c mt10"></div>
          <ul class="lh24 bor-t-a pt10">
            <li>注册时间:
              <?=$user->regdate?>
            </li>
            <li>最后登入:
              <?=$user->lastvisit?>
            </li>
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
              <td class="vt"><div id="u-cont-m" class="fl">
                  <h1 class="f20 b p10">
                    <?=$user->username?>
                    你好,欢迎回来!</h1>
                  <div class="p10">
                    <div class="u-box-a"> <span class="f14 b lh24">最新消息</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="message.php" class="green">进入短消息中心&nbsp;&gt;&gt;</a>
                      <ul class="pt10 lh24 bor-t-b mt5">
                        <?php
											$id=0;
											foreach($msgdb as $key => $value){
											?>
                        <li><span class="gray fr">
                          <?=$value['username']?>
                          </span><a href="message.php?action=read&mid=<?=$value['mid']?>" target="_blank">
                          <?=$value['title']?>
                          </a></li>
                        <?php }?>
                      </ul>
                    </div>
                  </div>
                </div>
                <div id="u-cont-sidebar" class="fr">
                  <div class="u-box-b mt5">
                    <div class="u-box-b-bg">
                      <h2><span class="b">我的积分</span></h2>
                      <div class="p10">
                        <div class="lh24 bor-t-b mt5">
                          <ul class="pt10 list-half cc">
                            <li>
                              <?=CREDIT_RVRC?>
                              :
                              <?=$user->rvrc?>
                              <?=CREDIT_RVRC_EXT?>
                            </li>
                            <li>
                              <?=CREDIT_MONEY?>
                              :
                              <?=$user->money?>
                              <?=CREDIT_MONEY_EXT?>
                            </li>
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
