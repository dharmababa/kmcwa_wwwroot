<?php

//This is old metabox ported from write-panels.php
//Do not change anything or it will affect existing customer's setting and templates.
//Cannot be using new metabox class' category type, because it is structurely different and does not pick up old values!

/*CUSTOM PORTFOLIO CATEGORIES FUNCTIONS */
function add_portfolio_cat($post_id){
/*
*this function adds a list of the categories as a custom write pannel
*to the pages section in the admin area. 
*this will allow the user to specify different pages as portfolio pages.
*/

/* load categories even if empty */
	$catargs = array(
    'orderby'       => 'name',
    'order'         => 'ASC',
    'hide_empty'    => 0,
    'hierarchical'  => 1);
	
	$categories = get_categories( $catargs );
	
	global $post;
	echo "<br />";
	$n = get_post_meta($post->ID, '_multiple_portfolio_cat_id', true);

	_e('Please select the post category that will be used to populate the portfolio items. <em style="color:#999;">If this is not a portfolio page you can simply ignore this section.</em></p><br />','truethemes_localize');

	echo "<select name='multiple_portfolio_cat_id'>";
	echo "<option value=''>Select Category</option>";
	foreach($categories as $category){
		$id = $category->cat_ID;
		if($id == $n){
			$checked = 'selected="selected"';
		}else{
			$checked  = '';
		}
		echo "<option $checked value='{$category->cat_ID}'>{$category->name}</option>";
	}
	echo "</select><br /><br />";
}

function create_multiple_portfolio_pages(){
	add_meta_box( 'multiple-portfolio-pages', __( 'Portfolio Category', 'truethemes_localize' ), 'add_portfolio_cat', 'page', 'normal', 'high' );
}

function save_multiple_portfolio_options($post_id){

  //added @since 2.7.1
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
      return $post_id;

	if('page' == $_POST['post_type']){
		$value = $_POST['multiple_portfolio_cat_id'];
		$key = '_multiple_portfolio_cat_id';
		$already_there = get_post_meta($post_id, $key, true);

		if(!is_numeric($value) && $value != ''){
			wp_die('WRONG portfolio category value.');
		}

		if(get_post_meta($post_id, $key) == ''){
			add_post_meta($post_id, $key, $value, $true);
		}else if($value != get_post_meta($post_id, $key, true)){
			update_post_meta($post_id, $key, $value);
		}else if($value == ''){
			delete_post_meta($post_id, $key);
		}
	}
}

add_action('save_post', 'save_multiple_portfolio_options');
add_action('admin_menu','create_multiple_portfolio_pages');


//This is old metabox ported from write-panels.php
//Do not change anything or it will affect existing customer's setting and templates.
//Adds Custom Sub-Menu to side panel
function truethemes_add_custom_box(){

      add_meta_box(
        'truethemes_custom_menu',
        __( 'Custom Sub-menu', 'truethemes_localize' ), 
        'truethemes_inner_custom_box_5',
        'page','side','low'
    );        

}

//post meta box
function truethemes_inner_custom_box_5(){

  //nonce
  wp_nonce_field( plugin_basename(__FILE__), 'truethemes_noncename' );
  
  
    //retrieve post meta value for check
  global $post;
  $post_id = $post->ID;
  $custom_menu_slug = get_post_meta($post_id,'truethemes_custom_sub_menu',true);

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label><?php _e('Select Menu:','truethemes_localize'); ?></label>
			<select id='truethemes_custom_sub_menu' name='truethemes_custom_sub_menu'>
			<option value="">-- Select a Menu --</option>
		<?php
			foreach ( $menus as $menu ) {
				$selected = $custom_menu_slug == $menu->slug ? ' selected="selected"' : '';
				echo '<option'. $selected .' value="'. $menu->slug .'">'. $menu->name .'</option>';
			}
		?>
			</select>
		</p>
		<?php


}

function truethemes_save_postdata($post_id){
  // verify if this is an auto save routine. 
  // If our form has not been submitted, we dont want to do anything
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
      return $post_id;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( !wp_verify_nonce( $_POST['truethemes_noncename'], plugin_basename(__FILE__) ) )
      return $post_id;

 	 if($_POST['post_type'] == 'page'){
 	 
 	 $meta = $_POST['truethemes_page_checkbox'];
  	
  	 $custom_menu_slug = $_POST['truethemes_custom_sub_menu'];
  	  
  	 update_post_meta($post_id,'truethemes_custom_sub_menu',$custom_menu_slug);    	

  	}

}

