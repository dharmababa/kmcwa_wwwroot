<?php
function truethemes_manage_javascripts_scripts(){

if (!is_admin()){
/*-----------------------------------------------------------------*/
/* Deregister Scripts
/*-----------------------------------------------------------------*/
wp_deregister_script('comment-reply');


/*-----------------------------------------------------------------*/
/* Register Scripts
/*-----------------------------------------------------------------*/
wp_register_script( 'truethemes-custom', TRUETHEMES_JS .'/truethemes.js', array('jquery'),'2.0',$in_footer = true);
wp_register_script( 'jquery-cycle-all', TRUETHEMES_JS .'/jquery.cycle.all.min.js', array('jquery'),'2.9.4',$in_footer = true);

//@since 3.0.3 modified by denzel, updated with jQuery ui 1.9.2, includes core, widget, tabs, and accordion.
//so that our theme does not break third party jQuery plugin, not sure why but we should have just load WordPress included copy.
wp_register_script( 'jquery-ui', TRUETHEMES_JS .'/jquery-ui-1.9.2.custom.min.js', array('jquery'),'1.9.2',$in_footer = true);
wp_register_script( 'pretty-photo', TRUETHEMES_JS .'/jquery.prettyPhoto.js', array('jquery'),'1.0',$in_footer = true);
wp_register_script( 'comment-reply', site_url().'/wp-includes/js/comment-reply.js',$deps=null,'1.0',$in_footer = true);
wp_register_script( 'superfish', TRUETHEMES_JS .'/superfish.js', array('jquery'),'1.0',$in_footer = true);
wp_register_script( 'hoverintent', TRUETHEMES_JS .'/hoverIntent.js', array('jquery'),'1.0',$in_footer = true);
wp_register_script( 'bitly-api','http://bit.ly/javascript-api.js?version=latest&login=scaron&apiKey=R_6d2a7b26f3f521e79060a081e248770a', array('jquery'),'',$in_footer = true);
wp_register_script( 'pretty-sociable', TRUETHEMES_JS .'/jquery.prettySociable.js', array('jquery'),'2.9.4',$in_footer = true);


/*-----------------------------------------------------------------*/
/* Enqueue Scripts
/*-----------------------------------------------------------------*/
wp_enqueue_script('jquery');
wp_enqueue_script( 'truethemes-custom');
wp_enqueue_script( 'jquery-cycle-all');
wp_enqueue_script( 'jquery-ui');
wp_enqueue_script( 'pretty-photo');		
wp_enqueue_script( 'comment-reply');
wp_enqueue_script( 'superfish');
wp_enqueue_script( 'hoverintent');


/*-----------------------------------------------------------------*/
/* WooCommerce Custom Enqueue
/*-----------------------------------------------------------------*/
//check for plugin
if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )){

//de-regsiter unnecessary scripts
wp_deregister_script('comment-reply');
wp_deregister_script('jquery-easing');

//regsiter and enqueue scripts
wp_register_script('truethemes-woocommerce', TRUETHEMES_JS .'/custom-woocommerce.js', array('jquery'), '',$in_footer = true);
wp_enqueue_script('truethemes-woocommerce');
}
		
		
		
global $ttso;
$dragshare = $ttso->ka_dragshare;
//check whether user enable dragshare.
if($dragshare == "true"):

//load prettySociable only in..
if(is_single()||is_home()||is_archive()||is_category()||is_tag()||is_author()):

//Bitly API script for prettySociable directly from http://bit.ly
wp_enqueue_script( 'bitly-api','http://bit.ly/javascript-api.js?version=latest&login=scaron&apiKey=R_6d2a7b26f3f521e79060a081e248770a', array('jquery'),'1.0',$in_footer = true);

//prettySociable
//init scripts within end of file
wp_enqueue_script( 'pretty-sociable', TRUETHEMES_JS .'/jquery.prettySociable.js', array('jquery'),'1.2.1',$in_footer = true);		
add_action('wp_footer','truethemes_hook_footer_scripts');			

endif;// if_single() is_home check. 
endif;// if($dragshare)		

}
}


