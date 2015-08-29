<div class="bg">
<div class="cnyouws">
  <div class="main-wrap">
    <div id="main">
      <div class="forum-info cc gray">
        <div class="fr">主题:
          <?=$topics?>
          · 帖子:
          <?=$posts?>
          · 会员:
          <?=$totalmember?>
          · 新会员:<a href='profile.php?action=show&username=<?=$rawnewuser?>' target=_blank><font color=#ff0000>
          <?=$newmember?>
          </font></a>&nbsp;</div>
      </div>
      <?php if($notices){ ?>
      <div class="noticebg">
        <div id="notice">
          <div id="notice0" style="width:98%;height:18px;line-height:18px;overflow-y:hidden;">
            <ul>
              <?php foreach($notices as $notice){?>
              <li><a href="notice.php?#<?=$notice['id']?>">
                <?=$notice['title']?>
                &nbsp;</a> <span class="f9 gray">
                <?=$notice['startdate']?>
                </span></li>
              <?php }?>
            </ul>
          </div>
        </div>
      </div>
      <?php }?>
      <div class="contentc"></div>
      <div id="content">
        <div class="contentwrap z">
          <?php 
						$i=0;
						foreach($forums as $forum){
						if(strlen($forum['level'])==2){ 
						$i++;
						if($i>1) echo ' </table></div>   ';
						?>
          <div class="t z" >
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <th class="h f10" colspan="6"><span class="fr a2 fn" style="margin-right:20px">分栏版主:
                  <?=$forum['forumadmin']?>
                  </span>
                  <h2>
                    <?=$forum['logo']?>
                    站务综合 | Community Affairs</h2>
                </th>
              </tr>
              <tbody>
                <tr class="tr2 f10">
                  <td width="30" colspan="2" class="tac">版块</td>
                  <td class="tal y-style e">主题 / 文章</td>
                  <td class="tal y-style f">最后发表</td>
                </tr>
                <?php } else{ ?>
                <tr class="tr3 t_one">
                  <td class="tac forum<?=$forum['pic']?>" width="30"><a href='topic.php?fid=<?=$forum['fid']?>' TARGET=_blank></a></td>
                  <th><a href='topic.php?fid=<?=$forum['fid']?>' TARGET=_blank>
                    <?=$forum['logo']?>
                    </a>
                    <h3 class="b"><a href='topic.php?fid=<?=$forum['fid']?>' class='fnamecolor'>
                      <?=$forum['title']?>
                      </a></h3>
                    <div class="smalltxt gray" id="desc_54">
                      <?=$forum['content']?>
                    </div>
                  </th>
                  <td><b><?=$forum['topic']?></b>/<span class="f10"><?=$forum['post']?></span></td>
                  <th class="f10"> 
                  	<a href="<?=$forum['ft']?>"><?=$forum['t']?></a><br />
                    <span class="gray"><?=$forum['author']?></span>
                    <span class="f9 gray"><?=$forum['lastpost']?></span>
                  </th>
                </tr>
              </tbody>
              <?php }}?>
            </table>
          </div>
        </div>
      </div>
      <div class="c"></div>
      <div class="t">
        <table cellspacing="0" cellpadding="0" width="100%">
          <tr>
            <th class="h f10" colspan="2"><b>我的信息</b></th>
          </tr>
          <tr height=40>
            <td class=user align=center width=5% rowspan=1></td>
            <td class=f10 width=95%><?php if($user->groupid==''){?>
              请先登录论坛,等级: <b>游客</b><br>
              <table cellpadding=0 cellspacing=0>
                <form action='login.php' method=post>
                  <tr>
                    <td> 用户名:
                      <input type=text size=8 name='username'>
                      密码:
                      <input type='password' size=8 name='password'>
                      <input type='hidden' name='jumpurl' value='<?=BBS_INDEX?>'>
                      <input type='hidden' name='step' value=2>
                      <input type='hidden' name='cktime' value='31536000'>
                      <input type=submit value='登 录'></td>
                  </tr>
                </form>
              </table>
              <?php }else{?>
              您的等级:<b>
              <?=$group['title']?>
              </b>
              <?=CREDIT_RVRC?>
              : <b>
              <?=(int)($user->rvrc/10) . CREDIT_RVRC_EXT?>
              </b> /
              <?=CREDIT_MONEY?>
              : <b>
              <?=$user->money . CREDIT_MONEY_EXT?>
              </b> / 
              共发表帖子: <b>
              <?=$user->postnum?>
              </b><br>
              您上次登录时间:
              <?=get_date($user->lastpost)?>
              | <a href="search.php?authorid=<?=$user->uid?>"><b>查看我的主题</b></a>
              <?php }?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
