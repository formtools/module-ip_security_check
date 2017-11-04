<?php

$L = array();

$L["module_name"] = "IP Security Check";
$L["module_description"] = "This module adds an additional security layer to Form Tools user accounts, letting you maintain a whitelist or blacklist of IP addresses.";

$L["word_label"] = "Label";
$L["word_description"] = "Description";
$L["word_whitelist"] = "Whitelist";
$L["word_blacklist"] = "Blacklist";

$L["phrase_ip_address"] = "IP Address";
$L["phrase_list_type"] = "List Type";
$L["phrase_whitelist_desc"] = "A <b>whitelist</b> is a list of <span class=\"green\">permitted</span> IP addresses.";
$L["phrase_blacklist_desc"] = "A <b>blacklist</b> is a list of <span class=\"red\">banned</span> IP addresses.";
$L["phrase_denied_page"] = "Denied Page";
$L["phrase_fix_errors"] = "Please fix the following errors and resubmit:";
$L["phrase_problems_found"] = "Problems found";
$L["phrase_yes_continue"] = "Yes, continue";

$L["notify_module_installed"] = "The IP Security Check module has been installed and enabled. We strongly recommend <a href=\"../../modules/ip_security_check/\">configuring the module now</a> to add in your IP address.";
$L["notify_denied_page_updated"] = "The content of the Denied page has been updated.";
$L["notify_settings_updated"] = "Your settings have been updated.";

$L["text_module_intro"] = "This module adds an additional security layer to Form Tools user accounts, letting you maintain a whitelist or blacklist of IP addresses. You can target the list of IPs through one of two methods:";
$L["text_ip_change_warning"] = "<b>Warning</b>: IP addresses can change! If you find yourself locked out by this module, visit the module documentation at <a href=\"https://docs.formtools.org/modules/ip_security_check/\">https://docs.formtools.org/modules/ip_security_check/</a> to find out how to get back in.";
$L["text_help"] = "For further help on how to use this module, please see the <a href=\"https://docs.formtools.org/modules/ip_security_check/\">module help documentation</a>.";

$L["validation_no_list_type"] = "Please select the list type.";
$L["validation_invalid_chars"] = "Sorry, the following characters are not permitted in any fields: ` and |.";

$L["confirm_ip_on_blacklist"] = "Your current IP address is on the blacklist. You will not be able to log in again from your current location. Are you sure you want to proceed?";
$L["confirm_ip_on_whitelist"] = "Your current IP address isn't on the list. If you don't include your current IP address, you won't be able to log in from your current location. Are you sure you want to proceed?";
