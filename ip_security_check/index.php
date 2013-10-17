<?php

require_once("../../global/library.php");
ft_init_module_page();
$request = array_merge($_POST, $_GET);
$sortable_id = "ip_list";

if (isset($_POST["update_page"]))
{
	// serialize the IP information
	$ip_list = array();
  $ips = (isset($_POST["ip"])) ? $_POST["ip"] : array();
  for ($i=0; $i<count($ips); $i++)
  {
    $ip   = trim($ips[$i]);
    $desc = trim($_POST["ip_desc"][$i]);
    $ip_list[] = "$desc`$ip";
  }
  $serialized_ip_list = implode("|", $ip_list);

	$settings = array(
	  "list_type" => $_POST["list_type"],
	  "ip_list"   => $serialized_ip_list
	);

	ft_set_module_settings($settings);
	$g_success = true;
	$g_message = $L["notify_settings_updated"];
}

$module_settings = ft_get_module_settings();
$ip_list_hash = ipsc_deserialize_ip_list($module_settings["ip_list"]);

$page_vars = array();
$page_vars["ip"] = $_SERVER["REMOTE_ADDR"];
$page_vars["sortable_id"] = $sortable_id;
$page_vars["module_settings"] = $module_settings;
$page_vars["js_messages"] = array("word_close", "word_warning", "word_no");
$page_vars["module_js_messages"] = array("validation_no_list_type", "validation_invalid_chars", "phrase_fix_errors",
  "phrase_problems_found", "confirm_ip_on_blacklist", "confirm_ip_on_whitelist", "phrase_yes_continue");
$page_vars["ip_list_hash"] = $ip_list_hash;
$page_vars["head_string"] =<<< END
  <link type="text/css" rel="stylesheet" href="global/css/styles.css">
  <script src="../../global/scripts/sortable.js"></script>
  <script src="global/scripts/scripts.js"></script>
END;
$page_vars["head_js"] =<<< END
$(function() {
  if ($(".sortable_row").length == 0) {
    ip_ns.add_row();
  }
  $("#add_row_link").bind("click", function() {
    return ip_ns.add_row();
  });

  $("#update").bind("click", function() { ip_ns.validate_ip_list({ ip: "{$_SERVER["REMOTE_ADDR"]}" }); });
});

END;


ft_display_module_page("templates/index.tpl", $page_vars);