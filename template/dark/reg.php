<table width='95%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV?> -&gt; 会员注册</b></td>
    <td align=right></td>
  </tr>
</table>
<br>
<?php if($step==0){?>
<form action='reg.php?method=full' method='post' onSubmit="this.regsubmit.disabled=true;">
<input type='hidden' name='step' value='1'>
<table cellspacing=1 cellpadding=3 width='95%' style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word;' bgcolor=#1F1F1F align=center>
<tr>
  <td class=head>注册向导</td></tr>
<tr><td class=f_one>
<pre>
1、啥啥啥
2、那啥那啥
3、的订单
</pre>
</td></tr></table>
<br><center><input name="regsubmit" type='submit' class='bginput' value='同 意'>
<input type='button' value='取消' onclick='javascript:history.go(-1);'></center>
</form>
<?php }elseif($step==1){?>
<script language="javascript" type="text/javascript">
var lastname = "";
var msg=new Array(
	"<font color=\"red\">用户名长度错误！</font>",
	"<font color=\"red\">此用户名包含不可接受字符或被管理员屏蔽,请选择其它用户名</font>",
	"<font color=\"red\">为了避免论坛用户名混乱,用户名中禁止使用大写字母,请使用小写字母</font>",
	"<font color=\"red\">该用户名已经被注册，请选用其他用户名。</font>",
	"<font color=\"green\">恭喜您，该用户名还未被注册，您可以使用这个用户名注册！</font>"
);
function namecheck() {
	var username = document.getElementById("regname").value;
	if (username == "") {
		return false;
	}
	if (username == lastname) {
		return false;
	}
	lastname = username;
	document.checkForm.username.value = username;
	document.getElementById("check_info").innerHTML = "检测中，请稍等...";
	document.checkForm.submit();
	return true;

}
function retmsg(id){
	document.getElementById("check_info").innerHTML = msg[id];
}
</script>
<iframe id="Checkframe" name="Checkframe" width="0" height="0"></iframe>
<form name="checkForm" action="regcheck.php" method="post" target="Checkframe">
  <input type="hidden" name="username">
  <input type="hidden" name="action" value="regnameck">
</form>

<form action="reg.php" method="post" name="register" onSubmit="return regcheck(this);">
  <table cellspacing=1 cellpadding=3 width='95%' bgcolor=#1F1F1F align=center>  
    <tr>
      <td colspan="2" class="head" height="25">注册程式</td>
    </tr>
    <tr class="f_one">
      <td width="35%"> 用户名<font color=red>*</font></td>
      <td valign="top"><input name='regname' type=text id="regname" size=20 maxlength=14>
        <input type="button" value="检查用户名" onClick="return namecheck();">
        不能有空格，可以是中文，长度控制在 3 - 12 字节以内 <br>
        &nbsp;
        <div id="check_info"></div></td>
    </tr>
    <tr class='f_one'>
      <td> 密码<font color=red>*</font></td>
      <td valign="top"><input name=regpwd type=password size=20 maxlength=75>
        英文字母或数字等不少于6位</td>
    </tr>
    <tr>
      <td class='f_one'> 确认密码<font color=red>*</font></td>
      <td class='f_one'><input name='regpwdrepeat' type=password size=20 maxlength=75></td>
    </tr>
    <tr>
      <td valign=middle  class='f_one'> Email<font color=red>*</font></td>
      <td  class='f_one'><input type=text size=20 maxlength=75 name=regemail>
        <input type=checkbox name='regemailtoall' value='1' checked>
        <font color='#000000'>公开邮箱 </font></td>
    </tr>
    <tr>
      <td class='f_one'> 性别</td>
      <td class='f_one'><select name=regsex>
          <OPTION value="1">男</OPTION>
          <OPTION value="2">女</OPTION>
          <OPTION value="0" selected>保密</OPTION>
        </select></td>
    </tr>
    <tr>
      <td class='f_one'> 生日</td>
      <td class='f_one'><select name=regbirthyear>
          <option value=''></option>
          <option value=1950>1950</option>
          <option value=1951>1951</option>
          <option value=1952>1952</option>
          <option value=1953>1953</option>
          <option value=1954>1954</option>
          <option value=1955>1955</option>
          <option value=1956>1956</option>
          <option value=1957>1957</option>
          <option value=1958>1958</option>
          <option value=1959>1959</option>
          <option value=1960>1960</option>
          <option value=1961>1961</option>
          <option value=1962>1962</option>
          <option value=1963>1963</option>
          <option value=1964>1964</option>
          <option value=1965>1965</option>
          <option value=1966>1966</option>
          <option value=1967>1967</option>
          <option value=1968>1968</option>
          <option value=1969>1969</option>
          <option value=1970>1970</option>
          <option value=1971>1971</option>
          <option value=1972>1972</option>
          <option value=1973>1973</option>
          <option value=1974>1974</option>
          <option value=1975>1975</option>
          <option value=1976>1976</option>
          <option value=1977>1977</option>
          <option value=1978>1978</option>
          <option value=1979>1979</option>
          <option value=1980>1980</option>
          <option value=1981>1981</option>
          <option value=1982>1982</option>
          <option value=1983>1983</option>
          <option value=1984>1984</option>
          <option value=1985>1985</option>
          <option value=1986>1986</option>
          <option value=1987>1987</option>
          <option value=1988>1988</option>
          <option value=1989>1989</option>
          <option value=1990>1990</option>
          <option value=1991>1991</option>
          <option value=1992>1992</option>
          <option value=1993>1993</option>
          <option value=1994>1994</option>
          <option value=1995>1995</option>
          <option value=1996>1996</option>
          <option value=1997>1997</option>
          <option value=1998>1998</option>
          <option value=1999>1999</option>
          <option value=2000>2000</option>
        </select>
        年
        <select name=regbirthmonth>
          <option value=''></option>
          <option value=1>1</option>
          <option value=2>2</option>
          <option value=3>3</option>
          <option value=4>4</option>
          <option value=5>5</option>
          <option value=6>6</option>
          <option value=7>7</option>
          <option value=8>8</option>
          <option value=9>9</option>
          <option value=10>10</option>
          <option value=11>11</option>
          <option value=12>12</option>
        </select>
        月
        <select name=regbirthday>
          <option value=''></option>
          <option value=1>1</option>
          <option value=2>2</option>
          <option value=3>3</option>
          <option value=4>4</option>
          <option value=5>5</option>
          <option value=6>6</option>
          <option value=7>7</option>
          <option value=8>8</option>
          <option value=9>9</option>
          <option value=10>10</option>
          <option value=11>11</option>
          <option value=12>12</option>
          <option value=13>13</option>
          <option value=14>14</option>
          <option value=15>15</option>
          <option value=16>16</option>
          <option value=17>17</option>
          <option value=18>18</option>
          <option value=19>19</option>
          <option value=20>20</option>
          <option value=21>21</option>
          <option value=22>22</option>
          <option value=23>23</option>
          <option value=24>24</option>
          <option value=25>25</option>
          <option value=26>26</option>
          <option value=27>27</option>
          <option value=28>28</option>
          <option value=29>29</option>
          <option value=30>30</option>
          <option value=31>31</option>
        </select>
        日</font></td>
    </tr>
    <tr>
      <td class='f_one'>OICQ</td>
      <td class='f_one'><input type=text size=20 maxlength=14 name='regoicq' value=''></td>
    </tr>
    <tr>
      <td class='f_one'> 个人主页</td>
      <td class='f_one'><input type=text size=20 maxlength=75 name='reghomepage' value=''></td>
    </tr>
    <tr>
      <td class='f_two'> 选择您的头像<br></td>
      <td class='f_two'><table width=100% cellspacing=0 cellpadding=0>
          <tr>
            <td width=22% valign=middle>              
            	<select name='proicon' onChange="showimage('<?=TP?>/images',this.options[this.selectedIndex].value)">
                <option value=''>不使用</option>
                <?=$imgselect?>
              </select></td>
            <td width=78% align=center valign=middle><img src='<?=TP?>/images/face/none.gif' name="useravatars" id="useravatars" /></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td valign=middle class='f_one'>个性化签名<br>
        将附在每篇文章后<br>
        <a href='faq.php?faqjob=1#5'><font face=verdana>Wind Code </font></a></td>
      <td class='f_one'><textarea cols=50 name='regsign' rows='4'></textarea></td>
    </tr>
    <tr>
      <td valign=middle class='f_one'> 来自</td>
      <td class='f_one'><input type=text size=20 maxlength=20 name='regfrom'></td>
    </tr>
    <tr>
      <td class='f_one'> 自我简介<br>
        --少于100字节</td>
      <td class='f_one'><textarea name=regintroduce rows=4 cols=50></textarea></td>
    </tr>
    <tr>
      <td class='f_one'> 是否接受系统邮件</td>
      <td class='f_one'><input type=radio name='regifemail' value='1' checked>
        接收邮件
        <input type=radio name='regifemail' value='2'>
        不接收邮件</td>
    </tr>
  </table>
  <input type=hidden value="2" name='step'>
  <br>
  <center>
    <input type='submit' name='regsubmit' value='提 交'>
  </center>
</form>
<script language="JavaScript1.2">
document.register.regname.focus();
function showimage(imgpath,value)
{
	if(value!= '') {	
	document.images.useravatars.src=imgpath+'/face/'+value;
	} else{
	document.images.useravatars.src=imgpath+'/face/none.gif';
	}
}
function regcheck(formct){
	if (formct.regname.value=='' || formct.regpwd.value=='' || formct.regpwdrepeat.value==''){
		alert('会员名或密码为空,请填写');
		return false; 
	}
	if (formct.regpwd.value!=formct.regpwdrepeat.value){
		alert('两次输入的密码不一致，请检查后重试。');
		return false; 
	}
	if (formct.regpwd.value.length<6){
		alert('密码太少，请用6位以上');
		return false;
	}
	formct.regsubmit.disabled=true;
}
</script>
<?php }?>