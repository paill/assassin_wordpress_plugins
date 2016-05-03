<?php
/* 
Plugin Name: Assassin Leaderboard
Description: List all players with shortcode [assassin-leaderboard]
Author:		 Paul Salessi
*/

// 1. Add DataTables script tags to page header
add_action('wp_head','include_datatables');
function include_datatables() {
	$datatables = '<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">';
	$datatables .= '<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>';
	echo $datatables;
}

// 2. Add assassin-leaderboard shortcode and construct HTML user table
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

// 3. Create DataTables Javascript object