//hook in last, so that plugins cannot change this? Maybe.
//hook in template redirect instead of init so that is_single() conditional tags works.
add_action('template_redirect', 'truethemes_manage_javascripts_scripts',90);


/*
* Function to hook in jQuery init scripts for jQuery sliders into wp_footer() in footer.php
* Includes conditions for Template homepage jQuery, Template homepage JQuery 2, Testimonial slider, and prettySociable..
* @since version 2.6
* PHP files namely, jquery-cycle-2.php, jquery-cycle.php, juery-testimonials.php, jquery-siders.php has been deleted, all codes combined into following function.
*
*/
function truethemes_hook_footer_scripts(){

	//get option values
    global $ttso;
	$jcycle_timeout = $ttso->ka_jcycle_timeout; // jQuery banner cycle time
	$jcycle_pause_hover = $ttso->ka_jcycle_pause_hover; //whether pause on hover.

	if ($jcycle_pause_hover == "true"){
		$jcycle_pause_hover_results = '1';
	}else{
		$jcycle_pause_hover_results = '';
	}


//init slider if is Template Homepage :: jQuery 2
if(is_page_template('template-homepage-jquery-2.php')){

echo "<!-- jQuery Banner Init Script for Template Homepage :: jQuery 2 -->\n";	
echo "<script type='text/javascript'>\n";
echo "//<![CDATA[
jQuery(window).load(function(){
	jQuery('.home-banner-wrap ul').css('background-image','none');
	jQuery('.jqslider').css('display','block');
	jQuery('.big-banner #main .main-area').css('padding-top','16px');
    	jQuery('.home-banner-wrap ul').after('<div class=\"jquery-pager\">&nbsp;</div>').cycle({
		fx: 'fade',
		timeout: '{$jcycle_timeout}',
		height: 'auto',
		pause: '{$jcycle_pause_hover_results}',
		pager: '.jquery-pager',
		cleartypeNoBg: true

	});
});
//]]>\n";
echo "</script>\n";
}

//init slider if is Template Homepage :: jQuery
if(is_page_template('template-homepage-jquery.php')){

echo "<!-- jQuery Banner Init Script for Template Homepage :: jQuery -->\n";	
echo "<script type='text/javascript'>\n";
echo "//<![CDATA[
jQuery(window).load(function(){
	jQuery('.home-bnr-jquery ul').css('background-image','none');
	jQuery('.jqslider').css('display','block');
        jQuery('.home-bnr-jquery ul').after('<div class=\"jquery-pager\">&nbsp;</div>').cycle({
		fx: 'fade',
		timeout: '{$jcycle_timeout}',
		height: 'auto',
		pause: '{$jcycle_pause_hover_results}',
		pager: '.jquery-pager',
		cleartypeNoBg: true
		});
});
//]]>
</script>\n";	
}

//Testimonial init script
global $ttso;
$testimonial_enable = $ttso->ka_testimonial_enable;

if($testimonial_enable == "true"){
$testimonial_timeout = $ttso->ka_testimonial_timeout;
$testimonial_pause_hover = $ttso->ka_testimonial_pause_hover;
	if ($testimonial_pause_hover == "true"){
		$testimonial_pause_hover_results = '1';
	}else{
	$testimonial_pause_hover_results = '0';
	}

echo "<!-- Testimonial init script -->\n";
echo "<script type='text/javascript'>
//<![CDATA[
jQuery(document).ready(function(){
	function adjust_container_height(){
		//get the height of the current testimonial slide
		var hegt = jQuery(this).height();
		//set the container's height to that of the current slide
		jQuery(this).parent().animate({height:hegt});
	}
    jQuery('.testimonials').after('<div class=\"testimonial-pager\">&nbsp;</div>').cycle({
		fx: 'fade',
		timeout: '{$testimonial_timeout}',
		height: 'auto',
		pause: '{$testimonial_pause_hover_results}',
		pager: '.testimonial-pager',
		before: adjust_container_height,
		cleartypeNoBg: true

	});
});

//]]>
</script>\n";
}					
}
add_action('wp_footer','truethemes_hook_footer_scripts');
?>