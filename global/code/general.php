<?php


/**
 * Called on login. This compares the users current IP address against the IP list in the database.
 *
 * @param array $vars
 */
function ipsc_check_user($vars)
{
  global $g_root_url, $g_table_prefix;

  $current_ip = $_SERVER["REMOTE_ADDR"];
  $settings = ft_get_module_settings("", "ip_security_check");

  $list_type = $settings["list_type"];
  $ip_list_hash = ipsc_deserialize_ip_list($settings["ip_list"]);

  $permitted = "";
  if ($list_type == "blacklist")
  {
    $permitted = true;
    foreach ($ip_list_hash as $ip_info)
    {
      if ($ip_info["ip"])
      {
        $permitted = false;
        break;
      }
    }
  }
  else if ($list_type == "whitelist")
  {
    $permitted = false;
    foreach ($ip_list_hash as $ip_info)
    {
      if ($ip_info["ip"])
      {
        $permitted = true;
        break;
      }
    }
  }

  if (!$permitted)
  {
    // check to see if there's a temporary override goin' on. If so, and the user's IP matches, permit them
    // entry and remove the override record
    if (isset($settings["temp_ip_override"]) && $settings["temp_ip_override"] == $current_ip)
    {
      @mysql_query("DELETE FROM {$g_table_prefix}settings WHERE setting_name = 'temp_ip_override' AND module = 'ip_security_check'");
    }
    else
    {
      header("location: $g_root_url/modules/ip_security_check/forbidden.php");
      exit;
    }
  }
}


/**
 * Deserializes the list of IP addresses specified through the module.
 *
 * @param $str
 * @return array
 */
function ipsc_deserialize_ip_list($str)
{
  $pairs = explode("|", $str);

  $ip_list_hash = array();
  foreach ($pairs as $pair)
  {
    if (empty($pair))
      continue;

    list($desc, $ip) = explode("`", $pair);
    $ip_list_hash[] = array(
      "desc" => $desc,
      "ip"   => $ip
    );
  }

  return $ip_list_hash;
}
