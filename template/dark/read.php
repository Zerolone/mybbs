<br>
<table width='95%' cellspacing=0 cellpadding=0 align=center>
  <tr>
  	<td><?=BBS_NAV . $msg_guide?></td>
  </tr>
</table>
<br>
<table width='95%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=$pages?></td>
    <td align=right>
			<?php if($canpost) {?><a href='post.php?fid=<?=$fid?>'><img src="images/blank.gif" id="td_post" /></a><?php }?>
    	<?php if($canreply){?><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>"><img src="images/blank.gif" id="td_reply" /></a><?php }?>
    </td>
  </tr>
</table>
<table cellspacing=0 cellpadding=1 width='95%' style="border-top: #1F1F1F 1px solid;border-left: #1F1F1F 1px solid;border-right: #1F1F1F 1px solid;" align=center>
  <tr>
    <td align=left class=head> --> <b>本页主题:</b> <?=$title?></td>
  </tr>
  <tr>
    <td align=right class=cbg height=23></td>
  </tr>
</table>
  <?php
		$key=0;
		foreach($readdb as $read) {
			if($read){
			$table_id=$td_id=$a_id='';
	?>
  <table cellspacing=1 cellpadding=0 width='95%' style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word;' bgcolor=#1F1F1F align=center>
    <tr>
      <td height="100%" valign=top width='20%' bgcolor='#353735' style='padding: 5px;'><font face=Gulim><b><?=$read['author']?></b></font><br>
        <table width=98% cellspacing=0 cellpadding=0>
          <tr>
            <td align=center><img src="<?=TP?>/images/face/<?=$read['micon']?>" /></td>
          </tr>
          <tr>
            <td align=center><img src='<?=$read['lpic']?>'></td>
          </tr>          
        </table>
        <br />
        级别: <font color="yellow"><?=$read['level']?></font><br>
        发帖: <font color="green"><b><?=$read['postnum']?></b></font><br>
        <?=CREDIT_RVRC?>	: <font color="#984b98"><b><?=$read['aurvrc'] . CREDIT_RVRC_EXT?></b></font><br>
        <?=CREDIT_MONEY?>: <font color="#984b98"><b><?=$read['money'] . CREDIT_MONEY_EXT?></b></font><br>
        注册时间:<?=$read['regdate']?><br>
        最后登录:<?=$read['lastlogin']?> </td>
      <td width='80%' height="100%" bgcolor='#353735' valign=top><table width='99%' height="100%" align=center cellspacing=0 cellpadding=4 style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word' >
          <tr>
            <td bgcolor='#353735' colspan=6 valign=top >
            	<a href="profile.php?action=show&uid=<?=$read['uid']?>"><img src="images/blank.gif" id="td_profile" /></a>
              <a href="message.php?action=write&touid=<?=$read['authorid']?>" target="_blank"><img src="images/blank.gif" id="td_message" /></a>
              <a href="post.php?action=modify&fid=<?=$fid?>&tid=<?=$tid?>&id=<?=$read['id']?>&article=<?=$read['lou']?>"><img src="images/blank.gif" id="td_edit" /></a>
              <a href="http://wpa.qq.com/msgrd?V=1&Uin=<?=$read['oicq']?>&Site=<?=BBS_NAME?>&Menu=yes" title="QQ:<?=$read['oicq']?>" target=_blank><img src="images/blank.gif" id="td_qq" /></a> <br>
              <br>
							<?=$read['icon']?>
              <span class="tpc_title"><?=$read['title']?></span><br>
              <br>
            <span class='tpc_content' ><?=$read['content']?></span><br></td>
          </tr>
          <tr valign=bottom bgcolor='#353735'>
            <td colspan=6></td>
          </tr>
                    
          <tr valign=bottom>
            <td colspan=6>
            <?php if($read['ifsign']){?>
            <img src='images/blank.gif' align=absbottom id="td_sign">
            <br><?=$read['signature']?><br>
            <?php } ?>
            </td>
          </tr>          
          <tr bgcolor='#353735' valign=bottom>
            <td class="smalltxt" colspan=5>
            <font color=red>[
						<?php if($read['lou']==0){?>
            楼 主
            <?php }else{?>
            <?=$read['lou']?> 楼
            <?php }?>
            ]</font>  <b>发布时间:</b> <?=$read['postdate']?></td>
            <td align=right class="smalltxt"><a href="javascript:scroll(0,0)"><img src="images/blank.gif" id="td_top" /></a></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <table width='98%' align=center>
    <tr>
      <td height=1></td>
    </tr>
  </table>
  <?php
			}
		}
	?>
<table width='95%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=$pages?></td>
      <td valign=center align=right>&nbsp;</td>
  </tr>
  <tr>
    <td align=left><br><?=BBS_NAV . $msg_guide?></td>
    <td align=right><br>
			<?php if($canpost) {?><a href='post.php?fid=<?=$fid?>'><img src="images/blank.gif" id="td_post" /></a><?php }?>
    	<?php if($canreply){?><a href="post.php?action=reply&fid=<?=$fid?>&tid=<?=$tid?>"><img src="images/blank.gif" id="td_reply" /></a><?php }?>
    </td>
  </tr>
</table>
<br>
<?php if($canreply){?>
<form name="FORM" method="post" action="post.php?" enctype="multipart/form-data"  onSubmit="return checkCnt();">
  <table cellspacing=1 cellpadding=0 width='95%' bgcolor=#1F1F1F align=center>  
    <tr>
      <td colspan=2><table cellspacing=0 cellpadding=0 width="100%">
          <td class=head><b>快速发帖</b></td>
            <td class=head align=right><a href="javascript:scroll(0,0)"><b>顶端</b></a></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td valign=top width=20% bgcolor=#353735 style="padding:7px"><b>内容</b></td>
      <td width=80% bgcolor=#353735 style="padding:7px"> 标题:
          <input type="text" name="atc_title" size="65">
      (可选)<br>
        <input type=checkbox name="atc_usesign" value="1" checked>使用签名[<a  href="javascript:checklength(document.FORM,'50000');">查看帖子长度</a>]        
        <br>
        <textarea onKeyDown="quickpost(event)" name='atc_content' cols='100' rows='8'></textarea>
        <input type='hidden' value='2' name='step'>
        <input type='hidden' value='reply' name='action'>
        <input type='hidden' value='<?=$fid?>' name='fid'>
				<input type='hidden' value='<?=$tid?>' name='tid'>
				<input type='hidden' value='<?=$page?>' name='page'>
				<input type='hidden' value='<?=$title?>' name='topic_title'>
        <br>
<INPUT name="muti" type="checkbox" value="1" onclick="showmuti()">添加附件
        <span id=attach2 style='DISPLAY: none'> <br>
              <br>描述：<input type='text' name='atc_desc1' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment1">
              <br>描述：<input type='text' name='atc_desc2' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment2">
              <br>描述：<input type='text' name='atc_desc3' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment3">
              <br>描述：<input type='text' name='atc_desc4' size='25'>&nbsp;附件：<input type="file" class="subject" name="atc_attachment4">
        </span>        
        <br>
        <font color=red> 按 Ctrl+Enter 直接提交&nbsp;&nbsp;&nbsp;</font>
        <input type='submit' name='Submit' value='提 交'>
        <br>
      <br></td>
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
<?php }?>