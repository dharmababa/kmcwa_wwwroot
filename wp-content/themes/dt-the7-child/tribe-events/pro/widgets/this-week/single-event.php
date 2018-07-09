<?php
/**
 * This Week Single Event
 * This file loads the this week widget single event
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/pro/widgets/this-week/single-event.php
 *
 * @package TribeEventsCalendar
 *
 * @version 4.4.13
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} 
$time_format = 'g:ia'; // 3:00pm
$event_id = $event->ID;

// Set up the dates
$day_timestamp = strtotime($day['date']);
$event_start_date = tribe_get_start_date($event_id, false);
$event_end_date = tribe_get_end_date($event_id, false);
$event_start_date_timestamp = strtotime($event_start_date);
$event_end_date_timestamp = strtotime($event_end_date);

// If it's an all-day event, or starts before this day and ends after this day
if ((tribe_event_is_all_day($event_id)) || (($event_start_date_timestamp < $day_timestamp) && ($event_end_date_timestamp > $day_timestamp))) {
	$time_range = 'All-Day';
} else {
	// If it's all on one day, just show start and end times
	if ($event_start_date_timestamp == $event_end_date_timestamp) {
		$time_range = tribe_get_start_date( $event_id, true, $time_format ) . '-' . tribe_get_end_date( $event_id, true, $time_format );
	} else { 
		$time_range .= ($day_timestamp == $event_start_date_timestamp) ? tribe_get_start_date( $event_id, true, $time_format ) : '12:00am';
		$time_range .= '-';
		$time_range .= ($day_timestamp == $event_end_date_timestamp) ? tribe_get_end_date( $event_id, true, $time_format ) : '11:59pm';
	}
}

// Retrieve the event title
$event_title = html_entity_decode(get_the_title($event_id), ENT_QUOTES, 'UTF-8');

// Retrieve the website URL 
$event_website_url = tribe_get_event_website_url($event);

// Remove the subtitle if there is one
$hyphen_pos = strpos($event_title, ' - ');
if ($hyphen_pos === false) { // if not found, try emdash
	$hyphen_pos = strpos($event_title, ' – ');
}

if ($hyphen_pos !== false) 
	$event_title = substr($event_title, 0, $hyphen_pos);

// Construct the event to display - if there is a website, add the link.
$event_display_text = empty($event_website_url) ? $event_title : '<a href="' . $event_website_url . '">' . $event_title . '</a>';
?>
<p style="margin-bottom: 10px;">
	<strong><?php echo $time_range; ?><br></strong>
	<?php echo $event_display_text; ?>
</p>