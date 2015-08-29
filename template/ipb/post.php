<br>
<script language="JavaScript" src="js/editor.js"></script>
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
function showmuti(){
if (document.FORM.muti.checked == true){
		attach2.style.display = '';
	}else{
		attach2.style.display = 'none';
	}
}
</script>
<table width='98%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV . $msg_guide?>
      </b></td>
  </tr>
</table>
<br>
<table cellspacing=0 cellpadding=0 width='98%' align=center>
  <tr>
    <td><form method="post" name="FORM" action="post.php?" enctype="multipart/form-data" onsubmit="return checkCnt();">
        <table cellPadding=3 cellSpacing=1 width='100%' bgcolor=#E7E3E7 align=center>
          <tr>
            <td class=head colspan=3>&nbsp;</td>
          </tr>
          <tr>
            <td width='20%' class='t_one'><b>标题</b></td>
            <td class='t_one'><input name="atc_title" size=60 value='<?=$atc_title?>' tabindex="1"></td>
          </tr>
          <tr>
            <td class='t_one'><b>Icon</b></td>
            <td class='t_one'>
            	<input name=atc_iconid type=radio value='1'><img src='images/blank.gif' id="e1">
              <input name=atc_iconid type=radio value='2'><img src='images/blank.gif' id="e2">
              <input name=atc_iconid type=radio value='3'><img src='images/blank.gif' id="e3">
              <input name=atc_iconid type=radio value='4'><img src='images/blank.gif' id="e4">
              <input name=atc_iconid type=radio value='5'><img src='images/blank.gif' id="e5">
              <input name=atc_iconid type=radio value='6'><img src='images/blank.gif' id="e6">
              <input name=atc_iconid type=radio value='7'><img src='images/blank.gif' id="e7"></td>
          </tr>
          <tr>
            <td valign=top  class='t_one'><b>内容</b></td>
            <td colspan=2 align=left class='t_one'><table cellPadding=0 cellSpacing=0 width="100%">
                <tr>
                  <td id='edit' width='59%'> 字体
                    <select onChange="showfont(this.options[this.selectedIndex].value);this.selectedIndex=0;this.selectedIndex=0" name=font>
                      <option value=''></option>
                      <option value='宋体'>宋体</option>
                      <option value='楷体_GB2312'>楷体_GB2312</option>
                      <option value='新宋体'>新宋体</option>
                      <option value='黑体'>黑体</option>
                      <option value='隶书'>隶书</option>
                      <option value='Courier New'>Courier New</option>
                      <option value='Impact'>Impact</option>
                      <option value='Tahoma'>Tahoma</option>
                      <option value='Times New Roman'>Times New Roman</option>
                    </select>
                    &nbsp;字号
                    <select onChange="showsize(this.options[this.selectedIndex].value);this.selectedIndex=0" name=size>
                      <option value=''></option>
                      <option value=1>1</option>
                      <option value=2>2</option>
                      <option value=3>3</option>
                      <option value=4>4</option>
                      <option value=5>5</option>
                      <option value=6>6</option>
                    </select>
                    &nbsp;字体颜色
                    <select onChange="showcolor(this.options[this.selectedIndex].value);this.selectedIndex=0" name=color>
                      <option value="" selected="selected">颜色</option>
                      <option style="background-color:#000000;color: #000000" value="#000000">#000000</option>
                      <option style="background-color:#FFFFFF;color: #FFFFFF" value="#FFFFFF">#FFFFFF</option>
                      <option style="background-color:#008000;color: #008000" value="#008000">#008000</option>
                      <option style="background-color:#800000;color: #800000" value="#800000">#800000</option>
                      <option style="background-color:#808000;color: #808000" value="#808000">#808000</option>
                      <option style="background-color:#000080;color: #000080" value="#000080">#000080</option>
                      <option style="background-color:#800080;color: #800080" value="#800080">#800080</option>
                      <option style="background-color:#808080;color: #808080" value="#808080">#808080</option>
                      <option style="background-color:#FFFF00;color: #FFFF00" value="#FFFF00">#FFFF00</option>
                      <option style="background-color:#00FF00;color: #00FF00" value="#00FF00">#00FF00</option>
                      <option style="background-color:#00FFFF;color: #00FFFF" value="#00FFFF">#00FFFF</option>
                      <option style="background-color:#FF00FF;color: #FF00FF" value="#FF00FF">#FF00FF</option>
                      <option style="background-color:#C0C0C0;color: #C0C0C0" value="#C0C0C0">#C0C0C0</option>
                      <option style="background-color:#FF0000;color: #FF0000" value="#FF0000">#FF0000</option>
                      <option style="background-color:#0000FF;color: #0000FF" value="#0000FF">#0000FF</option>
                      <option style="background-color:#008080;color: #008080" value="#008080">#008080</option>
                    </select>
                    <br>
                    <br>
                    <img onClick=bold() alt='粗体' src='images/blank.gif'           id="edb"> 
                    <img onClick=italicize() alt='斜体' src='images/blank.gif'      id="edi"> 
                    <img onClick=underline() alt='下划线' src='images/blank.gif'    id="edu"> 
                    <img onClick=center() alt='居中' src='images/blank.gif'         id="edc"> 
                    <img onClick=image() alt='插入图片' src='images/blank.gif'      id="edimg"> 
                    <img onClick=showurl() alt='插入url链接' src='images/blank.gif' id="edurl"> 
                    <img onClick=showcode() alt='插入代码' src='images/blank.gif'   id="edcode"> 
                    <img onClick=quoteme() alt='插入引用' src='images/blank.gif'    id="edq"> 
                </tr>
              </table>
              <br>
              <textarea name="atc_content" id="atc_content" cols="90" rows="25" style="overflow:auto;"  onkeydown="quickpost(event)" onfocus="getActiveText(this)" onclick="getActiveText(this)"  onchange="getActiveText(this)" tabindex="2"><?=$atc_content?>
