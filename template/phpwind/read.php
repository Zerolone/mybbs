<div class="main-wrap">
  <div id="main">
    <div id="breadCrumb"><?=BBS_NAV . $msg_guide?></div>
    <div class="c"></div>
    <!--ads begin-->
    <div class="t3 cc"> <span class="fr" style="margin-left:.5em">
    	<?php if($canreply){?><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>"><img src="images/blank.gif" id="td_reply" /></a><?php }?>    
			<?php if($canpost) {?><a href='post.php?fid=<?=$fid?>'><img src="images/blank.gif" id="td_post" /></a><?php }?>
    </span></div>
    <div id="menu_post" class="menu menu-post cc f14 tac" style="display:none;">
      <div class="menu-b" style="width:100px;"> <a href="post.php?fid=94" hidefocus="true">新  帖</a> </div>
    </div>
    <div class="t" style="margin-bottom:0;border-bottom:0;">
      <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td class="tal h f10" style="border-bottom:0;"> 主题 : <?=$title?></td>
        </tr>
      </table>
    </div>
  <?php
		$key=0;
		foreach($readdb as $read) {
			if($read){
			$table_id=$td_id=$a_id='';
	?>    
      <div class="t5" style='border:1px solid #a6cbe7;'>
        <table cellspacing="0" cellpadding="0" width="100%" style="table-layout:fixed;">
          <tr>
            <td style="width:185px;vertical-align:top;" rowspan="2" class="r_two"><div style="padding:8px 0 20px 8px;">
                <div class="cc" style="padding-bottom:3px;"><b class="fl black"><?=$read['author']?></b></div>
                <div class="user-pic">
                  <table style="border:0;">
                    <tr>
                      <td width="1"><img src="<?=TP?>/images/face/<?=$read['micon']?>" /></td>
                      <td width="1" style="vertical-align:top"><span id="sf_tpc"></span></td>
                    </tr>
                  </table>
                </div>
                <div style="padding:5px 0 2px;" class="f10">级别: <font color="#555555">
                  <?=$read['level']?>
                </font><br />
                <img src='<?=$read['lpic']?>' /></div>
                <span class="user-info2" id="showface_0"> <span class="user-infoWrap2 f10">
                <div class="c"></div>
                发帖:<font color="green"><b>
                <?=$read['postnum']?>
                </b></font><br />
                <?=CREDIT_RVRC?>:<font color="#984b98"><b>
                <?=$read['aurvrc'] . CREDIT_RVRC_EXT?>
                </b></font><br />
                <?=CREDIT_MONEY?>:<font color="#984b98"><b>
                <?=$read['money'] . CREDIT_MONEY_EXT?>
                </b></font><br />
                注册时间:<?=$read['regdate']?><br />
                最后登录:<?=$read['lastlogin']?></span> </span> </div></td>
            <td height="100%" class="r_one" valign="top" id="td_tpc" style="padding:0px;border:0;overflow:hidden"><a name="post_tpc"></a>
              <div class="tiptop cc f10 ">
              	<span class="fl s3 b">
								<?php if($read['lou']==0){?>
                楼 主
                <?php }else{?>
                <?=$read['lou']?> 楼
                <?php }?>                
                &nbsp; </span> <span class="fl gray" title="2010-05-09 09:43" style="white-space:nowrap;">发表于: <?=$read['postdate']?></span>
              </div>
              <div class="c"></div>
              <h1 id="subject_tpc"><?=$read['icon']?><?=$read['title']?></h1>
              <div class="c"></div>
              <div class="tpc_content">
                <div id="p_tpc" class="c"></div>
                <div class="f14" id="read_tpc"><?=$read['content']?><br />
                  <br />
                </div>
              </div></td>
          </tr>
          <tr class="r_one">
            <td style="vertical-align:bottom;border:0;padding:0;"><div id="w_tpc" class="c"></div>
            <?php if($read['ifsign']){?>
            <div class="sigline"></div>
            <div class="signature" style="max-height:120px;maxHeight:120px; overflow:hidden;">
            <table width="100%">
              <tr>
	              <td><?=$read['signature']?></td>
              </tr>
            </table>
            </div>
            <?php }?>
              <div class="tipad cc">
                <div class="fl readbot f10"> 
                <?php if($canreply){?><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>">回复</a><?php }?>
                <a href="profile.php?action=show&uid=<?=$read['uid']?>">资料</a>
                <a href="message.php?action=write&touid=<?=$read['authorid']?>" target="_blank">短信</a>
                <a href="post.php?action=modify&fid=<?=$fid?>&tid=<?=$tid?>&id=<?=$read['id']?>&article=<?=$read['lou']?>">编辑</a>
                <a href="http://wpa.qq.com/msgrd?V=1&Uin=<?=$read['oicq']?>&Site=<?=BBS_NAME?>&Menu=yes" title="QQ:<?=$read['oicq']?>" target=_blank>QQ</a>                </div>
                <div class="fr gray f10"><a href="javascript:scroll(0,0)" title="顶端">顶端</a> </div>
              </div></td>
          </tr>
        </table>
      </div>
  <?php
			}
		}
	?>      

    <div class="t3"> <span class="fr" style="margin-left:.5em">
    	<?php if($canreply){?><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>"><img src="images/blank.gif" id="td_reply" /></a><?php }?>    
			<?php if($canpost) {?><a href='post.php?fid=<?=$fid?>'><img src="images/blank.gif" id="td_post" /></a><?php }?>    
    </span>
      <div class="c"></div>
    </div>
    <div class="c"></div>
    <div class="t3">&nbsp;</div>
    <div class="c"></div>
    <div id="checkurl" class="menu menu-post" style="display:none;">
      <div class="menu-b tac">
        <table width="280" cellspacing="0" cellpadding="0">
          <tr>
            <th class="h" colspan="2"><span id="suburl">http://www.phpwind.net</span></th>
          </tr>
          <tr>
            <td colspan="2">访问内容超出本站范围，不能确定是否安全</td>
          </tr>
          <tr>
            <td><a href="" target="_blank" onclick="closep();" id="trueurl">继续访问</a></td>
            <td><a href="javascript:;" onclick="closep();">取消访问</a></td>
          </tr>
        </table>
      </div>
    </div>
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
    <?php if($canreply){?>
    <div class="t">
      <form name="FORM" method="post" action="post.php?" enctype="multipart/form-data"  onSubmit="return checkCnt();">
        <input type='hidden' value='2' name='step'>
        <input type='hidden' value='reply' name='action'>
        <input type='hidden' value='<?=$fid?>' name='fid'>
				<input type='hidden' value='<?=$tid?>' name='tid'>
				<input type='hidden' value='<?=$page?>' name='page'>
				<input type='hidden' value='<?=$title?>' name='topic_title'>      
        <table width="100%">
          <tr>
            <td class="h" colspan="3"><b>快速回复</b></td>
          </tr>
          <tr class="vt">
            <td class="f_two" style="width:185px;">&nbsp;</td>
            <td style="background:#fff;"><div class="fp_content  f10">
                <div class="cc" style="margin-bottom:5px;">
                  <div class="pr fl">
                    <input type="text" class="input" id="atc_title" name="atc_title" size="55" />
                  </div>
                </div>
                <div class="fp_editor cc" id="fp_editor">
                  <div>
                    <textarea id="textarea" name="atc_content" style="width:100%;height:140px;"></textarea>
                    <input type=checkbox name="atc_usesign" value="1" checked>使用签名[<a  href="javascript:checklength(document.FORM,'50000');">查看帖子长度</a>]        
        <br>
                  </div>
                </div>
                <INPUT name="muti" type="checkbox" value="1" onclick="showmuti()">添加附件
                        <span id=attach2 style='DISPLAY: none'> <br>
                              <br>描述：<input type='text' name='atc_desc1' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment1">
                              <br>描述：<input type='text' name='atc_desc2' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment2">
                              <br>描述：<input type='text' name='atc_desc3' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment3">
                              <br>描述：<input type='text' name='atc_desc4' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment4">
                        </span>   
                <div> </div>
                <div class="mt10">
                  <input class="btn fpbtn" type="submit" name="Submit" value=" 提 交 " />
                  <span class="s3">按"Ctrl+Enter"直接提交</span></div>
              </div></td>
            <td style="width:250px;"><div id="fp_face" class="fp_show">
                <div class="fp_show_tab"> <b id="doleft" style="display:none" class="tab_left fl" onclick="PwFace.showTab(-1)" title="上一个">上一个</b> <b id="doright" style="display:none" class="tab_right fr" onclick="PwFace.showTab(1)" title="下一个">下一个</b>
                  <ul id="face_tab">
                  </ul>
                </div>
                <div class="fp_show_cont">
                  <div class="fp_show_height">
                    <ul class="cc" id="face_main">
                    </ul>
                  </div>
                  <div id="face_page" class="fp_show_pages cc"></div>
                </div>
              </div></td>
          </tr>
        </table>
      </form>
      <script language="JavaScript">
      cnt = 0;
      function checkCnt(){
        document.FORM.Submit.disabled=true;
        cnt++;
        if (cnt!=1){
          alert('提交中，请稍后！');
          return false;
        }
      }
      function quickpost(event){
        if((event.ctrlKey && event.keyCode == 13)||(event.altKey && event.keyCode == 83))	{
          cnt++;
          if (cnt==1){
            this.document.FORM.submit();
          }else{
            alert('提交中，请稍后！');
          }
        }	
      }
      function checklength(theform,postmaxchars) {
        if (postmaxchars != 0) {
          message = '\n最大的字符为'+postmaxchars+' 字节';
        }else {
          message = ''; 
        }
        alert('您的信息已经有 '+theform.atc_content.value.length+' 字节'+message);
      }
      function showmuti(){
      if (document.FORM.muti.checked == true){
          attach2.style.display = '';
        }else{
          attach2.style.display = 'none';
        }
      }
      </script>
    </div>
    <?php } ?>   
  </div>
</div>
</div>
