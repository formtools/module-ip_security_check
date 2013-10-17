<?php

require_once("../../global/library.php");

$settings = ft_get_module_settings();
$denied_page_content = $settings["denied_page_content"];

$page_vars = array();
$page_vars["denied_page_content"] = $denied_page_content;

ft_display_module_page("templates/forbidden.tpl", $page_vars);