</textarea>
              <br>
              推荐使用:
              [<a href=javascript:copytext('FORM.atc_content')>复制到剪贴板</a>] 
              [<a href=javascript:replac()>替换文本</a>]
              [<a href='javascript:checklength(document.FORM);'>查看帖子长度</a>] 最大:50000 字节<br>
              <input name='atc_usesign' type=checkbox id="atc_usesign" value='1'<? if ($ifcheck) echo 'checked' ?>><label for="atc_usesign">使用签名</label></td>
          </tr>
          <tr>
            <td align=left valign="top" class='t_one'>附件最大:<?=UPLOAD_MAX?>(K)</td>
            <td align=left valign="top" class='t_one'><b>有效文件类型:<?=UPLOAD_EXT?></b><br>
              <INPUT name="muti" type="checkbox" id="muti" onclick="showmuti()" value="1" />
              <label for="muti">多个附件</label>
              <br>
              <br>
              描述：<input type='text' name='atc_desc1' size='25'>
              附件：<input type="file" class="subject" name="atc_attachment1">
              <span id=attach2 style='DISPLAY: none'> <br>
              描述：<input type='text' name='atc_desc2' size='25'>
              附件：<input type="file" class="subject" name='atc_attachment2'>
              <br>
              描述：<input type='text' name='atc_desc3' size='25'>
              附件：<input type="file" class="subject" name='atc_attachment3'>
              <br>
              描述：<input type='text' name='atc_desc4' size='25'>
              附件：<input type="file" class="subject" name='atc_attachment4'>
              </span></td>
          </tr>
        </table>
        <br>
        <tr>
            <td align=center><input type=hidden value=2 name=step>
              <input type=hidden value='<?=$id?>' name=id>
              <input type=hidden value='<?=$action?>' name=action>
              <input type=hidden value='<?=$fid?>' name=fid>
              <input type=hidden value='<?=$tid?>' name=tid>
              <input type=hidden value='<?=$article?>' name=article>
              <input type=hidden value='' name=sale>
              <input type="submit" value="提 交" name="Submit" tabindex="3"></td>
          </tr>
      </form>
</table>