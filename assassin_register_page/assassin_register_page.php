<?php
/* 
Plugin Name: Assassin Register Page
Description: Adds first name and last name as required fields for registration and initializes killcode and score 
Author:		 Paul Salessi
*/

// Code based on https://codex.wordpress.org/Customizing_the_Registration_Form#Example

// 1. Add new form elements for first and last name
add_action( 'register_form', 'add_first_last_name_to_registration_form' );
function add_first_last_name_to_registration_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
    $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : ''; 	
	?>
        <p>
            <label for="first_name"><?php _e( 'First Name', 'default' ) ?><br />
                <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
        </p>
		<p>
            <label for="last_name"><?php _e( 'Last Name', 'default' ) ?><br />
                <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
        </p>
        <?php
} // end add_first_last_name_to_registration_form

// 2. Add validation. In this case, we make sure first_name & last_name are required.
add_filter( 'registration_errors', 'first_last_name_registration_errors', 10, 3 );
function first_last_name_registration_errors( $errors, $sanitized_user_login, $user_email ) {
	
	if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
		$errors->add( 'first_name_error', __( '<strong>ERROR</strong>: You must include a first name.', 'default' ) );
	}

	if ( empty( $_POST['last_name'] ) || ! empty( $_POST['last_name'] ) && trim( $_POST['last_name'] ) == '' ) {
		$errors->add( 'last_name_error', __( '<strong>ERROR</strong>: You must include a last name.', 'default' ) );
	}
	
	return $errors;
} // end first_last_name_registration_errors

// 3. Save first and last name registration user meta. Also, initialize killcode and score
add_action( 'user_register', 'save_assassins_data_user_register' );
function save_assassins_data_user_register( $user_id ) {
	if ( ! empty( $_POST['first_name'] ) ) {
		update_user_meta( $user_id, 'first_name', trim( $_POST['first_name'] ) );
	}
	
	if ( ! empty( $_POST['last_name'] ) ) {
		update_user_meta( $user_id, 'last_name', trim( $_POST['last_name'] ) );
	}
	
	$killcode = md5( uniqid( rand(), true ) );
	$killcode = substr( $killcode, 0, 8 );
	
	update_user_meta( $user_id, 'killcode', $killcode );
	update_user_meta( $user_id, 'score', 0);
} // end first_last_name_user_register