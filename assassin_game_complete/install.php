<?php
/*
Plugin Name: Assassin Game Complete Plugin
Description: Combines the all the Assassin plugins for easier install. Included plugins: Assassin Custom User Profile, Assassin Kill Feed, Assassin Leaderboard, Assassin Login Page, Assassin Register Page, Assassin Report Kills, Facebook Share Meta
Author: Paul Salessi
Plugin URI: https://github.com/psalessi/assassin_wordpress_plugins

Copyright 2017 Paul Salessi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

include dirname(__FILE__) . '/cup.php';
include dirname(__FILE__) . '/fsm.php';
include dirname(__FILE__) . '/kf.php';
include dirname(__FILE__) . '/lb.php';
include dirname(__FILE__) . '/lp.php';
include dirname(__FILE__) . '/rk.php';
include dirname(__FILE__) . '/rp.php';

// Create custom table for storing kill logs
function assassin_kills_install() {
	global $wpdb;

	$table_name = $wpdb->prefix . 'assassin_kill_logs';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time_of_kill datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		who_died mediumint(9) NOT NULL,
		killed_by mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
} // end assassin_kills_install
register_activation_hook( __FILE__, 'assassin_kills_install' );

function assassin_kills_uninstall() {	
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'assassin_kill_logs';

	$wpdb->query("DROP TABLE IF EXISTS $table_name");
} // end assassin_kills_uninstall
register_deactivation_hook( __FILE__, 'assassin_kills_uninstall' );