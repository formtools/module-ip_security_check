{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="global/images/icon_ip_security_check.png" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      <a href="./">{$L.module_name}</a>
      <span class="joiner">&raquo;</span>
      {$LANG.word_help}
    </td>
  </tr>
  </table>

  {include file="messages.tpl"}

  <div>
    {$L.text_help}
  </div>

{include file='modules_footer.tpl'}
