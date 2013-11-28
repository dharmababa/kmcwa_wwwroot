<?php
/*-------------------------------------------------------------------------*/
/*	Force comments status open for all pages.
/*-------------------------------------------------------------------------*/
function tt_get_comments_status()
{
	global $post;
	//do this only in page, to force comment open for all pages in WordPress posts table,
	//let showing of comments template decide by our theme's custom post meta only
	if (is_page()) {
		$_post = get_post($post->ID);
		//if by default page comments is closed, we set to open.
		if ($_post->comment_status == 'closed') {
			$update_post                   = array();
			$update_post['ID']             = $post->ID;
			$update_post['comment_status'] = 'open';
			$update_post['ping_status'] = 'open';
			wp_update_post($update_post);
		}
	}
}
add_action('template_redirect', 'tt_get_comments_status');


// Modify excerpt length
function wp_new_excerpt($text)
{
	if ($text == '')
	{
		$text = get_the_content('');
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text);
		$text = nl2br($text);
		$excerpt_length = apply_filters('excerpt_length', 80);
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wp_new_excerpt');




// Hide unnecessary user profile fields
add_filter('user_contactmethods','hide_profile_fields',10,1);

function hide_profile_fields( $contactmethods ) {
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
return $contactmethods;
}




/*-------------------------------------------------------------------------*/
/*    Retrieve excluded blog categories from site options
/*-------------------------------------------------------------------------*/
function B_getExcludedCats()
{
    global $wpdb;
    $excluded = '';
    
    //mod by denzel
    //@since version 2.1.1, check WordPress version to determine which prepared statement to use.
    $check_wp_version = get_bloginfo('version');
    if($check_wp_version < 3.5){
      
      //pre WP3.5 version, we use this. Not sure if pre WP 3.5 can work with new prepared statement format..
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%ka_blogexcludetest_%'" ) );
    
    }else{
      
      //this is WP 3.5, we use the following correct prepared statement.
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s", "ka_blogexcludetest%") );
      
    }
    
    foreach ($cats as $cat) {
        if ($cat->option_value == "true") {
            $exploded = explode("_", $cat->option_name);
            $excluded .= "-{$exploded[2]}, ";
        }
    }
    return rtrim(trim($excluded), ',');
}


/*-------------------------------------------------------------------------*/
/*    Convert excluded into positive numbers (ie: 4,32,12,19)
/*-------------------------------------------------------------------------*/
function positive_exlcude_cats()
{
    global $wpdb;
    $pos_excluded = '';
    
    //mod by denzel
    //@since version 2.1.1, check WordPress version to determine which prepared statement to use.
    $check_wp_version = get_bloginfo('version');
    if($check_wp_version < 3.5){
      
      //pre WP3.5 version, we use this. Not sure if pre WP 3.5 can work with new prepared statement format..
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE '%ka_blogexcludetest_%'" ) );
    
    }else{
      
      //this is WP 3.5, we use the following correct prepared statement.
      $cats = $wpdb->get_results( $wpdb->prepare( "SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE %s", "ka_blogexcludetest%") );
      
    }
    
    foreach ($cats as $cat) {
        if ($cat->option_value == "true") {
            $exploded_pos = explode("_", $cat->option_name);
            $pos_excluded .= "{$exploded_pos[2]},";
        }
    }
    return rtrim(trim($pos_excluded), ',');
}


// Hide categories from the loop

if (!is_admin()){
	
function wploop_exclude($query) {
$exclude = B_getExcludedCats();

//do this exclusion only in feed, search, archive (category and tag included), and posts page or home
if ($query->is_feed || $query->is_search || $query->is_archive || $query->is_home){

   //2.6.7 dev 1 - No need exclusion in single category view as all posts will be in the same category, fixes permanent link issue, when accesss from categories widget.
   
   if(!$query->is_category){
   $query->set('cat',''.$exclude.'');
   }
}
return $query;
}
add_filter('pre_get_posts','wploop_exclude');


function wpfeed_exclude($query) {
$excludefeed = B_getExcludedCats();
if ($query->is_feed) {
$query->set('cat',''.$excludefeed.'');
}
return $query;
}
add_filter('pre_get_posts','wpfeed_exclude');

}


/* CUSTOM ARCHIVES PARAMETERS 

MODIFIED BY TrueThemes, ORIGINAL PLUGIN:


Plugin Name: Archives for a category 
Plugin URI: http://kwebble.com/blog/2007_08_15/archives_for_a_category
Description: Adds a cat parameter to wp_get_archives() to limit the posts used to generate the archive links to one or more categories.   
Author: Rob Schlüter
Author URI: http://kwebble.com/
Version: 1.4a

Copyright
=========
Copyright 2007, 2008, 2009 Rob Schlüter. All rights reserved.

Licensing terms
===============
- You may use, change and redistribute this software provided the copyright notice above is included. 
- This software is provided without warranty, you use it at your own risk. 
*/
function kwebble_getarchives_where_for_category($where, $args){
	global $kwebble_getarchives_data, $wpdb;

	if (isset($args['cat'])){
		// Preserve the category for later use.
		$kwebble_getarchives_data['cat'] = $args['cat'];

		// Split 'cat' parameter in categories to include and exclude.
		$allCategories = explode(',', $args['cat']);

		// Element 0 = included, 1 = excluded.
		$categories = array(array(), array());
		foreach ($allCategories as $cat) {
			if (strpos($cat, ' ') !== FALSE) {
				// Multi category selection.
			}
			$idx = $cat < 0 ? 1 : 0;
			$categories[$idx][] = abs($cat);
		}

		$includedCatgories = implode(',', $categories[0]);
		$excludedCatgories = implode(',', $categories[1]);

		// Add SQL to perform selection.
		if (get_bloginfo('version') < 2.3){
			$where .= " AND $wpdb->posts.ID IN (SELECT DISTINCT ID FROM $wpdb->posts JOIN $wpdb->post2cat post2cat ON post2cat.post_id=ID";

			if (!empty($includedCatgories)) {
				$where .= " AND post2cat.category_id IN ($includedCatgories)";
			}
			if (!empty($excludedCatgories)) {
				$where .= " AND post2cat.category_id NOT IN ($excludedCatgories)";
			}

			$where .= ')';
		} else{
			$where .= ' AND ' . $wpdb->prefix . 'posts.ID IN (SELECT DISTINCT ID FROM ' . $wpdb->prefix . 'posts'
					. ' JOIN ' . $wpdb->prefix . 'term_relationships term_relationships ON term_relationships.object_id = ' . $wpdb->prefix . 'posts.ID'
					. ' JOIN ' . $wpdb->prefix . 'term_taxonomy term_taxonomy ON term_taxonomy.term_taxonomy_id = term_relationships.term_taxonomy_id'
					. ' WHERE term_taxonomy.taxonomy = \'category\'';
			if (!empty($includedCatgories)) {
				$where .= " AND term_taxonomy.term_id IN ($includedCatgories)";
			}
			if (!empty($excludedCatgories)) {
				$where .= " AND term_taxonomy.term_id NOT IN ($excludedCatgories)";
			}

			$where .= ')';
		}
	}

	return $where;
}

 /* Changes the archive link to include the categories from the 'cat' parameter.
 */
function kwebble_archive_link_for_category($url){
	global $kwebble_getarchives_data;

	if (isset($kwebble_getarchives_data['cat'])){
		$url .= strpos($url, '?') === false ? '?' : '&';
		$url .= 'cat=' . $kwebble_getarchives_data['cat'];

		// Remove cat parameter so it's not automatically used in all following archive lists.
		unset($kwebble_getarchives_data['cat']);
	}

	return $url;
}

/*
 * Add the filters.
 */

// Prevent error if executed outside WordPress.
if (function_exists('add_filter')){
	// Constants for form field and options.
	define('KWEBBLE_OPTION_DISABLE_CANONICAL_URLS', 'kwebble_disable_canonical_urls');
	define('KWEBBLE_GETARCHIVES_FORM_CANONICAL_URLS', 'kwebble_disable_canonical_urls');
	define('KWEBBLE_ENABLED', '');
	define('KWEBBLE_DISABLED', 'Y');

	add_filter('getarchives_where', 'kwebble_getarchives_where_for_category', 10, 2);

//comment out adding of ?cat=-1,-10,20 etc.. to archive page permanent links
//fixed on version 2.6.7 dev 1

//	add_filter('year_link', 'kwebble_archive_link_for_category');
//	add_filter('month_link', 'kwebble_archive_link_for_category');
//	add_filter('day_link', 'kwebble_archive_link_for_category');

	// Disable canonical URLs if the option is set.
	if (get_option(KWEBBLE_OPTION_DISABLE_CANONICAL_URLS) == KWEBBLE_DISABLED){
		remove_filter('template_redirect', 'redirect_canonical');
	}
}
?>