<div class="main-wrap">
  <div id="main">
    <style type="text/css">
.t table tr.tr2 td.f{width:22%;}
.t table tr.tr2 td.e{width:10em;}
</style>
    <div class="forum-info cc gray">
      <div class="fr">主题:
        <?=$topics?>
        | 帖子:
        <?=$posts?>
        | 会员:
        <?=$totalmember?>
        | 新会员:<span class="black"><a href='profile.php?action=show&username=<?=$rawnewuser?>' target=_blank><font color=#ff0000>
        <?=$newmember?>
        </a></span>&nbsp;</div>
    </div>
    <?php if($notices){?>
    <div class="noticebg">
      <div id="notice">
        <div id="notice0" style="width:98%;height:18px;line-height:18px;overflow-y:hidden;">
          <ul>
            <?php foreach($notices as $notice){?>
            <li><a href="notice.php?#<?=$notice['id']?>">
              <?=$notice['title']?>
              </a> <span class="f9 gray">
              <?=$notice['startdate']?>
              </span></li>
            <?php }?>
          </ul>
        </div>
      </div>
    </div>
    <?php }?>
    <style>
#topList_1{ height:auto;}
#topList_1 .t{ width:25%; float:left; border:0; padding:0; overflow:hidden ;margin-bottom:0;}
#topList_1 .t table {border:0;table-layout:fixed}
#topList_1 td.tguide{line-height:110%;border-right:1px solid #d5e6ed}
#topList_1 .lt .tguide{ border-right:0}
#topList_1 .lt{float:none; width:auto;}
.toplist{ margin:0; padding:.3em 0 .1em; list-style:none}
.toplist li{ padding:0 .6em; line-height:25px;height:25px;overflow:hidden; border-bottom:1px dashed #d5e6ed}
</style>
    <!--[if ie 6]>
<style>
#topList_1{padding:0; }
#topList_1 .lt{ float:none; width:auto;}
#topList_1 .lt{ _float:left;}
.contentc{clear:both;font:0/0 a;height:0}
</style>
<![endif]-->
    
    <div class="contentc"></div>
    <div id="content">
    <div class="contentwrap z">
    <div class="t" id="t_10">
    
    <table cellspacing="0" cellpadding="0" width="100%" style="table-layout:fixed;">
    <?php 
			$i=0;
			foreach($forums as $forum){
			if(strlen($forum['level'])==2){ 
			$i=0;
			?>
      <tr>
        <th class="h f10" colspan="3"><span class="fr" style="margin-right:20px">分栏版主:<?=$forum['forumadmin']?> </span> &raquo;
          <h2><?=$forum['title']?></h2>
        </th>
      </tr>
      <tr>
        <td colspan="3" style="padding:0;border-bottom:0;font:0/0 Arial"></td>
      </tr>
      <tbody id="cate_10" class="across">
        <tr class="tr1">
		      <?php } else{ 
					if($i==3){
						$i=0;
						echo '</tr><tr class="tr1">';
					}
					$i++;
					?>
	        <td class="td1 f_one">     
            <table width="100%">
              <tr>
                <td width="36" class="p10 forum<?=$forum['pic']?>" onclick="window.open('topic.php?fid=<?=$forum['fid']?>')"></td>
                <td style="padding:5px 13px;"><h3><a href="topic.php?fid=<?=$forum['fid']?>" class="fnamecolor b"><?=$forum['title']?></a></h3>
                  <br />
                  <span class="gray f10">主题:<?=$forum['topic']?>&nbsp;&nbsp;&nbsp;帖子:<?=$forum['post']?></span><br />
                  <span class="f10"><a href="<?=$forum['ft']?>"><?=$forum['t']?></a></span><br />
                  <span class="gray f10">by:<?=$forum['author']?> [<?=$forum['lastpost']?>]</span>
              </div>
                </td>
              </tr>
            </table>
          </td>
          <?php }?>
      <?php } ?>
      </tr>
      <tr>
        <td colspan="3" style="height:8px;" class="f_one"></td>
      </tr>
      </tbody>
      
    </table>
  </div>
</div>
</div>
<div class="c"></div>
</div>
</div>