add_action('admin_init', 'truethemes_add_custom_box',1);
add_action('save_post', 'truethemes_save_postdata');


// Include & setup custom metabox and fields
$prefix = '_cmb_'; // start with an underscore to hide fields from custom fields list
add_filter( 'cmb_meta_boxes', 'be_sample_metaboxes' );


function be_sample_metaboxes( $meta_boxes ) {


/*---------------------------------------------------*/
/*	Old Meta Boxes for Posts
/*---------------------------------------------------*/


//This is old metabox ported from write-panels.php
//Do not change any 'id' or it will affect existing customer's setting and templates.
$meta_boxes[] = array(
		'id' => 'new-meta-boxes',
		'title' => __( 'Custom Settings', 'truethemes_localize' ),
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Portfolio Full Size URL  <span style="font-weight:normal !important;"><em>(Image, Flash Video, Youtube Video, etc)</em></span>','truethemes_localize'),
				'desc' => __('<b>Samples:</b><br><br><b>Image:</b>&nbsp;&nbsp; http://www.yourdomain.com/wp-content/uploads/project1.jpg<br>
<b>YouTube:</b>&nbsp;&nbsp; http://www.youtube.com/watch?v=VKS08be78os<br>
<b>Flash:</b>&nbsp;&nbsp; http://www.yourdomain.com/wp-content/uploads/design.swf?width=792&amp;height=294<br>
<b>Vimeo:</b>&nbsp;&nbsp; http://vimeo.com/8245346<br>
<b>iFrame:</b>&nbsp;&nbsp; http://www.apple.com?iframe=true&amp;width=850&amp;height=500<br>','truethemes_localize'),
				'id' => '_portimage_full_value',
				'type' => 'text'
			),
			
			
			array(
				'name' => __('Portfolio Description','truethemes_localize'),
				'desc' => __('<b>Note:</b> This description will be displayed in the JQuery pop-up.','truethemes_localize'),
				'id' => '_portimage_desc_value',
				'type' => 'text'
			),
			
			array(
				'name' => __('Link This Image','truethemes_localize'),
				'desc' => __('Enter a URL if you wish to link this image.<br><b>Sample:</b> &nbsp;http://www.yourdomain.com/about-us','truethemes_localize'),
				'id' => '_jcycle_url_value',
				'type' => 'text'
			)			
						
			
		)
	);

//This is old metabox ported from write-panels.php
//Do not change any 'id' or it will affect existing customer's setting and templates.
$meta_boxes[] = array(
		'id' => 'truethemes_video_id',
		'title' => __('Featured Video','truethemes_localize'),
		'pages' => array('post'), // post type
		'context' => 'side',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Video URL','truethemes_localize'),
				'desc' => '',
				'id' => 'truethemes_video_url',
				'type' => 'text_small'
			),
			
		)
	);
	
	
	
//This is old metabox ported from write-panels.php
//Do not change any 'id' or it will affect existing customer's setting and templates.
$meta_boxes[] = array(
		'id' => 'truethemes_featured_image_2',
		'title' => __( 'Featured Image (External Source)', 'truethemes_localize' ),
		'pages' => array('post'), // post type
		'context' => 'side',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Image URL','truethemes_localize'),
				'desc' => '',
				'id' => 'truethemes_external_image_url',
				'type' => 'text_small'
			),
			
		)
	);	

	

/*---------------------------------------------------*/
/*	Meta Boxes for Pages
/*---------------------------------------------------*/


//This is old metabox ported from write-panels.php
//Do not change any 'id' or it will affect existing customer's setting and templates.
$meta_boxes[] = array(
		'id' => 'truethemes_meta_box_id',
		'title' => __( 'Sub Navigation', 'truethemes_localize' ),
		'pages' => array('page'), // post type
		'context' => 'side',
		'priority' => 'low',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Hide the sub navigation','truethemes_localize'),
				'desc' => '',
				'id' => 'truethemes_page_checkbox',
				'type' => 'checkbox_small'
			),
			
		)
	);	

