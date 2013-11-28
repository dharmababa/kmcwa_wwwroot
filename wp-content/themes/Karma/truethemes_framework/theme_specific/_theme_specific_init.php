<?php

//site options
require_once(TEMPLATEPATH . '/truethemes_framework/theme_specific/site-option.php');

//admin functions
require_once(TEMPLATEPATH . '/truethemes_framework/theme_specific/admin-functions.php');

//metaboxes
require_once(TEMPLATEPATH . '/truethemes_framework/theme_specific/metabox.php');

//Javascript Loader
require_once(TEMPLATEPATH . '/truethemes_framework/theme_specific/javascript.php');

//update notifier
$update_notifier = get_option('ka_update_notifier');
if($update_notifier == 'true' || empty($update_notifier)){
require_once(TEMPLATEPATH . '/truethemes_framework/theme_specific/update-notifier.php');
}

?>