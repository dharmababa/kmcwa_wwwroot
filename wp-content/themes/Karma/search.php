<?php get_header(); ?>
</div><!-- header-area -->
</div><!-- end rays -->
</div><!-- end header-holder -->
</div><!-- end header -->

<?php truethemes_before_main_hook();// action hook, see truethemes_framework/global/hooks.php ?>

<div id="main">
<?php
global $ttso;
$ka_results_fallback = $ttso->ka_results_fallback;
?>

<?php get_template_part('theme-template-part-tools','childtheme'); ?>

<div class="main-holder">

<div id="content">
<h2 class="search-title"><?php _e('Search Results for','truethemes_localize');//@since 3.0.3. make this translatable ?> "<?php the_search_query(); ?>"</h2><br />
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<ul class="search-list">
<li><strong><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></strong><br />
<?php
ob_start();
the_content();
$old_content = ob_get_clean();
$new_content = strip_tags($old_content);
echo substr($new_content,0,300).'...';
?>
</li>
</ul>

<?php endwhile; else: ?>
<?php echo $ka_results_fallback; ?>
<?php endif; ?>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</div><!-- end content -->

<div id="sidebar" class="right_sidebar">
<?php dynamic_sidebar("Search Results Sidebar"); ?>
</div><!-- end sidebar -->
</div><!-- end main-holder -->
</div><!-- main-area -->

<?php get_footer(); ?>