$meta_boxes[] = array(
		'id' => 'page_metabox',
		'title' => __('Page Settings','truethemes_localize'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
		array(
				'name' => __('Portfolio Count','truethemes_localize'),
				'desc' => __('Please enter the amount of portfolio items you\'d like to display on this page.<br /><em>If this is not a portfolio page you can simply ignore this section.</em>','truethemes_localize'),
				'id' => '_sc_port_count_value',
				'type' => 'text'
			),	


			/* array(
				'name' => __('Featured Image','truethemes_localize'),
				'desc' => __('The featured image will be the first item displayed in the content of the page.','truethemes_localize'),
				'id' => $prefix . 'page_featured_image',
				'type' => 'file'
			), */
			
			array(
				'name' => __('Banner Title','truethemes_localize'),
				'desc' => __('Use this section to override the default page title used in the banner.','truethemes_localize'),
				'id' => $prefix . '_pagetitle_value',
				'type' => 'text'
			),
			
			array(
				'name' => __('Searchbar','truethemes_localize'),
				'desc' => __('Would you like to display a searchbar on this page?','truethemes_localize'),
				'id' => $prefix . 'banner_search',
				'type' => 'select',
				'options' => array(
					array('name' => 'Yes', 'value' => 'yes'),
					array('name' => 'No', 'value' => 'no')			
				)
			),
			
			
			array(
				'name' => __('Page Comments','truethemes_localize'),
				'desc' => __('Check this box to enable comments on this page.','truethemes_localize'),
				'id' => $prefix . 'page_comments',
				'type' => 'checkbox'
			),
			
			
			
			/* array(
				'name' => __('Banner Description','truethemes_localize'),
				'desc' => __('Use this section to enter a short description for this page. (note: if you are displaying the searchbar this description will not be displayed.)','truethemes_localize'),
				'id' => $prefix . 'banner_description',
				'type' => 'textarea_small'
			), */
		)
	);
	
	
	

