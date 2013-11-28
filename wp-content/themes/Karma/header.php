<!DOCTYPE HTML>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<?php truethemes_meta_hook();// action hook, see truethemes_framework/global/hooks.php ?>
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
<?php wp_head(); ?>
<!--[if lte IE 8]>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/truethemes_framework/js/respond.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/lt8.css" media="screen"/>
<![endif]-->
<?php get_template_part('theme-template-part-page-styling','childtheme'); ?>
</head>
<?php
// retrieve values from site options panel
global $ttso;
$ka_sitelogo = $ttso->ka_sitelogo;
$ka_logo_icon = $ttso->ka_logo_icon;
$ka_logo_text = $ttso->ka_logo_text;
$ka_toolbar = $ttso->ka_toolbar;
$boxedlayout = $ttso->ka_boxedlayout;
?>
<body <?php body_class(); ?>>
<?php if ( 'true' == $boxedlayout ) {echo '<div id="tt-boxed-layout">';}else{echo '<div id="tt-wide-layout">';} ?>
<div id="wrapper" <?php if (is_page_template('template-homepage-3D.php') || is_page_template('template-homepage-jquery-2.php')) {echo 'class="big-banner"';} ?>>
<div id="header" <?php if (is_page_template('template-homepage-3D.php')){echo "style='height: 560px;'";} ?>>
<?php 
// show the toolbar if selected by the user :
if ($ka_toolbar == "true"): 
?>
<div class="top-block">
<div class="top-holder">

  <?php truethemes_before_top_toolbar_menu_hook();// action hook, see truethemes_framework/global/hooks.php ?>
  <?php if(has_nav_menu('Top Toolbar Navigation')): ?>
  <div class="toolbar-left">  
  <ul>
  <?php wp_nav_menu(array('theme_location' => 'Top Toolbar Navigation' , 'depth' => 0 , 'container' =>false )); ?>
  </ul>
  </div><!-- end toolbar-left -->

  <?php
  //if top toolbar menu not set, we show dynamic sidebar  
  elseif(is_active_sidebar(1)): 
  ?>
  <div class="toolbar-left">  
  <ul><?php dynamic_sidebar("Toolbar - Left Side"); ?></ul>
  </div><!-- end toolbar-left -->
  <?php endif; ?>
  
  <?php if(is_active_sidebar(2)): ?>
  <div class="toolbar-right">
  <?php dynamic_sidebar("Toolbar - Right Side"); ?>
  </div><!-- end toolbar-right -->
  <?php endif; ?>

<?php truethemes_after_top_toolbar_menu_hook();// action hook, see truethemes_framework/global/hooks.php ?>
</div><!-- end top-holder -->
</div><!-- end top-block -->
<?php endif; //end if($toolbar == 'true') ?>


<?php truethemes_before_header_holder_hook();// action hook, see truethemes_framework/global/hooks.php ?>
<div class="header-holder">
<div class="rays">
<div class="header-area<?php if (is_search()) {echo ' search-header';} ?><?php if (is_404()) {echo ' error-header';} ?><?php if (is_page_template('template_sitemap.php')) {echo ' search-header';} ?>">

<?php // Website Logo
if ($ka_logo_text == ''){
?>
<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo $ka_sitelogo; ?>" alt="<?php bloginfo('name'); ?>" /></a>
<?php }else{?>
<a href="<?php echo home_url(); ?>" class="custom-logo"><img src="<?php echo get_template_directory_uri(); ?>/images/_global/<?php echo $ka_logo_icon; ?>" alt="<?php bloginfo('name'); ?>" /><span class="logo-text"><?php echo $ka_logo_text; echo '</span></a>';}?>

<?php truethemes_before_primary_navigation_hook();// action hook, see truethemes_framework/global/hooks.php ?>
<?php if(has_nav_menu('Primary Navigation')): ?>
<nav>
<ul id="menu-main-nav">
<?php wp_nav_menu(array('theme_location' => 'Primary Navigation' , 'depth' => 0 , 'container' =>false , 'walker' => new description_walker() )); ?>
</ul>
</nav>
<?php endif; ?>

<?php truethemes_after_primary_navigation_hook();// action hook, see truethemes_framework/global/hooks.php ?>