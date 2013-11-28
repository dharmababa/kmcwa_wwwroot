<?php
//Please note that this is a Parent Theme's functions.php file,
//any code you added will be gone if you do an upgrade.
//You are advised to use a child theme and add your own custom functions to the child theme's functions.php


//check WP_DEBUG
//Some plugins such as wpcu3er will disable PHP error reporting, 
//therefore we must make sure it is turn on if WP_DEBUG is set to true.
if(defined('WP_DEBUG') == 1 || WP_DEBUG == true){
$error_setting = ini_get("display_errors");
	if($error_setting == '0'){
		ini_set('display_errors', '1');
	}
}

//Check if PHP error reporting is enabled.
//if it is enabled, we will only ALLOW PHP fatal error, syntax error, parse errors etc to show only.
$php_error_setting = ini_get("display_errors");
	if($php_error_setting == '1'){
	    //if you wnat to know what are these constants,
	    //reference to http://www.php.net/manual/en/errorfunc.constants.php
		error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE & ~E_WARNING & ~ E_DEPRECATED & ~ E_USER_NOTICE);
}

// Required TrueThemes Framework - do not edit or theme will fail!
require_once(TEMPLATEPATH . '/truethemes_framework/truethemes_framework_init.php');

// Load translation text domain
load_theme_textdomain ('truethemes_localize');

?>