<link rel="stylesheet" type="text/css" href="template/phpwind/images/user/style.css" />

<div id="user-wrap">
	<?php require_once(TP.'profile_head.php'); ?>
  <div id="user-main">
    <div class="u-m-bg-c cc"> 
      <!--左边栏-->
      <div id="user-sidebar" class="fl">
        <div class="p10">
          <div class="u-face"><img src="<?=TP?>/images/face/<?=$user->icon?>" border=0></div>
          <div class="tac" style="padding:10px 0"><a href="search.php?authorid=<?=$user->uid?>&step=2">用户主题</a></div>
</div>
      </div>
      <!--右边内容-->
      <div id="user-content" class="fr">
        <div class="u-cont-bg"></div>
        <div class="u-cont-bg2"></div>
        <div class="u-cont-bg-c p10" style="border:none;">
          <table width="100%" height="450">
            <tr>
              <td class="vt"><div id="u-cont-mm" class="fr">
                  <div class="u-box-b mt5">
                    <div class="u-box-b-bg">
                      <h2><span class="b">会员核心数据</span></h2>
                      <div class="p10">
                        <div class="lh24 bor-t-b mt5">
                        <form action='profile.php?' method=post onSubmit='return procheck(this)' name=creator enctype='multipart/form-data'>
                          <input type="hidden" name="action" value="modify">
                          <ul class="pt10 list-half cc">
                            <li>原密码</li>
                            <li><input type=password size=20 maxlength=75 name=oldpwd value=''>
        修改 <font color=blue>密码</font> 或 <font color=blue>邮箱</font>时需要密码验证</li>
                            <li>新密码</li>
                            <li><input type=password size=20 maxlength=75 name=propwd value=''></li>
                            <li>确认密码</li>
                            <li><input type=password size=20 maxlength=75 name=check_pwd value=''></li>
                            <li>E-MAIL</li>
                            <li><input type=text size=20 maxlength=75 name=proemail value=<?=$userdb['email']?>></li>
                            <li>QQ</li>
                            <li><input type=text size=20 maxlength=14 name=prooicq value=<?=$userdb['oicq']?>></li>
                            <li>来自</li>
                            <li><input type=text size=20 maxlength=14 name=profrom value=<?=$userdb['location']?>></li>
                            <li>个人主页</li>
                            <li><input type=text size=50 maxlength=75 name=prohomepage value="<?=$userdb['site']?>"></li>
                            <li>性别</li>
                            <li><select name=progender>
          <option value=0  <?php if(isset($sexselect[0])) echo $sexselect[0];?>>保密</option>
          <option value=1  <?php if(isset($sexselect[1])) echo $sexselect[1];?>>男</option>
          <option value=2  <?php if(isset($sexselect[2])) echo $sexselect[2];?>>女</option>
        </select>                            
                            </li>
                            <li></li>
                            <li>生日</li>
                            <li><select name=proyear>
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
        日 </li><li></li>
                            <li>自我简介<br>
        --少于100字节</li>
                            <li><textarea name='prointroduce' rows='4' cols='50'><?=$userdb['introduce']?></textarea></li>
                            <li>个性化签名<br>--少于30字节 </li>
                            <li><textarea name='prosign'  rows='4' cols='50'><?=$userdb['signature']?></textarea></li>
                            <li>选择您的头像</li>
                            <li><table width=100% cellspacing=0 cellpadding=0>
          <tr>
            <td width=22% valign=middle>论坛提供头像:
              <select name='proicon' onChange="showimage('<?=TP?>/images',this.options[this.selectedIndex].value)">
                <option value=''>不使用</option>
                <?=$imgselect?>
              </select></td>
            <td width=78% align=center valign=middle><img src='<?=TP?>/images/face/<?=$userdb['icon']?>' name=useravatars></td>
          </tr>
        </table></li>
                            <li></li>
                            <li><input type=submit name=prosubmit value='确认修改'>
  <input type=hidden value=2 name=step></li>
                          </ul>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
              </div></td>
            </tr>
          </table>
        </div>
        <div class="u-cont-bg2"></div>
        <div class="u-cont-bg"></div>
      </div>
    </div>
    <div class="u-m-bg"></div>
  </div>
</div>
</div>
<script language=JavaScript>
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
