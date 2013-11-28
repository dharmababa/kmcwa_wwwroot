<?php get_header(); ?>

<?php 
// check for WooCommerce. If true, load WooCommerce custom layout
if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )){ ?>


</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook(); //action hook ?>

<div id="main" class="tt-woocommerce">
<?php get_template_part('theme-template-part-tools-woocommerce','childtheme'); ?>


<div class="main-holder">
<div id="content">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
comments_template('/page-comments.php', true); ?>
</div><!-- end content -->


<div id="sidebar" class="right_sidebar">
<?php 
		if ( (is_cart() == "true") || (is_checkout() == "true") ) {
			dynamic_sidebar("WooCommerce - Cart + Checkout");
		} else {
			dynamic_sidebar("WooCommerce Sidebar");
		}
		?>
</div><!-- end sidebar -->
</div><!-- end main-holder -->
</div><!-- main-area -->
  
  
  <?php // ELSE load default layout
  } else { ?>
  
</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<div id="main">

<?php get_template_part('theme-template-part-tools','childtheme'); ?>

<div class="main-holder">
<div id="content" class="content_full_width">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
comments_template('/page-comments.php', true);
get_template_part('theme-template-part-inline-editing','childtheme'); ?>
</div><!-- end content -->
</div><!-- end main-holder -->
</div><!-- main-area -->
  
  
  <?php // END WooCommerce loop
  } ?>
    
<?php get_footer(); ?>