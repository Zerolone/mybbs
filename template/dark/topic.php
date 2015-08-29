<br>
<table width='95%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td id="nav"><b><?=BBS_NAV?> <?=$msg_guide?></b></td>
  </tr>
</table>
<?php if($foruminfo['aid']){	?>
<br>
<table cellspacing=1 cellpadding=6 width='95%' align=center bgcolor=#1F1F1F>
  <tr>
    <td class="head"><b>版块公告</b></td>
  </tr>
  <tbody id="cate_thread" style="">
    <tr>
      <td class=t_one onMouseOver="this.className='t_two'" onMouseOut="this.className='t_one'"> <?=$foruminfo['atitle']?>&nbsp;<span class="smalltxt">(<?=$foruminfo['startdate']?>)</span><br>
        <br>
        <b><?=$foruminfo['acontent']?></b>
        <div align="right"><a href="notice.php?fid=39#38">更多公告..</a></div></td>
    </tr>
</table>
<?php } ?>
<br>
<table width='95%' align=center cellspacing=0 cellpadding=0>
  <tr>
    <td align=left valign=middle width=60%><?=$pages?></td>
    <td align=right><?php if($canpost) {?><a href='post.php?fid=<?=$fid?>' ><img src="images/blank.gif" id="td_post" /></a><?php }?><br /><br /></td>
  </tr>
</table>
<table cellspacing=1 cellpadding=4 width='95%' align=center bgcolor=#1F1F1F>
  <tr align=center class=head>
    <td width=5% >状态</td>
    <td width=68% align=center>文章</td>
    <td width=10%>作者</td>
    <td  width=7%>回复</td>
    <td width=10%>最后发表</td>
  </tr>
  <tr class=cbg>
    <td colspan=3>&nbsp;</td>
    <td colspan=2 align='right' valign='middle'>版主：<?=$foruminfo['forumadmin']?>&nbsp;</td>
  </tr>
  <?php
	//为第一页并且
  if($page==1 && $ifsort){
		//论坛公告
		if($NT_A){
	?>
  <tr align=middle class=t_two>
    <td class="t_two topicnotice1"></td>
    <td align=left class="t_one" onMouseOver="this.className='t_two'" onMouseOut="this.className='t_one'">&nbsp;<b>分类公告:</b> <a href='notice.php?level=<?=$NT_A['level']?>#<?=$NT_A['id']?>'><?=$NT_A['title']?></a></td>
    <td colspan="2" class="t_one"><b>分类公告</b></td>
    <td align=center class='smalltxt'><?=$NT_A['startdate']?></td>
  </TR>
  <?php
		}
		if($NT_C){
  ?>
  <tr align=middle class=t_two>
    <td class="topicnotice2"></td>
    <td align=left class=t_one onMouseOver="this.className='t_two'" onMouseOut="this.className='t_one'">&nbsp;<b>全局公告:</b> <a href='notice.php?level=<?=$NT_C['level']?>#<?=$NT_C['id']?>'><?=$NT_C['title']?></a></td>
    <td colspan="2" class="t_one"><b>论坛公告</b></td>
    <td align=center class='smalltxt'><?=$NT_C['startdate']?></td>
  </TR>
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
  <tr class=cbg><td colspan=5>&nbsp; <b>置顶主题</b></td></tr>
  <?php
		}
		if(!$topic['top'] && $shownormal==0){
			$shownormal=1;	
	?>
  <tr class=cbg><td colspan=5>&nbsp; <b>普通主题</b></td></tr>
  <?php }?>
  <tr align=center class=t_two>
    <td class="t_wo <?=$topic['status']?>" onclick="window.open('<?=$topic['url']?>')"></td>
    <td class=t_one onMouseOver="this.className='t_two'" onMouseOut="this.className='t_one'" align=left>
      <a href="<?=$topic['url']?>"><?=$topic['title']?></a> <?=$topic['titleadd']?>
    </td>
    <td class=smalltxt><a href="profile.php?action=show&uid=<?=$topic['authorid']?>"><?=$topic['author']?></a><br><?=$topic['postdate']?></td>
    <td class=t_one><b><?=$topic['replies']?></b></td>
    <td class=smalltxt><a href="read.php?tid=<?=$topic['tid']?>"><?=$topic['lastpost']?></a><br>by:<?=$topic['lastposter']?></td>
  </tr>
  <?php
	}}
	?>
</table>
<br>
<table cellspacing=0 cellpadding=0 width='95%' align=center>
  <tr>
    <td align=left><?=$pages?>&nbsp;&nbsp;<?=PAGE_PER?>/页&nbsp;<?=$count?>篇文章</td>
    <td align=right><?php if($canpost) {?><a href='post.php?fid=<?=$fid?>'><img src="images/blank.gif" id="td_post" /></a><?php }?></td>
  </tr>
  <tr>
      <td align='left'><br></td>
    <td align=right><br></td>
  </tr>
</table>
<br>
<center>
	<img src="images/blank.gif" class="topicnew">&nbsp;新主题
  <img src="images/blank.gif" class="topic">&nbsp;开放主题
  <img src="images/blank.gif" class="topichot">&nbsp;热门主题
  <img src="images/blank.gif" class="topiclock">&nbsp;锁定主题
</center>