/*---------------------------------------------------*/
/*	Meta Boxes for Pages - Styling Options
/*---------------------------------------------------*/
$meta_boxes[] = array(
		'id' => 'page_metabox_styling',
		'title' => __('Page Styling Options','truethemes_localize'),
		'pages' => array('page'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
		array(
 'name' => __('Primary Color Scheme','truethemes_localize'),
 'desc' => __('Use this section to set a custom primary color scheme for this page only.','truethemes_localize'),
 'id' => $prefix . 'page_primary_color_scheme',
 'type' => 'select',
'options' => array(
					array('name' => '-- Select a Color Scheme --', 'value' => 'null'),
					array('name' => 'Autumn', 'value' => 'karma-autumn.css'),
					array('name' => 'Black', 'value' => 'karma-dark.css'),
					array('name' => 'Blue Grey', 'value' => 'karma-blue-grey.css'),
					array('name' => 'Cherry', 'value' => 'karma-cherry.css'),
					array('name' => 'Cool Blue', 'value' => 'karma-cool-blue.css'),
					array('name' => 'Coffee', 'value' => 'karma-coffee.css'),
					array('name' => 'Fire', 'value' => 'karma-fire.css'),
					array('name' => 'Forest Green', 'value' => 'karma-forest-green.css'),
					array('name' => 'Golden', 'value' => 'karma-golden.css'),
					array('name' => 'Grey', 'value' => 'karma-grey.css'),
					array('name' => 'Lime Green', 'value' => 'karma-lime-green.css'),
					array('name' => 'Periwinkle', 'value' => 'karma-periwinkle.css'),
					array('name' => 'Pink', 'value' => 'karma-pink.css'),
					array('name' => 'Purple', 'value' => 'karma-purple.css'),
					array('name' => 'Royal Blue', 'value' => 'karma-royal-blue.css'),
					array('name' => 'Silver', 'value' => 'karma-silver.css'),
					array('name' => 'Sky Blue', 'value' => 'karma-sky-blue.css'),
					array('name' => 'Teal Grey', 'value' => 'karma-teal-grey.css'),
					array('name' => 'Teal', 'value' => 'karma-teal.css'),
					array('name' => 'Violet', 'value' => 'karma-violet.css'),			
				  )
),


array(
 'name' => __('Secondary Color Scheme','truethemes_localize'),
 'desc' => __('Use this section to set a custom secondary color scheme for this page only.','truethemes_localize'),
 'id' => $prefix . 'page_secondary_color_scheme',
 'type' => 'select',
'options' => array(
					array('name' => '-- Select a Color Scheme --', 'value' => 'null'),
					array('name' => 'Autumn', 'value' => 'secondary-autumn.css'),
					array('name' => 'Black', 'value' => 'secondary-dark.css'),
					array('name' => 'Blue Grey', 'value' => 'secondary-blue-grey.css'),
					array('name' => 'Cherry', 'value' => 'secondary-cherry.css'),
					array('name' => 'Cool Blue', 'value' => 'secondary-cool-blue.css'),
					array('name' => 'Coffee', 'value' => 'secondary-coffee.css'),
					array('name' => 'Fire', 'value' => 'secondary-fire.css'),
					array('name' => 'Forest Green', 'value' => 'secondary-forest-green.css'),
					array('name' => 'Golden', 'value' => 'secondary-golden.css'),
					array('name' => 'Grey', 'value' => 'secondary-grey.css'),
					array('name' => 'Lime Green', 'value' => 'secondary-lime-green.css'),
					array('name' => 'Periwinkle', 'value' => 'secondary-periwinkle.css'),
					array('name' => 'Pink', 'value' => 'secondary-pink.css'),
					array('name' => 'Purple', 'value' => 'secondary-purple.css'),
					array('name' => 'Royal Blue', 'value' => 'secondary-royal-blue.css'),
					array('name' => 'Silver', 'value' => 'secondary-silver.css'),
					array('name' => 'Sky Blue', 'value' => 'secondary-sky-blue.css'),
					array('name' => 'Teal Grey', 'value' => 'secondary-teal-grey.css'),
					array('name' => 'Teal', 'value' => 'secondary-teal.css'),
					array('name' => 'Violet', 'value' => 'secondary-violet.css'),		
				  )
			),
			
			array(
				'name' => __('Background Color','truethemes_localize'),
				'desc' => __('Use this section to set a custom background color for this page only.<br />
				(This is only recommended when using the boxed layout design.)','truethemes_localize'),
				'id' => $prefix . 'page_background_color',
				'type' => 'colorpicker'
			),
			
			array(
				'name' => __('Background Image','truethemes_localize'),
				'desc' => __('Use this section to set a custom background image for this page only.<br />
				(This is only recommended when using the boxed layout design.)','truethemes_localize'),
				'id' => $prefix . 'page_background_image',
				'type' => 'file'
			),
			
			array(
				'name' => __('Background Position','truethemes_localize'),
				'desc' => __('Use this section to set the background position of your custom background image.<br />
				(This is only required when using a custom background image.)','truethemes_localize'),
				'id' => $prefix . 'page_background_position',
				'type' => 'select',
				'options' => array(
					array('name' => 'left top', 'value' => 'left top'),
					array('name' => 'center top', 'value' => 'center top'),
					array('name' => 'right top', 'value' => 'right top'),
					array('name' => 'center center', 'value' => 'center center'),
					array('name' => 'left bottom', 'value' => 'left bottom'),
					array('name' => 'center bottom', 'value' => 'center bottom'),
					array('name' => 'right bottom', 'value' => 'right bottom'),	
				  )
			),
			
			array(
				'name' => __('Background Repeat','truethemes_localize'),
				'desc' => __('Use this section to set the repeat property for your custom background image.<br />
				(This is only required when using a custom background image.)','truethemes_localize'),
				'id' => $prefix . 'page_background_repeat',
				'type' => 'select',
				'options' => array(
					array('name' => 'repeat', 'value' => 'repeat'),
					array('name' => 'repeat-x', 'value' => 'repeat-x'),
					array('name' => 'repeat-y', 'value' => 'repeat-y'),
					array('name' => 'no-repeat', 'value' => 'no-repeat'),	
				  )
			),
			

			
		)
	);
	
return $meta_boxes;
}
add_action('init','be_initialize_cmb_meta_boxes',9999);
function be_initialize_cmb_meta_boxes() {
if (!class_exists('cmb_Meta_Box')) {require_once('init.php');}}
?>