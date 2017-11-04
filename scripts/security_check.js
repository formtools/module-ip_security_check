var ip_ns = {};


/**
 * Adds a new row to the IP list table.
 */
ip_ns.add_row = function() {
  var li0 = $("<li class=\"col0\"></li>");
  var li1 = $("<li class=\"col1 sort_col\"></li>");
  var li2 = $("<li class=\"col2\"><input type=\"text\" name=\"ip_desc[]\" class=\"ip_desc\" /></li>");
  var li3 = $("<li class=\"col3\"><input type=\"text\" name=\"ip[]\" class=\"ip\" /></li>");
  var li4 = $("<li class=\"col4 colN del\"></li>");

  var ul = $("<ul></ul>");
  ul.append(li0);
  ul.append(li1);
  ul.append(li2);
  ul.append(li3);
  ul.append(li4);

  var main_div = $("<div class=\"row_group\"><input type=\"hidden\" class=\"sr_order\" value=\"\" /></div>");
  main_div.append(ul);
  main_div.append("<div class=\"clear\"></div>");

  $(".rows").append(sortable_ns.get_sortable_row_markup({ row_group: main_div, is_grouped: false }));
  sortable_ns.reorder_rows($(".ip_list"), false);

  return false;
}


/**
 * Called on the main module page. It validates the content to help ensure the data is valid + the current
 * admin has their own IP added to the list so they don't shoot themselves in the foot.
 */
ip_ns.validate_ip_list = function(settings) {
  var settings = $.extend({
    ip:              settings.ip,
    skip_validation: false
  }, settings);

  if (settings.skip_validation) {
    return;
  }

  var errors = [];
  if ($("input[name=list_type]:checked").length == 0) {
    errors.push("&bull; " + g.messages["validation_no_list_type"]);
  }

  // loop through the desc + IP fields and check there are no | or ` chars. Also make a note of whether the
  // current users IP is on the list
  var has_users_ip      = false;
  var has_invalid_chars = false;
  $(".sortable_row").each(function() {
    var desc = $.trim($(this).find(".ip_desc").val());
    var ip   = $.trim($(this).find(".ip").val());
    if (ip == settings.ip) {
      has_users_ip = true;
    }
    if (!has_invalid_chars && (desc.match(/[`\|]/) || ip.match(/[`\|]/))) {
      errors.push("&bull; " + g.messages["validation_invalid_chars"]);
      has_invalid_chars = true;
    }
  });

  // if there are any errors display them
  if (errors.length) {
    var message = g.messages["phrase_fix_errors"] + "<br />" + errors.join("<br />");
    ft.create_dialog({
      title:      g.messages["phrase_problems_found"],
      popup_type: "error",
      content:    message,
      width:      500,
      buttons: [{
        text: g.messages["word_close"],
        click: function() {
          $(this).dialog("close");
        }
      }]
    });
    return false;
  }

  // otherwise, if the current users IP isn't on the list, warn them
  var confirmation = null;
  var list_type    = $("input[name=list_type]:checked").val();
  if (has_users_ip && list_type == "blacklist") {
    confirmation = g.messages["confirm_ip_on_blacklist"];
  }
  if (!has_users_ip && list_type == "whitelist") {
    confirmation = g.messages["confirm_ip_on_whitelist"];
  }

  if (confirmation != null) {
    ft.create_dialog({
      title:      g.messages["word_warning"],
      popup_type: "warning",
      content:    confirmation,
      width:      500,
      buttons: [{
        text:  g.messages["phrase_yes_continue"],
        click: function() {
    	  $("form").submit();
        }
      },
      {
        text:  g.messages["word_no"],
        click: function() {
          $(this).dialog("close");
        }
      }]
    });
    return;
  }

  // update time!
  $("form").submit();
}
