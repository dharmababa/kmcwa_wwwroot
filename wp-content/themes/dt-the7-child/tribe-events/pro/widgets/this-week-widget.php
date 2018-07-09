<?php
/**
 * This Week Event Widget
 * This is the template for the output of the this week widget.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/widgets/this-week-widget.php
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
?>
<div class="vc_tta-container" data-vc-action="collapseAll">
    <div class="vc_general vc_tta vc_tta-accordion vc_tta-color-grey vc_tta-style-flat vc_tta-shape-square vc_tta-spacing-5 vc_tta-controls-align-left vc_tta-o-no-fill vc_tta-o-all-clickable">
        <div class="vc_tta-panels-container">
			<div class="vc_tta-panels">
<?php 
foreach ( $week_days as $day )
	tribe_get_template_part( 'pro/widgets/this-week/loop-grid-day', 'grid-day', array( 'day' => $day, 'this_week_template_vars' => $this_week_template_vars ) );
?>
			</div>
		</div>
	</div>
</div>