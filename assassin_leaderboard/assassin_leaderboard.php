<?php
/* 
Plugin Name: Assassin Leaderboard
Description: List all players with shortcode [assassin-leaderboard]
Author:		 Paul Salessi
*/

// 1. Add assassin-leaderboard shortcode
// Going to use DataTables for this
function assassin_leaderboard( $atts ){
	$blogusers = get_users();
	// Array of WP_User objects.
	
	$blogusers_content = '';
	
	foreach ( $blogusers as $user ) {
		$blogusers_content .= '<span>' . esc_html( $user->user_email ) . '</span><br/>';
	}
	
	return $blogusers_content;
}
add_shortcode( 'assassin-leaderboard', 'assassin_leaderboard' );