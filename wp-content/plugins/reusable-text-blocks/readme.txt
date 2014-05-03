=== Reusable Text Blocks ===
Contributors: halgatewood
Donate link: http://halgatewood.com/text-blocks/
Tags: content, block, reusable content, reusable text, widget, shortcode
Requires at least: 3.5
Tested up to: 3.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create reusable pieces of content that you can insert into themes, posts, pages & widgets.

== Description ==

This plugin creates a new 'text-blocks' custom post type with it's own section in the WordPress admin sidebar. It uses the standard WordPress user interface so you and your clients will know how to use it instantly. 

You can add it to your site in three ways:

Widget: Included widget allows you to specify which block you want to insert. You can also include a title if needed.

Shortcode:
`[text-blocks id="1"] or [text-blocks id="text_block_slug"]`

PHP Function: A PHP function has been setup so you do not have to use the do_shortcode function. Go straight to the source with the following.

`<?php if(function_exists('show_text_block')) { echo show_text_block(421); } ?>`

or

`<?php if(function_exists('show_text_block')) { echo show_text_block('slug'); } ?>`


== Installation ==

1. Add plugin to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Create text blocks and include them in your site using one of the 3 methods below

You can add it to your site in three ways:

Widget: Included widget allows you to specify with block and insert a title if needed.

Shortcode:
`[text-blocks id="1"] or [text-blocks id="text_block_slug"]`

`[text-blocks id="1" plain=1] or [text-blocks id="text_block_slug"" plain=1]`

PHP Function: A PHP function has been setup so you do not have to use the do_shortcode function. Go straight to the source with the following.

`<?php if(function_exists('show_text_block')) { echo show_text_block(421); } ?>`

or

`<?php if(function_exists('show_text_block')) { echo show_text_block('slug'); } ?>`


== Screenshots ==

1. Text Blocks list view, with quick view of content and shortcode.
2. Uses standard WordPress functionality. No surprises, you already know how to use it.
3. Widget included

== Changelog ==

= 1.4.4 = 
* Fix for error if no content found

= 1.4.3 =
* Moved init into plugins_loaded
* WordPresss 3.8 testing and icon

= 1.4.2 =
* Post thumbnail support added.

= 1.4.1 =
* Added second parameter to keep out the_content filter and display exactly what is in the content.

= 1.4 =
* Display by slug (post_name) or id
* Slug class added to widget so you can target text-blocks easier with CSS

= 1.3 =
* Added ability to set wpautop in widget
* Also added filter to target widget code: 'text_blocks_widget_html'

= 1.2 =
* Bug in widget select box (Thanks Shaun Forsyth)

= 1.1 =
* Small bug fixes

= 1.0 =
* Initial load of the plugin.

