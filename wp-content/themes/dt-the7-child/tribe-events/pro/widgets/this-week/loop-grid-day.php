<?php
/**
 * This Week Day
 * This file loads the this week widget day
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/widgets/this-week/loop-grid-day.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} 

$date_format = 'l (n/j)'; // Monday (7/9)
?>
<div class="vc_tta-panel" id="header_<?php echo $day['date'] ?>" data-vc-content=".vc_tta-panel-body">
	<div class="vc_tta-panel-heading">
		<h4 class="vc_tta-panel-title vc_tta-controls-icon-position-right">
			<a href="#header_<?php echo $day['date'] ?>" data-vc-accordion="" data-vc-container=".vc_tta-container">
				<span class="vc_tta-title-text"><?php echo esc_html(strtoupper(tribe_format_date($day['date'], false, $date_format))); ?></span>
				<i class="vc_tta-controls-icon vc_tta-controls-icon-chevron"></i>
			</a>
		</h4>
	</div>
	<div class="vc_tta-panel-body">
		<div class="wpb_text_column wpb_content_element ">
			<div class="wpb_wrapper">
			<?php 
			if ( $day['has_events'] ) {
				foreach ( $day['this_week_events'] as $event ) {
					tribe_get_template_part( 'pro/widgets/this-week/single-event', 'single', array( 'event' => $event, 'day' => $day ) );
				}
			}
			else { ?>
				<p>No classes or events scheduled</p>
			<?php } //else ?>			
			</div>
		</div>
	</div>
</div>