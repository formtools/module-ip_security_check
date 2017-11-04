<?php

require_once("../../global/library.php");

use FormTools\Modules;

$module = Modules::initModulePage("admin");

$settings = $module->getSettings();
$denied_page_content = $settings["denied_page_content"];

$page_vars = array(
    "denied_page_content" => $denied_page_content
);

$module->displayPage("templates/forbidden.tpl", $page_vars);
