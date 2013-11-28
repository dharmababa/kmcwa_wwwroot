<?php 
global $ttso;

//breadrcumbs
$woocommerce_breadcrumbs = $ttso->ka_woocommerce_breadcrumbs;

//searchbar
$woocommerce_searchbar = $ttso->ka_woocommerce_searchbar;

//banner title
$woocommerce_title = $ttso->ka_woocommerce_title;

//tools panel
$show_tools_panel = $ttso->ka_tools_panel;
?>

<div class="main-area<?php if($show_tools_panel == 'false') {echo ' utility-area';}?>">
<?php
//set to "yes" so > Karma 3.0 themes won't need to save page in order to show search
if ($ka_search_perpage == ""){$ka_search_perpage = "yes";}; if($show_tools_panel != 'false'):?>

<div class="tools">
<div class="holder">
<div class="frame">

<?php truethemes_before_article_title_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<h1><?php echo $woocommerce_title; ?></h1>
<?php if ($woocommerce_searchbar == "true"){get_template_part('searchform','childtheme');} ?>
<?php if ($woocommerce_breadcrumbs == "true"){ ?><p class="breadcrumb"><?php tt_woo_breadcrumbs(); ?></p><?php } ?>

<?php truethemes_after_searchform_hook();// action hook, see truethemes_framework/global/hooks.php ?>

</div><!-- end frame -->
</div><!-- end holder -->
</div><!-- end tools -->
<?php endif; ?>