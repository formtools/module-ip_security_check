{ft_include file='modules_header.tpl'}

  <div class="your_ip">
    <span class="label">Your IP:</span> <b>{$ip}</b>
  </div>

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td width="45"><a href="index.php"><img src="images/icon_ip_security_check.png" border="0" width="34" height="34" /></a></td>
    <td class="title">
      <a href="../../admin/modules">{$LANG.word_modules}</a>
      <span class="joiner">&raquo;</span>
      {$L.module_name}
    </td>
  </tr>
  </table>

  {ft_include file="messages.tpl"}

  <div>
    {$L.text_module_intro}
  </div>

  <ul>
    <li>{$L.phrase_whitelist_desc}</li>
    <li>{$L.phrase_blacklist_desc}</li>
  </ul>

  <div class="notify margin_bottom_large">
    <div style="padding: 6px">
      {$L.text_ip_change_warning}
    </div>
  </div>

  <form action="{$same_page}" method="post">
    <input type="hidden" name="update_page" value="1" />

	  <div class="margin_bottom">
	    <div class="field_label">{$L.phrase_list_type}</div>
	    <input type="radio" name="list_type" id="lt1" value="whitelist" {if $module_settings.list_type == "whitelist"}checked="checked"{/if} />
	      <label for="lt1">{$L.word_whitelist}</label>
	    <input type="radio" name="list_type" id="lt2" value="blacklist" {if $module_settings.list_type == "blacklist"}checked="checked"{/if} />
	      <label for="lt2">{$L.word_blacklist}</label>
	  </div>

	  <div class="sortable {$sortable_id}" id="{$sortable_id}">
	    <ul class="header_row">
	      <li class="col1"></li>
	      <li class="col2">{$L.word_description}</li>
	      <li class="col3">{$L.phrase_ip_address}</li>
	      <li class="col4 colN del"></li>
	    </ul>
	    <div class="clear"></div>
	    <ul class="rows">
	    {assign var=previous_item value=""}
	    {foreach from=$ip_list_hash item=i name=row}
	      {assign var=count value=$smarty.foreach.row.iteration}
	      <li class="sortable_row{if $smarty.foreach.row.last} rowN{/if}">
	        <div class="row_content">
	          <div class="row_group{if $smarty.foreach.row.last} rowN{/if}">
	            <input type="hidden" class="sr_order" value="{$count}" />
	            <ul>
	              <li class="col1 sort_col">{$count}</li>
	              <li class="col2"><input type="text" name="ip_desc[]" class="ip_desc" value="{$i.desc|escape}" /></li>
	              <li class="col3"><input type="text" name="ip[]" class="ip" value="{$i.ip|escape}" /></li>
	              <li class="col4 colN del"></li>
	            </ul>
	            <div class="clear"></div>
	          </div>
	        </div>
	        <div class="clear"></div>
	      </li>
	    {/foreach}
	    </ul>
	    <div class="clear"></div>
	  </div>

	  <div>
	    <a href="#" id="add_row_link">{$LANG.phrase_add_row}</a>
	  </div>

	  <p>
	    <input type="button" id="update" name="update" value="{$LANG.word_update}" />
	  </p>
	</form>

{ft_include file='modules_footer.tpl'}
