<?php

//define variables
global $ttso;
$show_tools_panel = $ttso->ka_tools_panel;
$ka_searchbar = $ttso->ka_searchbar;
$ka_crumbs = $ttso->ka_crumbs;
$ka_404title = $ttso->ka_404title;
$ka_results_title = $ttso->ka_results_title;
$ka_search_perpage = get_post_meta($post->ID, 'banner_search', true);

//set to "yes" so > Karma 3.0 themes won't need to save page in order to show search
if ($ka_search_perpage == ""){$ka_search_perpage = "yes";};

?>
<div class="main-area<?php if($show_tools_panel == 'false') {echo ' utility-area';}?>">
<?php if($show_tools_panel != 'false'): ?>

<div class="tools">
<div class="holder">
<div class="frame">

<?php truethemes_before_article_title_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<?php if ( get_post_meta($post->ID, '_pagetitle_value', true) ) { ?>
<h1><?php echo get_post_meta($post->ID, "_pagetitle_value", $single = true); ?></h1><?php } else if (is_404()) { ?>
<h1><?php echo $ka_404title ?></h1> <?php } else if (is_search()) { ?>
<h1><?php echo $ka_results_title ?></h1> <?php } else { ?>
<h1><?php if(have_posts()) : while(have_posts()) : the_post(); ?><?php if(!is_attachment()){the_title();} ?><?php endwhile; endif; ?></h1><?php } ?>


<?php if (($ka_searchbar == "true") && ($ka_search_perpage == "yes")){get_template_part('searchform','childtheme');} ?>
<?php if ($ka_crumbs == "true"){ ?><?php $bc = new simple_breadcrumb; ?><?php } ?>

<?php truethemes_after_searchform_hook();// action hook, see truethemes_framework/global/hooks.php ?>

</div><!-- end frame -->
</div><!-- end holder -->
</div><!-- end tools -->
<?php endif; ?>