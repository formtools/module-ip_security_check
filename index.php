<?php

require_once("../../global/library.php");

use FormTools\Modules;

$module = Modules::initModulePage("admin");
$L = $module->getLangStrings();

$sortable_id = "ip_list";

$success = true;
$message = "";
if (isset($_POST["update_page"])) {

    // serialize the IP information
    $ip_list = array();
    $ips = (isset($_POST["ip"])) ? $_POST["ip"] : array();
    for ($i=0; $i<count($ips); $i++) {
        $ip   = trim($ips[$i]);
        $desc = trim($_POST["ip_desc"][$i]);
        $ip_list[] = "$desc`$ip";
    }
    $serialized_ip_list = implode("|", $ip_list);

    $settings = array(
        "list_type" => $_POST["list_type"],
        "ip_list"   => $serialized_ip_list
    );

    $module->setSettings($settings);
    $success = true;
    $message = $L["notify_settings_updated"];
}

$module_settings = $module->getSettings();
$ip_list_hash = $module->deserializeIpList($module_settings["ip_list"]);

$page_vars = array(
    "g_success" => $success,
    "g_message" => $message,
    "ip" => $_SERVER["REMOTE_ADDR"],
    "sortable_id" => $sortable_id,
    "module_settings" => $module_settings,
    "js_messages" => array(
        "word_close", "word_warning", "word_no"
    ),
    "module_js_messages" => array(
        "validation_no_list_type", "validation_invalid_chars", "phrase_fix_errors",
        "phrase_problems_found", "confirm_ip_on_blacklist", "confirm_ip_on_whitelist", "phrase_yes_continue"
    ),
    "ip_list_hash" => $ip_list_hash
);

$page_vars["head_js"] =<<< END
$(function() {
  if ($(".sortable_row").length == 0) {
    ip_ns.add_row();
  }
  $("#add_row_link").bind("click", function() { 
    return ip_ns.add_row();
  });

  $("#update").bind("click", function() {
    ip_ns.validate_ip_list({ ip: "{$_SERVER["REMOTE_ADDR"]}" });
  });
});
END;


$module->displayPage("templates/index.tpl", $page_vars);
