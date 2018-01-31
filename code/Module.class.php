<?php

namespace FormTools\Modules\IpSecurityCheck;

use FormTools\Core;
use FormTools\Hooks;
use FormTools\Module as FormToolsModule;


class Module extends FormToolsModule
{
    protected $moduleName = "IP Security Check";
    protected $moduleDesc = "This module adds an additional security layer to Form Tools user accounts, letting you maintain a whitelist or blacklist of IP addresses.";
    protected $author = "Ben Keen";
    protected $authorEmail = "ben.keen@gmail.com";
    protected $authorLink = "https://formtools.org";
    protected $version = "2.0.4";
    protected $date = "2019-01-30";
    protected $originLanguage = "en_us";
    protected $jsFiles = array(
        "scripts/security_check.js",
        "{FTROOT}/global/scripts/sortable.js",
        "{MODULEROOT}/scripts/security_check.js",
        "{FTROOT}/global/codemirror/lib/codemirror.js",
        "{FTROOT}/global/codemirror/lib/codemirror.js",
        "{FTROOT}/global/codemirror/mode/xml/xml.js",
        "{FTROOT}/global/codemirror/mode/htmlmixed/htmlmixed.js",
        "{FTROOT}/global/codemirror/mode/css/css.js",
        "{FTROOT}/global/codemirror/mode/javascript/javascript.js",
        "{FTROOT}/global/codemirror/mode/clike/clike.js"
    );
    protected $cssFiles = array(
        "css/styles.css",
        "{FTROOT}/global/codemirror/lib/codemirror.css",
    );

    protected $nav = array(
        "module_name"        => array("index.php", false),
        "phrase_denied_page" => array("denied.php", true),
        "word_help"          => array("help.php", true)
    );

    public function install($module_id)
    {
        $L = $this->getLangStrings();

        $this->setSettings(array(
            "list_type" => "blacklist",
            "ip_list"   => "",
            "denied_page_content" => "<div class=\"title\">Access Denied</div>\n<p>\n  Sorry, you are not permitted access to the admin area.\n</p>"
        ));

        $this->resetHooks();

        return array(true, $L["notify_module_installed"]);
    }


    public function upgrade($module_id, $old_module_version)
    {
        $this->resetHooks();
    }


    public function resetHooks()
    {
        $this->clearHooks();
        Hooks::registerHook("code", "ip_security_check", "main", "FormTools\\User->login", "checkUser", 50, true);
    }


    /**
     * Called on login. This compares the users current IP address against the IP list in the database.
     *
     * @param array $vars
     */
    public function checkUser($vars)
    {
        $db = Core::$db;
        $root_url = Core::getRootUrl();

        $current_ip = $_SERVER["REMOTE_ADDR"];
        $settings = $this->getSettings();

        $list_type = $settings["list_type"];
        $ip_list_hash = $this->deserializeIpList($settings["ip_list"]);

        $permitted = "";
        if ($list_type == "blacklist") {
            $permitted = true;
            foreach ($ip_list_hash as $ip_info) {
                if (strpos($ip_info["ip"], "*") !== false) {
                    // convert the *'s in the IP address into a regexp
                    $match = preg_replace("/\*/", "\d{1,3}", $ip_info["ip"]);
                    $reg_exp = "/$match/";
                    if (preg_match($reg_exp, $current_ip)) {
                        $permitted = false;
                        break;
                    }
                } else {
                    if ($ip_info["ip"]) {
                        $permitted = false;
                        break;
                    }
                }
            }
        } else if ($list_type == "whitelist") {
            $permitted = false;
            foreach ($ip_list_hash as $ip_info) {
                if (strpos($ip_info["ip"], "*") !== false) {
                    // convert the *'s in the IP address into a regexp
                    $match = preg_replace("/\*/", "\d{1,3}", $ip_info["ip"]);
                    $reg_exp = "/$match/";
                    if (preg_match($reg_exp, $current_ip)) {
                        $permitted = true;
                        break;
                    }

                // otherwise, do a direct comparison
                } else {
                    if ($current_ip == $ip_info["ip"]) {
                        $permitted = true;
                        break;
                    }
                }
            }
        }

        if (!$permitted) {
            // check to see if there's a temporary override goin' on. If so, and the user's IP matches, permit them
            // entry and remove the override record
            if (isset($settings["temp_ip_override"]) && $settings["temp_ip_override"] == $current_ip) {
                $db->query("
                    DELETE FROM {PREFIX}settings
                    WHERE setting_name = 'temp_ip_override' AND module = 'ip_security_check'
                ");
                $db->execute();
            } else {
                header("location: $root_url/modules/ip_security_check/forbidden.php");
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
    public function deserializeIpList($str)
    {
        $pairs = explode("|", $str);

        $ip_list_hash = array();
        foreach ($pairs as $pair) {
            if (empty($pair)) {
                continue;
            }

            list ($desc, $ip) = explode("`", $pair);
            $ip_list_hash[] = array(
                "desc" => $desc,
                "ip"   => $ip
            );
        }

        return $ip_list_hash;
    }

}

