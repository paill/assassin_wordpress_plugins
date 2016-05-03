<?php
/* 
Plugin Name: Assassin Kill Feed
Description: List assassinations in descending time using the shortcode [assassin-kill-feed].
Author:		 Paul Salessi
*/

// 1. Add assassin-kill-feed and construct kill feed table
function assassin_kill_feed( $atts ) {
	
	$a = shortcode_atts( array(
        'n' => 0
    ), $atts );
	
	$limit = '';
	
	if ( $a["n"] ) {
		$limit = " LIMIT " . $a["n"];
	}
	
	global $wpdb;
	
	$kill_logs = $wpdb->get_results( 'SELECT * FROM wp_assassin_kill_logs ORDER BY time_of_kill DESC' . $limit );

	$kill_list = "<ul>";
	
	if ( $kill_logs ) {
		foreach ( $kill_logs as $kill_log ) {
			$killer = get_user_by( 'ID', $kill_log->killed_by );
			$killee = get_user_by( 'ID', $kill_log->who_died );
			$kill_list .= '<li>';
			$kill_list .= $killer->first_name . ' ' . $killer->last_name;
			$kill_list .= ' killed ' . $killee->first_name . ' ' . $killee->last_name;
			$kill_list .= ' at ' . $kill_log->time_of_kill;
			$kill_list .= '</li>';
		}
	}
	$kill_list .= "</ul>";
	
	return $kill_list;
} // end assassin_kill_feed
add_shortcode( 'assassin-kill-feed', 'assassin_kill_feed' );
add_filter( 'widget_text', 'do_shortcode');