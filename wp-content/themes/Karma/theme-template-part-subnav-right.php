<div id="sub_nav" class="nav_right_sub_nav">
            <?php 
             global $post;
  			 $post_id = $post->ID;
  			 $custom_menu_slug = get_post_meta($post_id,'truethemes_custom_sub_menu',true);
  			 	if(empty($custom_menu_slug)):
           			 wp_nav_menu(array('theme_location' => 'Primary Navigation' , 'depth' => 0 , 'container' =>false , 'walker' => new sub_nav_walker() ));
            	else:
            	     echo "<ul>";
           			 wp_nav_menu( array("container" => false, 'depth' => 0 , "menu" => "$custom_menu_slug", "walker" => ''));
           			 echo "</ul>"; 
            	endif;
            ?>
</div><!-- end sub_nav -->

<?php
function removeEmptyTags($html_replace)
{
$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
return preg_replace($pattern, '', $html_replace);
}
?>