<?php

/**
Plugin Name: Event Color by Calendar for Calendarize It!
Plugin URI: http://plugins.righthere.com/calendarize-it/
Description: Provides the option to color code events by Calendar taxonomy.
Version: 1.0.0
Author: Alberto Lau (RightHere LLC)
Author URI: http://plugins.righthere.com
 **/

if(defined('RHCTC_PATH')) throw new Exception( __('A duplicate of this addon/plugin is already active.','rhc') );
 
if(defined('RHC_ADDON_PATH')){
	define('RHCTC_PATH', trailingslashit(RHC_ADDON_PATH . dirname($addon)) ); 
	define("RHCTC_URL", trailingslashit(RHC_ADDON_URL . dirname($addon)) );
}else{
	define('RHCTC_PATH', plugin_dir_path(__FILE__) ); 
	define("RHCTC_URL", plugin_dir_url(__FILE__) );
} 
 
class plugin_rhc_taxonomy_color {
	function plugin_rhc_taxonomy_color(){		
		add_filter('rhc_calendar_meta',array(&$this,'rhc_calendar_meta'),10,1);
		

		add_action('add_tag_form_pre', array(&$this,'add_tag_form_pre'), 10, 1);
		add_action(RHC_CALENDAR . '_pre_edit_form', array(&$this,'calendar_pre_edit_form'), 10, 2);
	}	
	function rhc_calendar_meta($fields){
		$fields = is_array($fields)?$fields:array();
		$fields[]=	(object)array(
				'label'			=> __('Event colors','rhctc'),
				'type'			=> 'subtitle'
		);		
		$fields[]=(object)array(
				'id'	=> 'color',
				'label'	=> __('Text color','rhctc'),
				'el_properties' => array('class'=>'rhc_wp_colorpicker')
		);
		$fields[]=(object)array(
				'id'	=> 'background_color',
				'label'	=> __('Background color','rhctc'),
				'el_properties' => array('class'=>'rhc_wp_colorpicker')
		);
		return $fields;
	}
	
	function add_tag_form_pre(){
		$this->head();
	}
	
	function calendar_pre_edit_form(){
		$this->head();
	}
	
	function head(){
		global $tax;
		
		wp_print_styles( 'wp-color-picker' );
		wp_print_scripts( 'wp-color-picker' );
?>
<style>
.form-field .wp-picker-container input {
width:auto;
}
</style>
<script type='text/javascript'>
jQuery(document).ready(function($){
    $('.rhc_wp_colorpicker').wpColorPicker();
});
</script>
<?php		
	}
}

new plugin_rhc_taxonomy_color();
?>