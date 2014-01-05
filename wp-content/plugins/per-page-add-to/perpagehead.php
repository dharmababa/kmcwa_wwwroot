<?php

/*
Plugin Name: Per page head
Plugin URI: http://www.evona.nl/plugins/per-page-head
Description: Allows you to add content into the &lt;head&gt; section for a specific page, like custom JS or custom HTML, using post meta. Also allows you to add content for every page, under Settings -> add &lt;head&gt; to every page
Version: 1.0
Author: Erik von Asmuth
Author URI: http://evona.nl/over-mij/ (Dutch)
License: GPLv2
*/

//Add the meta box
function perpageathaddbox() {
    $screens = array( 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box( 'per-page-ath', 'Add to head', 'athcallback', $screen, 'normal',
         'default', null );
    }
}

add_action( 'add_meta_boxes', 'perpageathaddbox' );

function athcallback($post){
	
  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'athcallback', 'athcontent' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, 'per-page-ath-content', true );

  echo '<label for="per-page-ath">';
       _e( "Put your head html here", 'per-page-ath' );
  echo '</label><br/> ';
  echo '<textarea id="perpageathtextbox" style="width:100%; min-height:120px; white-space: pre-wrap;" name="per-page-ath">'.str_replace('%BREAK%', "\n",stripslashes_deep(esc_attr($value))).'</textarea>';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function perpageath_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['athcontent'] ) )
    return $post_id;

  $nonce = $_POST['athcontent'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'athcallback' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $mydata = esc_sql( str_replace(array("\r\n", "\r", "\n"), '%BREAK%',$_POST['per-page-ath']) );

  // Update the meta field in the database.
  update_post_meta( $post_id, 'per-page-ath-content', $mydata );
}
add_action( 'save_post', 'perpageath_save_postdata' );
//Now that's done. Let's add the meta field to the head

function perpageath_display(){
	$pageid = get_queried_object_id();
	$addtoheadcontent = get_post_meta( $pageid, 'per-page-ath-content', true );
	if(!empty($addtoheadcontent)){
		echo str_replace('%BREAK%', "\n", stripslashes_deep($addtoheadcontent));
	}
	$htmlfile = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'evonapluginconfig'.DIRECTORY_SEPARATOR.'everyheadpage.html';
	if(file_exists($htmlfile)&& filesize($htmlfile) > 0){
		if($htmlhandle = fopen($htmlfile, 'r')){
			$html = fread($htmlhandle, filesize($htmlfile));
		  	fclose($htmlhandle);
			echo $html;
		 }else{
			 echo "<!-- Error reading ".$htmlfile."! Is the file readable? -->";
		 }
	}
}
add_action('wp_head', 'perpageath_display');

//Create a menu
//Load in the option page
function EvonaCreateATHMenu() {
	add_options_page( 'Add &lt;head&gt; to every page', 'Add &lt;head&gt; to every page', 'manage_options', 'perpageath-every-page', 'PerPageATHSettings' );
}

function PerPageATHSettings(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'settings.php');
	perpageath_config();
}

//Create the option menu, and load admin CSS to it
add_action( 'admin_menu', 'EvonaCreateATHMenu' );

//Installation
function PerPageATHInstallStep1(){
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'installdeinstall.php');
	PerPageATHInstallStep2();	
}
register_activation_hook( __FILE__, 'PerPageATHInstallStep1');
//Deinstallation
function PerPageATHDeinstallStep1(){
	include_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'installdeinstall.php');
	PerPageATHDeinstallStep2();	
}
register_uninstall_hook( __FILE__, 'PerPageATHDeinstallStep1');
?>
