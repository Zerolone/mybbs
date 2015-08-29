<div class="main-wrap">
  <div id="main">
    <style type="text/css">
.tr3 td,.tr3 th{padding:4px 8px;line-height:1.3;}
.t_search{border:1px solid #a6cbe7;background:#ffffff;margin-left:5px;height:18px;overflow:hidden;}
.t_s_ip{border:1px solid #fff;padding:1px 2px 0;float:left;height:15px; font:12px/14px Arial;background:#fff; width:85px;}
</style>
    <div id="breadCrumb" class="cc"> <span class="fr"> 版主: &nbsp;<?=$foruminfo['forumadmin']?> </span> 
    
    <?=BBS_NAV?> <?=$msg_guide?>
    </div>
    <!--ads begin--><!--ads end-->
    <div class="c"></div>
    <div class="t">
      <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td><div class="pw_list_a">
            <ul>
                <li id="tab_t1" class="current f10"><a href="javascript:;">版块公告</a></li>
              </ul>
            </div></td>
        </tr>
        <tr class="tr2 f10">
          <td> <?=$foruminfo['atitle']?></td>
        </tr>
        <tbody id="cate_thread">
          <tr style="line-height:1.2;">
            <td><div id="tab_1" class="p10 f10" > <?=$foruminfo['acontent']?></div>
                <div class="c"></div>
                <div class="fr"><a class="gray f11" href="notice.php?fid=<?=$foruminfo['fid']?>#<?=$foruminfo['aid']?>">更多</a></div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="c" id="c"></div>
    <div class="t3 cc"> <span class="fr"><?php if($canpost) {?><a href='post.php?fid=<?=$fid?>' ><img src="images/blank.gif" id="td_post" /></a><?php }?></span>
      <div style="padding-top:8px;" class="cc"> <span class="fl">
        <div class="pages"><?=$pages?></div>
        </span>
      </div>
    </div>
    <div id="menu_post" class="menu menu-post cc f14 tac" style="display:none;">
      <div class="menu-b" style="width:100px;"> <a href="post.php?fid=94" title="新 帖" hidefocus="true">新 帖</a> </div>
    </div>
    <div class="t z" style="margin:auto">
      <table cellspacing="0" cellpadding="0" width="100%" id="ajaxtable">
        <tr>
          <th colspan="6"> <div class="pw_list_a pr pw_maxlist">
              <div id="menu_special" class="menu-post tac" style="display:none;">
                <div class="menu-b f14">
                  <ul style="width:77px;*padding-left:5px;line-height:2">
                    <li><a href="thread-htm-fid-94.html">全 部</a></li>
                    <li><a href="thread-htm-fid-94-special-1.html">投 票</a></li>
                    <li><a href="thread-htm-fid-94-special-2.html">活 动</a></li>
                    <li><a href="thread-htm-fid-94-special-3.html">悬 赏</a></li>
                    <li><a href="thread-htm-fid-94-special-4.html">商 品</a></li>
                    <li><a href="thread-htm-fid-94-special-5.html">辩 论</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </th>
        </tr>
        <tbody style="table-layout:fixed;">
          <tr class="tr2">
            <td style="width:2%" class="tac y-style"></td>
            <td> 文章 </td>
            <td style="width:120px;" class="y-style">作者/时间</td>
            <td style="width:80px" class="tal y-style">回复/人气</td>
            <td style="width:120px;" class="y-style">最后发表↓</td>
          </tr>
          <?php
					//为第一页并且
					if($page==1 && $ifsort){
						//论坛公告
						if($NT_A){
					?>
          <tr align="middle" class="tr3 t_one">
            <td class="tac topicnotice1"></td>
            <th>分类公告: <a href='notice.php?level=<?=$NT_A['level']?>#<?=$NT_A['id']?>'><?=$NT_A['title']?></a></th>
            <td colspan="2" class="tal y-style">分类公告</td>
            <td class="y-style f10"><?=$NT_A['startdate']?></td>
          </tr>
					<?php
            }
            if($NT_C){
          ?>
          <tr align="middle" class="tr3 t_one">
            <td class="tac topicnotice2"></td>
            <th>论坛公告: <a href='notice.php?level=<?=$NT_A['level']?>#<?=$NT_A['id']?>'><?=$NT_A['title']?></a></th>
            <td colspan="2" class="tal y-style">论坛公告</td>
            <td class="y-style f10"><?=$NT_C['startdate']?></td>
          </tr>
					<?php
            }
          }
          $showtop=0;
          $shownormal=0;
          if(isset($topics)){
            foreach($topics as $topic){
            if($topic['top'] && $showtop==0){
              $showtop=1;	
          ?>
          <tr class="tr2">
            <td colspan="6" class="tac" style="border-top:0">置顶主题</td>
          </tr>
					<?php
            }
            if(!$topic['top'] && $shownormal==0){
              $shownormal=1;	
          ?>          
          <tr class="tr2">
            <td colspan="6" class="tac" style="border-top:0">普通主题</td>
          </tr>
				  <?php }?>
          <tr align="center" class="tr3 t_one">
            <td class="<?=$topic['status']?>" onclick="window.open('<?=$topic['url']?>')"></td>
            <td class="tal"><a href="<?=$topic['url']?>"><?=$topic['title']?></a> <?=$topic['titleadd']?></td>
            <td class="tal y-style f10"><a href="profile.php?action=show&uid=<?=$topic['authorid']?>"><?=$topic['author']?></a>
              <div class="gray"><?=$topic['postdate']?></div></td>
            <td class="tal y-style f10 gray"><span class="s3"><?=$topic['replies']?></span>/<?=$topic['hits']?></td>
            <td class="tal y-style f10 "><?=$topic['lastposter']?><br />
              <span class="gray"><a href="read.php?tid=<?=$topic['tid']?>"><?=$topic['lastpost']?></a></span></td>
          </tr>
					<?php
          }}
          ?>
          <tr>
            <td colspan="6" class="f_one" style="height:8px"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="t3"><span class="fr"><?php if($canpost) {?><a href='post.php?fid=<?=$fid?>' ><img src="images/blank.gif" id="td_post" /></a><?php }?></span><span class="fl">
      <div class="pages"><?=$pages?></div>
      </span>
      <div class="c"></div>
    </div>
    <div class="c"></div>
    <table cellPadding="0" cellSpacing="0" style="display:none">
      <tbody id="att_mode">
        <tr>
          <td width="240"><input class="input" type="file" name="attachment_" size="25" /></td>
          <td>描述
            <input class="input" type="text" name="atc_desc" size="18" /></td>
          <td style="height:25px;line-height:25px;"></td>
        </tr>
      </tbody>
    </table>
  <div style="margin:0 auto 8px;" class="pd8">
    <center>
      <img src="images/blank.gif" class="topicnew">&nbsp;新主题
      <img src="images/blank.gif" class="topic">&nbsp;开放主题
      <img src="images/blank.gif" class="topichot">&nbsp;热门主题
      <img src="images/blank.gif" class="topiclock">&nbsp;锁定主题      
    </center>
  </div>
</div>
</div>