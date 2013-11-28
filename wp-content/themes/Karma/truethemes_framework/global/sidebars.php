<?php
function karma_widgets_init() {
register_sidebar( array(
'name' => 'Toolbar - Left Side',
'description' => 'Easily assign a menu to this region by clicking on Appearance > Menus.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
));

register_sidebar( array(
'name' => 'Toolbar - Right Side',
'description' => 'This region is located on the right side above the main navigation',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
));

register_sidebar( array(
'name' => 'Blog Sidebar',
'description' => 'This sidebar is displayed on all Blog pages.',
'before_widget' => '<div class="sidebar-widget">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Search Results Sidebar',
'description' => 'This sidebar is displayed on the Search Results page.',
'before_widget' => '<div class="sidebar-widget">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Contact Sidebar (iPhone)',
'description' => 'This sidebar is displayed within the iPhone screen on the Contact page.',
'before_widget' => '<div class="sidebar-widget sidebar-smartphone">',
'after_widget' => '</div>',
'before_title' => '<h4 class="smartphone-header">',
'after_title' => '</h4>',
));

register_sidebar( array(
'name' => 'First Footer Column',
'description' => 'First Footer Column.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Second Footer Column',
'description' => 'Second Footer Column.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Third Footer Column',
'description' => 'Third Footer Column.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Fourth Footer Column',
'description' => 'Fourth Footer Column.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Fifth Footer Column',
'description' => 'Fifth Footer Column.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'Sixth Footer Column',
'description' => 'Sixth Footer Column.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' =>  'Footer Copyright - Left Side',
'description' => 'This region is located on the left side below the footer. Use a text widget to enter your copyright info.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
));

register_sidebar( array(
'name' =>  'Footer Menu - Right Side',
'description' => 'Easily assign a menu to this region by clicking on Appearance > Menus.',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
));

// START Woo-check
if (class_exists('woocommerce')){
register_sidebar( array(
'name' => 'WooCommerce Sidebar',
'description' => 'This sidebar is displayed on your WooCommerce pages.',
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

register_sidebar( array(
'name' => 'WooCommerce - Cart + Checkout',
'description' => 'This sidebar is displayed on your WooCommerce Shopping Cart and Checkout pages.',
'before_widget' => '<div class="sidebar-widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h3>',
'after_title' => '</h3>',
));

} // END Woo-check

}
add_action( 'widgets_init', 'karma_widgets_init' );
?>