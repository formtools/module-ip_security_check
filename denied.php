<?php

require_once("../../global/library.php");
ft_init_module_page();

if (isset($_POST["update"]))
{
	ft_set_module_settings(array("denied_page_content" => $_POST["denied_page_content"]));
	$g_success = true;
	$g_message = $L["notify_denied_page_updated"];
}

$settings = ft_get_module_settings();
$denied_page_content = $settings["denied_page_content"];

$page_vars = array();
$page_vars["head_string"] =<<< END
  <link type="text/css" rel="stylesheet" href="global/css/styles.css">
  <script src="$g_root_url/global/codemirror/js/codemirror.js"></script>
END;
$page_vars["denied_page_content"] = $denied_page_content;

ft_display_module_page("templates/denied.tpl", $page_vars);