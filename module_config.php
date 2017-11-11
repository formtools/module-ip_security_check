<?php

$STRUCTURE = array();

$HOOKS = array(
    array(
        "hook_type"       => "code",
        "action_location" => "main",
        "function_name"   => "FormTools\\User->login",
        "hook_function"   => "checkUser",
        "priority"        => "50"
    ),
);

$FILES = array(
    "code/",
    "code/index.html",
    "code/Module.class.php",
    "css/",
    "css/index.html",
    "css/styles.css",
    "images/",
    "images/icon_ip_security_check.png",
    "images/index.html",
    "lang/",
    "lang/en_us.php",
    "lang/index.html",
    "scripts/",
    "scripts/index.html",
    "scripts/security_check.js",
    "templates/",
    "templates/denied.tpl",
    "templates/forbidden.tpl",
    "templates/help.tpl",
    "templates/index.html",
    "templates/index.tpl",
    "denied.php",
    "forbidden.php",
    "help.php",
    "index.php",
    "library.php",
    "LICENSE",
    "module_config.php",
    "README.md"
);
