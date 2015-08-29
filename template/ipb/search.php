<br>
<table width='100%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td align=left><?=BBS_NAV?> -&gt; 搜索</b></td>
  </tr>
</table>
<br>
<?php if($step==0){?>
<form action='search.php?' method=post onSubmit="this.submit.disabled=true;">
  <input type="hidden" name="step" value="2">
<table width='100%' cellspacing=1 cellpadding=5 align=center class=i_table>    <tr>
      <td class='head' colspan=2>搜索目标</td>
    </tr>
    <tr>
      <td colspan="2" class='f_one'>关键词: <br><input type=text name='keyword' size=30></td>
    </tr>
    <tr>
      <td class='head' colspan=2>相关搜索选项</td>
    </tr>
    <tr>
      <td width="50%" class='f_one'><input type=radio name='s_type' value='all' checked>
        所有分类<br>
        <input type=radio name='s_type' value='forum'>
        社区分类
        <select name='f_fid' onclick="this.form.s_type[1].checked=true"><option>全局搜索</option><?=getForumsListById($MyDatabase);?></select></td>
      <td class='f_one' valign='top'>发表主题时间：<br>
        <select name=sch_time>
          <OPTION value='all'>所有主题</OPTION>
          <OPTION value='86400'>1天内的主题</OPTION>
          <OPTION value='172800'>2天内的主题</OPTION>
          <OPTION value='604800'>1星期内的主题</OPTION>
          <OPTION value='2592000'>1个月内的主题</OPTION>
          <OPTION value='5184000'>2个月内的主题</OPTION>
          <OPTION value='7776000'>3个月内的主题</OPTION>
          <OPTION value='15552000'>6个月内的主题</OPTION>
          <OPTION value='31536000'>1年内的主题</OPTION>
        </select></td>
    </tr>
    <tr>
      <td colspan="2" class='f_one'>结果排序:<br>
        <select name=orderway>
          <OPTION value='lastpost'>最后回复时间</OPTION>
          <OPTION value='replies'>回复</OPTION>
          <OPTION value='hits'>人气</OPTION>
        </select>
        <input type=radio name='asc' value='ASC'>
        升序
        <input type=radio name='asc' value='DESC' checked>
        降序 </td>
    </tr>
  </table>
  <center>
    <br>
    <input type='submit' name="submit" value='提 交'>
    <input type='reset' value='重 置'>
  </center>
</form>
<?php }else{?>
<table cellspacing=2 cellpadding=0 width='98%' align=center>
  <tr>
    <td align=left><?=$pages?></td>
  </tr>
</table>
<table width='98%' cellspacing=1 cellpadding=3 align=center bgcolor=#E7E3E7>
  <tr align=center height=25>
    <td width=5% class='head'><b>状态</b></td>
    <td width=* class='head'><b>标题</b></td>
    <td width=15% class='head'><b>论坛</b></td>
    <td width=13% class='head'><b>作者</b></td>
    <td width=5% class='head'><b>回复</b></td>
    <td width=5% class='head'><b>人气</b></td>
    <td width=20% class='head'><b>最后发表</b></td>
  </tr>
  <?php foreach($schdb as $sch){?>
  <tr align=center class='f_one'>
    <td class="<?=$sch['status']?>"></td>
    <td width=* align=left>
      &nbsp; <a href='read.php?tid=<?=$sch['tid']?>' target=_blank><?=$sch['title']?></a><?=$sch['titleadd']?>
    </td>
    <td><a href='topic.php?fid=<?=$sch['fid']?>'><?=$sch['forumname']?></a></td>
    <td class=smalltxt><a href='profile.php?action=show&uid=<?=$sch['authorid']?>'><?=$sch['author']?></a><br><?=$sch['postdate']?></td>
    <td><?=$sch['replies']?></td>
    <td><?=$sch['hits']?></td>
    <td><?=$sch['lastpost']?><br>by: <?=$sch['lastposter']?> </td>
  </tr>
  <?php }?>
</table>
<br>
<table cellspacing=2 cellpadding=0 width='98%' align=center>
	<tr><td align=left><?=$pages?> 共搜索到了<?=$total?>条信息[ <?=PAGE_PER?> 条/页]</td></tr>
</table>
<?php }?>