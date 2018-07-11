<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

/*
 * Adds start time to event titles in Month view
 */
function tribe_add_start_time_to_event_title ( $post_title, $post_id ) {
 
    if ( !tribe_is_event($post_id) ) return $post_title;
    // Checks if it is the month view, modify this line to apply to more views
    if ( !tribe_is_month() ) return $post_title;
 
    $event_start_time = tribe_get_start_time( $post_id );
 
    if ( !empty( $event_start_time ) ) {
        $post_title = $event_start_time . ' - ' . $post_title;
    }
 
    return $post_title;
}
add_filter( 'the_title', 'tribe_add_start_time_to_event_title', 100, 2 );

/* Sort Events in ascending start date. */

add_filter( 'posts_clauses', function( $pass, $query ) {
    if (is_admin() && !is_customize_preview()) {
        $screen = get_current_screen();

        if (
            ! $screen
            || Tribe__Main::instance()->doing_ajax()
            || 'edit' !== $screen->base
            || 'tribe_events' !== $screen->post_type
        ) {
            return $pass;
        }

        $query->set( 'order', 'ASC' );
        return $pass;
    }
    return $pass;
}, 10, 2 );

?>