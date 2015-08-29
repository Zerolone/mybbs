<div class="bg">
<div class="cnyouws" style="padding:1px 0">
  <div class="main-wrap">
    <div id="main">
      <div id="breadCrumb">
        <?=BBS_NAV . $msg_guide?>
      </div>
      <div class="c"></div>
      <!--ads begin-->
      <div class="t3 cc">
        <?php if($canpost) {?>
        <span class="fr" style="margin-left:.5em"><a href="post.php?fid=<?=$fid?>" id="td_post"></a></span>
        <?php }?>
        <?php if($canreply){?>
        <span class="fr"><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>" id="td_reply"></a></span>
        <?php }?>
        <div style="padding-top:8px;"><span class="fl">
          <div class="pages">
            <?=$pages?>
          </div>
          <br />
        </div>
        <div class="t" style="margin-bottom:10px;">
          <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td class="tal h" style="border-bottom:0;">主题 :
                <?=$title?></td>
            </tr>
          </table>
        </div>
        <?php
		$key=0;
		foreach($readdb as $read) {
			if($read){
			$table_id=$td_id=$a_id='';
	?>
        <div class="tnr" style='border:0;'>
          <table cellspacing="0" cellpadding="0" width="100%" style="table-layout:fixed;">
            <tr>
              <td style="width:198px;vertical-align:top;" rowspan="2"><div class="zla">
                <div class="zlb">
                  <div class="zlk">
                    <div class="cc" style="padding-bottom:3px;">
                      <div class="listread fl"> <a class="readonline" href="javascript:;" onClick="sendmsg('pw_ajax.php?action=addfriend&touid=43748','','sf_0')" style="cursor:pointer;" title="加为好友"/></a> </div>
                      <b class="fl blacks"><font color="#5E3500">
                      <?=$read['author']?>
                      </font></b></div>
                    <div class="xze"><img src="image/face/<?=$read['micon']?>" /><br />
                      <img src='<?=$read['lpic']?>'> <br />
                    </div>
                    <span class="user-info2" id="showface_0"> <span class="user-infoWrap2 f10"> 级别: <font color="#FE8F42"><b><font color=#DB2CE6>
                    <?=$read['level']?>
                    </font></b></font> <br>
                    发帖: <span class="s1 f12">
                    <?=$read['postnum']?>
                    贴</span> <br />
                    <?=CREDIT_RVRC?>
                    :<font color="#984b98"><b>
                    <?=$read['aurvrc'] . CREDIT_RVRC_EXT?>
                    </b></font><br />
                    <?=CREDIT_MONEY?>
                    :<font color="#984b98"><b>
                    <?=$read['money'] . CREDIT_MONEY_EXT?>
                    </b></font><br />
                    <div class="c"></div>
                    诞生: <span class="gray">
                    <?=$read['regdate']?>
                    </span><br />
                    登录: <span class="gray">
                    <?=$read['lastlogin']?>
                    </span>
                    <div class="c"></div>
                  </div>
                </div></td>
              <td height="100%" valign="top" id="td_tpc" style="padding:0;border:0;overflow:hidden;background:url(images/cnyouw2010/nrbg.png) repeat-y 100% 0;"><a name="post_tpc"></a>
                <div>
                  <div style="overflow:hidden; position:absolute;margin-left:440px;margin-top:-10px;" id="read_overprint"> </div>
                  <div class="tiptop cc f10"><span class="fl gray" style="white-space:nowrap;color:#B19874">发表于:
                    <?=$read['postdate']?>
                    </span> <span title="" class="fl gray" style="color:#B19874">&nbsp;&nbsp; </span></div>
                </div>
                <div class="c"></div>
                <h1 id="subject_tpc" style="border-left:5px solid #FF3366; padding-left:5px">
                  <?=$read['icon']?>
                  <?=$read['title']?>
                </h1>
                <div class="tpc_content f10"><?=$read['content']?></div></td>
            </tr>
            <tr>
              <td><div>
                  <div class="signature">
                    <table width="100%">
                      <tr>
                        <td align="right" class="f10"><?php if($read['ifsign']){?>
                          <br>
                          <?=$read['signature']?>
                          <br>
                          <?php } ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="tipad cc" style=" padding:0 3px 15px">
                    <div class="fl readbot f10">
                      <?php if($canreply){?>
                      <a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>">回复</a>
                      <?php }?>
                      <a href="profile.php?action=show&uid=<?=$read['uid']?>">资料</a> <a href="message.php?action=write&touid=<?=$read['authorid']?>" target="_blank">短信</a> <a href="post.php?action=modify&fid=<?=$fid?>&tid=<?=$tid?>&id=<?=$read['id']?>&article=<?=$read['lou']?>">编辑</a> <a href="http://wpa.qq.com/msgrd?V=1&Uin=<?=$read['oicq']?>&Site=<?=BBS_NAME?>&Menu=yes" title="QQ:<?=$read['oicq']?>" target=_blank>QQ</a> </div>
                    <div class="fr f10"><a href="javascript:scroll(0,0)" title="顶端">顶端</a> </div>
                  </div>
                </div></td>
            </tr>
          </table>
        </div>
        <?php }}?>
        <div class="t3">
          <?php if($canpost) {?>
          <span class="fr" style="margin-left:.5em"><a href="post.php?fid=<?=$fid?>" title="发表新帖" id="td_post"></a></span>
          <?php }?>
          <?php if($canreply){?>
          <span class="fr"><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>" title="回帖" id="td_reply"></a></span>
          <?php }?>
          <div class="pages">
            <?=$pages?>
          </div>
        </div>
        <div class="c"></div>
        <div class="c"></div>
        <div id="checkurl" class="menu menu-post" style="display:none;">
          <div class="menu-b tac">
            <table width="280" cellspacing="0" cellpadding="0">
              <tr>
                <th class="h" colspan="2"><span id="suburl">http://cnyouw.com</span></th>
              </tr>
              <tr>
                <td colspan="2">访问内容超出本站范围，不能确定是否安全</td>
              </tr>
              <tr>
                <td><a href="" target="_blank" onClick="closep();" id="trueurl">继续访问</a></td>
                <td><a href="javascript:;" onClick="closep();">取消访问</a></td>
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
        <div class="t">
          <form name="FORM" method="post" action="post.php?" enctype="multipart/form-data"  onSubmit="return checkCnt();">
            <table width="100%">
              <tr>
                <td class="h" colspan="2"><b>快速回复</b></td>
              </tr>
              <tr class="vt">
                <td style="background:#fff;"><div class="fp_content f10">
                    <div class="cc" style="margin-bottom:5px;">
                      <div class="pr fl"><span style="padding:7px">
                        <input type="text" name="atc_title" size="65" />
                        </span>
                        <div class="w_input_text" id="atc_title_warn" style="display:none;">限 150 字节</div>
                        (可选)</div>
                    </div>
                    <div class="fp_editor_but cc">
                      <input type=checkbox name="atc_usesign" value="1" checked>
                      使用签名[<a  href="javascript:checklength(document.FORM,'50000');">查看帖子长度</a>]
                      <div> </div>
                      <div style="padding:0.5% 0 0 0.5%;width:99.5%;display:inline;float:left;">
                        <textarea onKeyDown="quickpost(event)" name='atc_content' cols='100' rows='8'></textarea>
                        <br />
                        <input type='hidden' value='2' name='step'>
                        <input type='hidden' value='reply' name='action'>
                        <input type='hidden' value='<?=$fid?>' name='fid'>
                        <input type='hidden' value='<?=$tid?>' name='tid'>
                        <input type='hidden' value='<?=$page?>' name='page'>
                        <input type='hidden' value='<?=$title?>' name='topic_title'>
                        <INPUT name="muti" type="checkbox" value="1" onclick="showmuti()">
                        添加附件 <span id=attach2 style='DISPLAY: none'> <br>
                        <br>
                        描述：
                        <input type='text' name='atc_desc1' size='25'>
                        &nbsp;附件：
                        <input type="file" class="subject" name="atc_attachment1">
                        <br>
                        描述：
                        <input type='text' name='atc_desc2' size='25'>
                        &nbsp;附件：
                        <input type="file" class="subject" name="atc_attachment2">
                        <br>
                        描述：
                        <input type='text' name='atc_desc3' size='25'>
                        &nbsp;附件：
                        <input type="file" class="subject" name="atc_attachment3">
                        <br>
                        描述：
                        <input type='text' name='atc_desc4' size='25'>
                        &nbsp;附件：
                        <input type="file" class="subject" name="atc_attachment4">
                        </span> </div>
                    </div>
                    <div class="mt10">
                      <input class="btn fl b" style="padding:3px 1.8em;*padding:0;height:25px; width:200px; margin-top:3px;" type="submit" name="Submit" value=" 发表评论，提交 " />
                      <span class="s3">按"Ctrl+Enter"直接提交</span></div>
                  </div></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script language="javascript">
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
