<?php


/**
 * The installation script for the IP Security Check module.
 */
function ip_security_check__install($module_id)
{
  global $g_table_prefix, $LANG;

  $settings = array(
    "list_type" => "blacklist",
    "ip_list"   => "",
    "denied_page_content" => "<div class=\"title\">Access Denied</div>\n<p>\n  Sorry, you are not permitted access to the admin area.\n</p>"
  );
  ft_set_settings($settings, "ip_security_check");

  ft_register_hook("code", "ip_security_check", "main", "ft_login", "ipsc_check_user", 50, true);

  return array(true, $LANG["ip_security_check"]["notify_module_installed"]);
}


function ip_security_check__uninstall($module_id)
{
  return array(true, "");
}
