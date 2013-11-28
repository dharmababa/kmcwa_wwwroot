<?php get_header(); ?>
</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<div id="main">
<?php
global $ttso;
$ka_404title = stripslashes($ttso->ka_404title);
$ka_404message = stripslashes($ttso->ka_404message);
?>
<?php get_template_part('theme-template-part-tools','childtheme'); ?>

<div class="main-holder">
<div id="content" class="content_full_width">
<div class="four_error">
<div class="four_message">
<h1 class="four_o_four"><?php echo $ka_404title;?></h1>
<?php echo $ka_404message;?>
</div><!-- end four_message -->
</div><!-- end four_error -->

</div><!-- end content -->
</div><!-- end main-holder -->
</div><!-- main-area -->

<?php get_footer(); ?>