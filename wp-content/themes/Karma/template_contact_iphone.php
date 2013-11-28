<?php
/*
Template Name: Contact (iPhone)
*/
?>
<?php get_header(); ?>
</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<div id="main">

<?php get_template_part('theme-template-part-tools','childtheme'); ?>

<div class="main-holder">
<div id="content" class="content_full_width contact_smartphone_content">
<div class="two_thirds">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
comments_template('/page-comments.php', true);
get_template_part('theme-template-part-inline-editing','childtheme'); ?>
</div><!-- end two_thirds -->


<div class="one_third_last contact_smartphone">
<div class="smartphone-wrap">
<?php dynamic_sidebar("Contact Sidebar (iPhone)"); ?>
</div><!-- end smartphone-wrap -->
</div><!-- end one_third_last -->
<br class="clear" />
</div><!-- end content -->
</div><!-- end main-holder -->
</div><!-- main-area -->

<?php get_footer(); ?>