<?php
/* 
Plugin Name: Assassin Report Kills
Description: Adds Dashboard page for submitting killcodes. A kill increases the submitters score and resets the killed user's killcode
Author:		 Paul Salessi
*/

// 1. Create custom table for storing kill logs
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
}
register_activation_hook( __FILE__, 'assassin_kills_install' );

// 2. Register new menu page for reporting kills	
function register_kill_report_menu_page() {
    add_menu_page(
        __( 'Report an Assassination', 'default' ),
        __( 'Report an Assassination', 'default' ),
        'read',
        'report-kill',
        'report_kill_form_page',
        'dashicons-forms'
    );
} // end register_kill_report_menu_page
add_action( 'admin_menu', 'register_kill_report_menu_page' );

// 3. Create form for report kill codes and update on valid codes
function report_kill_form_page() {
	global $wpdb;
	
    $hidden_field_name = 'hidden_kill';

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $submitted_code = $_POST[ 'killcode' ];

        // Check if valid code
		$args = array(  
			'meta_key'     => 'killcode',
			'meta_value'   => $submitted_code,
		);
		
		$killed_user = get_users( $args );
		
		$size_of_killed_users = count( $killed_user );
		
		if ( $size_of_killed_users ) {
			$killed_user = $killed_user[0];
		}
		else {
			$killed_user = false;
		}
		
		$current_user = wp_get_current_user();
		
		if ( $killed_user  && $killed_user->ID != $current_user->ID) {
			
			update_user_meta( $current_user->ID, 'score', $current_user->score + 1 );
			
			$new_killcode = md5( uniqid( rand(), true ) );
			$new_killcode = substr( $new_killcode, 0, 8 );
			update_user_meta( $killed_user->ID, 'killcode', $new_killcode);
			
			// Insert kill into log table
			$table_name = $wpdb->prefix . 'assassin_kill_logs';

			$wpdb->insert( 
				$table_name, 
				array( 
					'time_of_kill' => current_time( 'mysql' ), 
					'who_died' => $killed_user->ID, 
					'killed_by' => $current_user->ID, 
				) 
			);
			
			?>
			<div class="notice notice-success"><p><strong><?php _e('Successful assassination of ' . $killed_user->first_name . ' ' . $killed_user->last_name . '!', 'default' ); ?></strong></p></div>
			<?php
		}
		else
		{
			?>
			<div class="notice notice-error"><p><strong><?php _e('Invalid code: ' . $submitted_code, 'default' ); ?></strong></p></div>
			<?php
		}
    }

    echo '<div class="wrap">';
    echo "<h2>" . __( 'Report an Assassination', 'default' ) . "</h2>";    
    ?>

	<form name="killform" method="post" action="">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

		<p><?php _e("Killcode of Target:", 'default' ); ?> 
		<input type="text" name="killcode" id="killcode" class="regular-text" size="20"/><br />
		<span class="description">Insert the killcode of a person you have assassinated!</span>
		</p><hr />

		<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Submit Code') ?>" />
		</p>

	</form>
	</div>

	<?php
}

// 4. Remove the table on plugin deactivation
function assassin_kills_uninstall() {	
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'assassin_kill_logs';

	$wpdb->query("DROP TABLE IF EXISTS $table_name");
}
register_deactivation_hook( __FILE__, 'assassin_kills_uninstall' );