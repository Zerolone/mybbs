<div class="bg">
<div class="cnyouws">
  <div class="main-wrap">
    <div id="main">
      <div id="breadCrumb" class="cc"> <span class="fr"> 版主: &nbsp;<?=$foruminfo['forumadmin']?> </span> <b><?=BBS_NAV?> <?=$msg_guide?></b></div>
      <div class="c"></div>
      <div class="t">
        <table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><div class="pw_list_a f10">
              <ul>
                  <li onmouseover="return swap_tab(1)" id="tab_t1" class="current"><a href="javascript:;">版块公告</a></li>
                </ul>
              </div></td>
          </tr>
          <tr class="tr2 f10">
            <td> 版块简介: <?=$foruminfo['atitle']?></td>
          </tr>
          <tbody id="cate_thread" style="">
            <tr style="line-height:1.2;">
              <td><div id="tab_1" style="width:956px; overflow:hidden" class="f10"> <?=$foruminfo['acontent']?>
                  <div class="c"></div>
              </div></td>
            </tr>
          </tbody>
        </table>
      </div>
      <script language="JavaScript">
function swap_tab(n){
try{
for(var i=1;i<=2;i++){
var curC=document.getElementById("tab_"+i);
var curB=document.getElementById("tab_t"+i);
if(n==i){
curC.style.display="block";
curB.className="current"
}else{
curC.style.display="none";
curB.className="normal"
}
}}catch(e){}
}
</script>
      <div class="c" id="c"></div>
      <?php if($canpost) {?>
      <div class="t3 cc"> <span class="fr"><a href="post.php?fid=<?=$fid?>" title="发表新帖" id="td_post"></a></span>
      <?php }?>
        <div style="padding-top:8px;" class="cc">
          <div class="pages"><?=$pages?><br /><br /></div>
      </div>
      <div id="menu_post" class="menu menu-post cc f14 tac" style="display:none;">
        <div class="menu-b" style="width:100px;"> <a href="http://cnyouw.com/post.php?fid=54" title="新 帖" hidefocus="true">新 帖</a> </div>
      </div>
      <div class="t z" style="margin:auto">
        <table cellspacing="0" cellpadding="0" width="100%" id="ajaxtable">
          <tr>
            <th colspan="6"> <div class="pw_list_a pr pw_maxlist">
                <div id="menu_special" class="menu-post tac" style="display:none;">
                  <div class="menu-b f14">
                    <ul style="width:77px;*padding-left:5px;line-height:2">
                      <li><a href="">全 部</a></li>
                      <li><a href="http://cnyouw.com/thread.php?fid-54-special-1.html">投 票</a></li>
                      <li><a href="http://cnyouw.com/thread.php?fid-54-special-2.html">活 动</a></li>
                      <li><a href="http://cnyouw.com/thread.php?fid-54-special-3.html">悬 赏</a></li>
                      <li><a href="http://cnyouw.com/thread.php?fid-54-special-4.html">商 品</a></li>
                      <li><a href="http://cnyouw.com/thread.php?fid-54-special-5.html">辩 论</a></li>
                    </ul>
                  </div>
                </div>
              </div>
             </th>
          </tr>
          <tbody style="table-layout:fixed;">
            <tr class="tr2 f10">
              <td style="width:3%" class="tac y-style"></td>
              <td> 文章 </td>
              <td style="width:11%;" class="y-style">作者/时间</td>
              <td style="width:8%" class="tal y-style">回复/点击</td>
              <td style="width:12%;" class="y-style">最后发表↓</td>
            </tr>
						<?php
            //为第一页并且
            if($page==1 && $ifsort){
              //论坛公告
              if($NT_A){
            ?>            
            <tr align="middle" class="tr3 t_one f10">
              <td class="tac topictop">&nbsp;</td>
              <th><a href='notice.php?level=<?=$NT_A['level']?>#<?=$NT_A['id']?>' class="black"><?=$NT_A['title']?></a></th>
              <td colspan="2"  align="center" class="tal y-style">站点公告</td>
              <td class="y-style"><?=$NT_A['startdate']?></td>
            </tr>
						<?php
              }
              if($NT_C){
            ?>            
            <tr align="middle" class="tr3 t_one f10">
              <td class="tac topictop">&nbsp;</td>
              <th><a href='notice.php?level=<?=$NT_C['level']?>#<?=$NT_C['id']?>' class="black"><?=$NT_C['title']?></a></th>
              <td colspan="2" class="tal y-style">全局公告</td>
              <td class="y-style"><?=$NT_C['startdate']?></td>
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
            <td colspan="6" class="lbtac f11">置顶主题</td></tr>
						<?php
              }
              if(!$topic['top'] && $shownormal==0){
                $shownormal=1;	
            ?>
            <td colspan="6" class="lbtac f11">普通主题</td></tr>
            <?php }?>
            
              
            <tr align="center" class="tr3 f10">
              <td  class="<?=$topic['status']?>"></td>
              <td class="tal"><a href="<?=$topic['url']?>" class="subject"><?=$topic['title']?></a> <?=$topic['titleadd']?></td>
              <td class="tal y-style"><a href="profile.php?action=show&uid=<?=$topic['authorid']?>" class="bl"><?=$topic['author']?></a><span class="f10 graylb"><?=$topic['postdate']?></span></td>
              <td><b><?=$topic['replies']?></b><br /><?=$topic['hits']?></td>
              <td class="tal y-style"><a href="read.php?tid=<?=$topic['tid']?>"><?=$topic['lastposter']?></a><br />
                <span class="f10 gray"><?=$topic['lastpost']?></span></td>
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

      <div class="t3 f10"> <span class="fr"><a href="post.php?fid=<?=$fid?>" title="发表新帖" id="td_post"></a></span> <span class="fl">
        <div class="pages"><?=$pages?>&nbsp;&nbsp;<?=PAGE_PER?>/页&nbsp;<?=$count?>篇文章</div>
        <div class="c"></div>
      </div>
      <div class="t3">
      	<span class="topicnew"></span> 新主题
     		<span class="topic"></span> 开放主题
        <span class="topichot"></span> 热门主题
        <span class="topiclock"></span>  锁定主题
   		 </div>
    </div>
  </div>
</div>
<br>
