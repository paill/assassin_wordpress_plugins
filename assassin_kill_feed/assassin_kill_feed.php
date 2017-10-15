<?php
/* 
Plugin Name: Assassin Kill Feed
Description: List assassinations in descending time using the shortcode [assassin-kill-feed].
Author:		 Paul Salessi
Plugin URI: https://github.com/psalessi/assassin_wordpress_plugins

Copyright 2017 Paul Salessi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
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
	$table_name = $wpdb->prefix . 'assassin_kill_logs';
	
	$kill_logs = $wpdb->get_results( 'SELECT * FROM ' . $table_name . ' ORDER BY time_of_kill DESC' . $limit );

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