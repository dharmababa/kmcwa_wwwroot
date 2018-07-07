<?php
/**
 * Events Pro List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is highly needed.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/widgets/list-widget.php
 *
 * When the template is loaded, the following vars are set:
 *
 * @version 4.4.21
 *
 * @var string $start
 * @var string $end
 * @var string $venue
 * @var string $street
 * @var string $city
 * @var string $state
 * @var string $province
 * @var string $zip
 * @var string $country
 * @var string $phone
 * @var string $cost
 * @var array  $instance
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Retrieves the posts used in the List Widget loop.
$posts = tribe_get_list_widget_events();

// The URL for this widget's "View More" link.
$link_to_all = tribe_events_get_list_widget_view_all_link( $instance );

// Check if any posts were found.
if ( isset( $posts ) && $posts ) :

	foreach ( $posts as $post ) :
		setup_postdata( $post );
		do_action( 'tribe_events_widget_list_inside_before_loop' );
		
		// Retrieve the post properties
		$event_title = the_title('', '', false);
		$event_website_url = tribe_get_event_website_url();

		//	 Fire an action before the list widget featured image
		do_action( 'tribe_events_list_widget_before_the_event_image' );

		
		// Get the thumbnail of  the featured image for the event
		$post_thumbnail = get_the_post_thumbnail( null, 'thumbnail', array('alt' => trim(strip_tags( $post->post_title ))));
?>
		<!-- Event -->
		<div class="wpb_column vc_column_container vc_col-sm-4">
			<div class="vc_column-inner vc_custom_1530050919953">
				<div class="wpb_wrapper">
					<div class="ult-content-box-container">
						<div class="ult-content-box" style="background-color: rgb(255, 255, 255); box-shadow: rgb(183, 183, 183) 2px 2px 5px 0px; border-style: solid; border-width: 20px; border-radius: 10px; border-color: rgb(255, 255, 255); transition: all 700ms ease; margin: 0px;"
							data-hover_box_shadow="none" data-bg="#ffffff" data-border_color="#ffffff" data-normal_margins="margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;">
							<div class="shortcode-single-image-wrap alignnone fadeIn animate-element  animation-triggered start-animation"
								style="margin-top:0px; margin-bottom:0px; margin-left:0px; margin-right:0px; width:234px;">
								<div class="shortcode-single-image">
									<div class="fancy-media-wrap" style="border-radius:10px;">
										<a href="<?php echo $event_website_url; ?>"
											class="rollover this-ready" style="border-radius:10px;" target="_blank">
											<?php echo $post_thumbnail; ?>
										</a>
									</div>
								</div>
							</div>
							<div class="vc_empty_space" style="height: 20px">
								<span class="vc_empty_space_inner"></span>
							</div>

							<div class="wpb_text_column wpb_content_element ">
								<div class="wpb_wrapper">
									<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
									<h4 style="text-align: center;"><?php echo $event_title ?></h4>
									<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
									<p>&nbsp;</p>
									<p style="text-align: center;">
										<strong>Saturday, July 7 – Sunday, July 8</strong>
									</p>
									<p style="text-align: center;">24-Hour Tara Chanting Retreat</p>

								</div>
							</div>
							<div class="vc_btn3-container  button-darkgreen vc_btn3-center">
								<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-outline vc_btn3-icon-left vc_btn3-color-green"
									href="<?php echo $event_website_url; ?>" target="_blank">
									<i class="vc_btn3-icon fa fa-info-circle"></i> Info &amp; Booking</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>    
		<?php do_action( 'tribe_events_widget_list_inside_after_loop' ) ?>

	<?php endforeach ?>

<?php
// No Events were found.
else:
?>
	<p><?php printf( __( 'There are no upcoming %s at this time.', 'tribe-events-calendar-pro' ), tribe_get_event_label_plural_lowercase() ); ?></p>
<?php
endif;

// Cleanup. Do not remove this.
wp_reset_postdata();
