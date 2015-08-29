<br>
<table width='98%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td><?=BBS_NAV?> -&gt; 公告查看</b></td>
  </tr>
</table>
<br>
<table width='98%' cellspacing=0 cellpadding=0 align=center>
  <tr>
    <td><table width=100% cellspacing=1 cellpadding=3 bgcolor=#E7E3E7 style='TABLE-LAYOUT: fixed;WORD-WRAP: break-word'>
    		<?php foreach($noticedb as $notice){?>
        <tr align=center height=25>
          <td class=head colspan=2 align=center><a name="<?=$notice['id']?>">≡ <?=$notice['title']?> ≡<br></td>
        </tr>
        <tr>
          <td colspan=2 class='f_two'><br><br><?=$notice['content']?><br><br></td>
        </tr>
        <tr>
          <td colspan=2 class='f_two' align=right>时间:<?=$notice['startdate']?> </td>
        </tr>
        <?php }?>
      </table></td>
  </tr>
</table>