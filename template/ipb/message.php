<br />
<table width='100%' cellspacing=0 cellpadding=0 align=center>
	<tr>
		<td align=left><?=BBS_NAV?> -&gt; 短消息</b>
		</td>
	</tr>
</table><br>

<table width='100%' cellspacing=1 cellpadding=3 align=center class=i_table>	<tr class=head><td class=head  colspan=6>&nbsp;【信箱状态：目前有短消息<b> <?=$msgcount?> </b>条】</td></tr>
	<tr align=center>
		<td class='f_one'><a href='<?=$secondurl?>?action=receivebox'>收件箱</a></td>
		<td class='f_one'><a href='<?=$secondurl?>?action=sendbox'>发件箱</a></td>
		<td class='f_one'><a href='<?=$secondurl?>?action=write'>写新消息</a> </td>
	</tr>
</table>
<br>
<?php if($action=='read'||$action=='readsnd'||$action=="readscout"){?>
<table width='50%' cellspacing=1 cellpadding=3 align=center class=i_table>
	<tr class=head><td class=head colspan=2>查看信息</td></tr>
	<tr class='f_one'>
		<td width='12%'><font color=5A6633>作者:</font></td>
		<td><?=$msginfo['username']?></td>
	</tr>
	<tr class='f_one'>
	<td width='12%'><font color=5A6633>标题:</font></td>
		<td>
			<table cellspacing=1 cellpadding=3 style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
				<tr class='f_one'><td><?=$msginfo['title']?></td></tr>
			</table>
		</td>
	</tr>
	<tr class='f_one'>
		<td width='12%'><font color=5A6633>时间:</font></td>
		<td><?=$msginfo['mdate']?></td>
	</tr>
	<tr class='f_one'>
		<td width='12%'><font color=5A6633>内容:</font></td>
		<td>
			<table cellspacing=0 cellpadding=0 width='100%' height='55%' style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
				<tr><td valign=top align=left><?=$msginfo['content']?></td></tr>
			</table>
		</td>
	</tr>
	<tr class='f_one'>
		<td colspan=2>
			<font color=5A6633>
			选项:
			<?php if($action=="read"){?>
			[<a href='<?=$secondurl?>?action=write&remid=<?=$msginfo['mid']?>'>回复</a>] 
			<?php }?>
			[<a href='<?=$secondurl?>?action=del&delids=<?=$msginfo['mid']?>'>删除</a>]
			[<a href='message.php?action=<?=$preaction?>'>返回</a>]</font>
		</td>
	</tr>
</table>
<?php }elseif($action=='receivebox'||$action=='sendbox'||$action=='scout'){?>
<form name='del' action='<?=$secondurl?>' method=POST>
<table width='100%' cellspacing=1 cellpadding=3 align=center class=i_table>	<tr align=center>
		<td width=6%  class=head>ID</a></td>
		<td width=40% class=head>标题</td>
		<td width=10% class=head>发件人</td>
		<td width=10%  class=head>收件人</td>
		<td width=20%  class=head>时间</td>
		<td width=7%  class=head>已读</td>
		<td width=7%  class=head>选定</a></td>
	</tr>
	<?php
	$i=0;
	if(isset($msgdb)){
		foreach($msgdb as $message){
		$i++;
  ?>
	<tr align=center class="f_one">
		<td><?=$i?></td>
		<td align=center><a href="<?=$secondurl?>?action=<?=$readtype?>&mid=<?=$message['mid']?>"><?=$message['title']?></a></td>
		<td align=center><a href="profile.php?action=show&uid=<?=$message['fromuid']?>"><?=$message['from']?></a></td>
		<td align=center><a href="profile.php?action=show&uid=<?=$message['touid']?>"><?=$message['to']?></a></td>
		<td span class=smalltxt><?=$message['mdate']?></td>
		<td align=center>
		<?php if($action=='sendbox'){?>
      --
    <?php }elseif($message['ifnew']){?>
      <font color=red>否</font>
    <?php }else{?>
      是
    <?php }?>
		</td>
		<td align=center>
		<?php if($action=='scout' && ($message['ifnew']==0 && $message[to]!=$windid)){?>
        --
    <?php }else{?>
        <input type='checkbox' name='delid[]' value='<?=$message['mid']?>'>
    <?php }?>
		</td>
	</tr>
	<?php }}?>
</table>
<br>
<center>
	<input type='button' name='chkall' value='全选' onclick='CheckAll(this.form)'>
	<input type=submit value='提交'>
	<input name=towhere type=hidden value='<?=$towhere?>'>
	<input name=action type=radio value='del' checked>删除
</center>
</form>
<?php }elseif($action=='write'){?>
<script language="JavaScript" src="data/wind_editor.js"></script>
<form name='FORM' action='<?=$secondurl?>' method=POST onsubmit="return checkCnt();">
<table width='100%' cellspacing=1 cellpadding=3 align=center class=i_table>
    <tr class='t_one'>
      <td class=head colspan=2><b>短消息</b></td>
    </tr>
    <tr class='t_one'>
      <td width='20%'><b>用户名</b></td>
      <td><input type=text name='msg_ruser' maxlength=100 size=73 <?=$msgid?>></td>
    </tr>
    <tr class='t_one'>
      <td><b>标题</b></td>
      <td><input type=text name='msg_title' maxlength=75  size=73 value='<?=$subject?>'></td>
    </tr>
    <tr class='t_one'>
      <td valign=top><b>内容</b></td>
      <td><table cellPadding=0 cellSpacing=0 width="100%">
          <tr>
            <td id='edit' width='59%'> 字体
              <select onChange="showfont(this.options[this.selectedIndex].value);this.selectedIndex=0;this.selectedIndex=0" name=font>
                <option value=''></option>
                <option value='宋体'>宋体</option>
                <option value='楷体_GB2312'>楷体_GB2312</option>
                <option value='新宋体'>新宋体</option>
                <option value='黑体'>黑体</option>
                <option value='隶书'>隶书</option>
                <option value='Andale Mono'>Andale Mono</option>
                <option value='Arial'>Arial</option>
                <option value='Arial Black'>Arial Black</option>
                <option value='Book Antiqua'>Book Antiqua</option>
                <option value='Century Gothic'>Century Gothic</option>
                <option value='Comic Sans MS'>Comic Sans MS</option>
                <option value='Courier New'>Courier New</option>
                <option value='Georgia'>Georgia</option>
                <option value='Impact'>Impact</option>
                <option value='Tahoma'>Tahoma</option>
                <option value='Times New Roman'>Times New Roman</option>
                <option value='Trebuchet MS'>Trebuchet MS</option>
                <option value='Script MT Bold'>Script MT Bold</option>
                <option value='Stencil'>Stencil</option>
                <option value='Verdana'>Verdana</option>
                <option value='Lucida Console'>Lucida Console</option>
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
                <option value=''></option>
                <option value='skyblue' style='background-color:skyblue;color:skyblue'>&nbsp; &nbsp; &nbsp;  &nbsp;</option>
                <option value='royalblue' style='background-color:royalblue;color:royalblue'></option>
                <option value='blue' style='background-color:blue'></option>
                <option value='darkblue' style='background-color:darkblue'></option>
                <option value='orange' style='background-color:orange'></option>
                <option value='orangered' style='background-color:orangered'></option>
                <option value='crimson' style='background-color:crimson'></option>
                <option value='red' style='background-color:red'></option>
                <option value='firebrick' style='background-color:firebrick'></option>
                <option value='darkred' style='background-color:darkred'></option>
                <option value='green' style='background-color:green'></option>
                <option value='limegreen' style='background-color:limegreen'></option>
                <option value='seagreen' style='background-color:seagreen'></option>
                <option value='teal' style='background-color:teal'></option>
                <option value='deeppink' style='background-color:deeppink'></option>
                <option value='tomato' style='background-color:tomato'></option>
                <option value='coral' style='background-color:coral'></option>
                <option value='purple' style='background-color:purple'></option>
                <option value='indigo' style='background-color:indigo'></option>
                <option value='burlywood' style='background-color:burlywood'></option>
                <option value='sandybrown' style='background-color:sandybrown'></option>
                <option value='sienna' style='background-color:sienna'></option>
                <option value='chocolate' style='background-color:chocolate'></option>
                <option value='silver' style='background-color:silver'></option>
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
            </td>
          </tr>
        </table>
        <br><textarea name="atc_content" id="atc_content" cols="90" rows="25" style="overflow:auto;" tabindex="2"></textarea></td>
    </tr>
    <tr class='t_one'>
      <td width=26%></td>
      <td><input type='checkbox' name='ifsave' value='Y'>
        保存到发件箱中</td>
    </tr>
  </table>

<br>
<center>
	按 Ctrl+Enter 直接提交   
	<input type="submit" value="提 交" name="Submit">
</center>
<input type="hidden" name="action" value="write">
<input type="hidden" name="step" value="2"></form>
<?php }?>
<script language=JavaScript>
cnt = 0;
function checkCnt(){
	document.FORM.Submit.disabled=true;
	cnt++;
	if (cnt!=1){
		alert('提交中，请稍后！');
		return false;
	}
}
ifcheck = true;
function CheckAll(form){
	for (var i=0;i<form.elements.length-2;i++){
		var e = form.elements[i];
		e.checked = ifcheck;
	}
	ifcheck = ifcheck == true ? false : true;
}

function checkset(){
	if(confirm("将删除收件箱和发件箱内所有消息，请确认！")){
		return true;
	} else {
		return false;
	}
}
</script>