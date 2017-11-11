<?php

require_once("../../global/library.php");

use FormTools\Modules;

$module = Modules::initModulePage();

$settings = $module->getSettings();
$denied_page_content = $settings["denied_page_content"];

$page_vars = array(
    "hide_header_bar" => true,
    "hide_nav_menu" => true,
    "denied_page_content" => $denied_page_content
);

$module->displayPage("templates/forbidden.tpl", $page_vars);
