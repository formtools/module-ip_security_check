{include file='modules_header.tpl'}

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="global/images/icon_ip_security_check.png" border="0" width="34" height="34" /></a></td>
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
      var html_editor = new CodeMirror.fromTextArea("denied_page_content", {literal}{{/literal}
      parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js",
                   "../contrib/php/js/tokenizephp.js", "../contrib/php/js/parsephp.js", "../contrib/php/js/parsephphtmlmixed.js"],
      stylesheet: ["{$g_root_url}/global/codemirror/css/xmlcolors.css", "{$g_root_url}/global/codemirror/css/jscolors.css",
                   "{$g_root_url}/global/codemirror/css/csscolors.css", "{$g_root_url}/global/codemirror/contrib/php/css/phpcolors.css"],
      path:       "{$g_root_url}/global/codemirror/js/"
      {literal}});{/literal}
    </script>


	  <p>
	    <input type="submit" id="update" name="update" value="{$LANG.word_update}" />
	  </p>
	</form>

{include file='modules_footer.tpl'}
