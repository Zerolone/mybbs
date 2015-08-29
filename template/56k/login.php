<table cellspacing=0 cellpadding=0 width='98%' align=center class=big_table>
  <tr>
    <td><table cellspacing=0 cellpadding=0 width='95%' align=center class=small_table>
    	<tr><td><br>
<table width='98%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV?> -> 用户登录</b></td>
  </tr>
</table>
<br>
<form action="login.php" method="post" name="login" onSubmit="this.submit.disabled=true;">
<table cellspacing=1 cellpadding=1 width='98%' style="border-top: #000000 1px solid;border-left: #000000 1px solid;border-right: #000000 1px solid;" align=center>
<tr>
      <td><table width=98% cellspacing=0 cellpadding=6 class='f_one'>
          <tr>
            <td class=head colspan=2 height=27><b>用户登录</b></td>
          </tr>
          <tr>
            <td rowspan=7 width=3%></td>
            <td width='100%'><br>
              请输入您的【用户帐号】与【用户密码】，然后点击【登录论坛】按钮. 如果您没有注册，请先<a href='reg.php'><font color=blue><b>注册成为会员</b></font></a>。提示：您的浏览器必须支持cookie，否则将不能登录论坛。</td>
          </tr>
          <tr>
            <td>用户帐号 &nbsp;<input name="username" type="text" id="username" tabindex="1" size="40" maxLength="20"></td>
          </tr>
          <tr>
            <td>用户密码 &nbsp;<input name="password" type="password" id="password" tabindex="2" size="40" maxLength="20"></td>
          </tr>
          <tr>
            <td> Cookie 有效期:
              <input type='radio' name='cktime' value='31536000' tabindex="5">一年 &nbsp;
              <input name='cktime' type='radio' value='2592000' checked="checked">一个月 &nbsp;
              <input type='radio' name='cktime' value='86400'>一天 &nbsp;
              <input type='radio' name='cktime' value='3600'>一小时 &nbsp;
            <input type='radio' name='cktime' value='0'>即时 &nbsp; &nbsp; </td>
          </tr>
        </table></td>
    </tr>
  </table>
  <center>
    <br>
    <input name='submit' type='submit' value=' 登 录 论 坛 ' tabindex="6">
  </center>
  <input type='hidden' value='<?=$pre_url?>' name='pre_url'>
  <input type='hidden' value='2' name='step'>
</form>