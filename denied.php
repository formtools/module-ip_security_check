<?php

require_once("../../global/library.php");

use FormTools\Modules;

$module = Modules::initModulePage("admin");
$L = $module->getLangStrings();

$success = true;
$message = "";
if (isset($_POST["update"])) {
	$module->setSettings(array("denied_page_content" => $_POST["denied_page_content"]));
	$success = true;
	$message = $L["notify_denied_page_updated"];
}

$settings = $module->getSettings();
$denied_page_content = $settings["denied_page_content"];

$page_vars = array(
    "g_success" => $success,
    "g_message" => $message,
    "denied_page_content" => $denied_page_content
);

$module->displayPage("templates/denied.tpl", $page_vars);
