{include file='modules_header.tpl'}

<table cellpadding="0" cellspacing="0">
<tr>
    <td width="45">
        <a href="index.php"><img src="images/icon_ip_security_check.png" border="0" width="34" height="34"/></a>
    </td>
    <td class="title">
        <a href="../../admin/modules">{$LANG.word_modules}</a>
        <span class="joiner">&raquo;</span>
        <a href="./">{$L.module_name}</a>
        <span class="joiner">&raquo;</span>
        {$L.phrase_denied_page}
    </td>
</tr>
</table>

{include file="messages.tpl"}

<form action="{$same_page}" method="post">

    <div class="margin_bottom_large">
        When a user is forbidden access, they will be redirected to a page that contains the following content.
    </div>

    <div style="border: 1px solid #666666; padding: 3px">
        <textarea name="denied_page_content" id="denied_page_content">{$denied_page_content}</textarea>
    </div>
    <script>
      var html_editor = new CodeMirror.fromTextArea(document.getElementById("denied_page_content"), {literal}{{/literal}
        name: "htmlmixed"
      {literal}});{/literal}
    </script>

    <p>
        <input type="submit" id="update" name="update" value="{$LANG.word_update}"/>
    </p>
</form>

{include file='modules_footer.tpl'}
