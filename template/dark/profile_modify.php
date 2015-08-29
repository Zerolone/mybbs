<br>
<table width='95%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV?> -&gt 信息资料</td>
  </tr>
</table>
<br>
<?php require_once(TP.'profile_head.php'); ?>
<br>
<form action='profile.php?' method=post onSubmit='return procheck(this)' name=creator enctype='multipart/form-data'>
  <input type="hidden" name="action" value="modify">
  <table cellspacing=1 cellpadding=4 width='95%' bgcolor=#1F1F1F align=center>
    <tr height=25>
      <td class=head colspan=2> 会员核心数据 </td>
    </tr>
    <tr>
      <td width=35% class='f_one'> 原密码</td>
      <td class='f_one'><input type=password size=20 maxlength=75 name=oldpwd value=''>
        修改 <font color=blue>密码</font> 或 <font color=blue>邮箱</font>时需要密码验证</td>
    </tr>
    <tr>
      <td class='f_two'> 新密码</td>
      <td class='f_two'><input type=password size=20 maxlength=75 name=propwd value=''></td>
    </tr>
    <tr>
      <td class='f_one'> 确认密码</td>
      <td class='f_one'><input type=password size=20 maxlength=75 name=check_pwd value=''></td>
    </tr>
    <tr>
      <td class='f_two'> E-MAIL</td>
      <td class='f_two'><input type=text size=20 maxlength=75 name=proemail value=<?=$userdb['email']?>></td>
    </tr>
    <tr height=25>
      <td class=head colspan=2> 会员基本数据 </td>
    </tr>
    <tr>
      <td class='f_two'> QQ</td>
      <td class='f_two'><input type=text size=20 maxlength=14 name=prooicq value=<?=$userdb['oicq']?>></td>
    </tr>
    <tr>
      <td class='f_two'> 来自</td>
      <td class='f_two'><input type=text size=20 maxlength=14 name=profrom value=<?=$userdb['location']?>></td>
    </tr>
    <tr>
      <td class='f_one'> 个人主页</td>
      <td class='f_one'><input type=text size=50 maxlength=75 name=prohomepage value="<?=$userdb['site']?>"></td>
    </tr>
    <tr>
      <td class='f_two'> 性别</td>
      <td class='f_two'><select name=progender>
          <option value=0  <? if(isset($sexselect[0])) echo $sexselect[0];?>>保密</option>
          <option value=1  <? if(isset($sexselect[1])) echo $sexselect[1];?>>男</option>
          <option value=2  <? if(isset($sexselect[2])) echo $sexselect[2];?>>女</option>
        </select></td>
    </tr>
    <tr>
      <td class='f_one'> 生日</td>
      <td class='f_one'>
      	<select name=proyear>
        <option value=''></option>
        <?php for($i=1960;$i<=2004;$i++){?>
        <option value=<?=$i?> 
        <?
        if(isset($yearslect[$i])) echo $yearslect[$i];
				?>
        ><?=$i?></option>  
        <?php }?>
        </select>年 
        <select name=promonth>
          <option value=''></option>
          <?php for($i=1;$i<=12;$i++){?>
          <option value=<?=$i?> 
          <?
          if(isset($monthslect[$i])) echo $monthslect[$i];
          ?>
          ><?=$i?></option>  
	        <?php }?>
        </select>
        月
        <select name=proday>
          <option value=></option>
          <option value=''></option>
          <?php for($i=1;$i<=31;$i++){?>
          <option value=<?=$i?> 
          <?
          if(isset($dayslect[$i])) echo $dayslect[$i];
          ?>
          ><?=$i?></option>  
          <?php }?>
        </select>
        日 </td>
    </tr>
    <tr>
      <td class='f_two'> 自我简介<br>
        --少于100字节</td>
      <td class='f_two'><textarea name='prointroduce' rows='4' cols='50'><?=$userdb['introduce']?></textarea></td>
    </tr>
    <tr height=25>
      <td class=head colspan=2> 会员可定义数据 </td>
    </tr>
    <tr>
      <td class='f_one'> 个性化签名<br>--少于30字节</td>
      <td class='f_one'><textarea name='prosign'  rows='4' cols='50'><?=$userdb['signature']?></textarea></td>
    </tr>
    <tr>
      <td class='f_two'> 选择您的头像 <br></td>
      <td class='f_two'><table width=100% cellspacing=0 cellpadding=0>
          <tr>
            <td width=22% valign=middle>论坛提供头像:
              <select name='proicon' onChange="showimage('<?=TP?>/images',this.options[this.selectedIndex].value)">
                <option value=''>不使用</option>
                <?=$imgselect?>
              </select></td>
            <td width=78% align=center valign=middle><img src='<?=TP?>/images/face/<?=$userdb['icon']?>' name=useravatars></td>
          </tr>
        </table>
       </td>
    </tr>
  </table>
  <br>
  <center>
  <input type=submit name=prosubmit value='确认修改'>
  <input type=hidden value=2 name=step>
  <center>
</form>
<script language=JavaScript1.2>
function procheck(formct)
{
	if (formct.prointroduce.value.length>200)
	{
		alert('自我介绍太长，请删掉一些，控制在200个字节以内');
		return false;
	}
}
function showimage(imgpath,value)
{
	if(value!= '') {	
	document.images.useravatars.src=imgpath+'/face/'+value;
	} else{
	document.images.useravatars.src=imgpath+'/face/none.gif';
	}
}
</script>