<?php
/* 
Plugin Name: Assassin Custom User Profile
Description: Adds extra user fields for assassin (killcode & score) and hides unused fields (website, bio, etc.)
Author:		 Paul Salessi
*/

// 1. Add killcode & score fields
// Only admins can edit the fields
add_action( 'show_user_profile', 'assassin_extra_profile_fields' );
add_action( 'edit_user_profile', 'assassin_extra_profile_fields' );
function assassin_extra_profile_fields( $user ) { 
	$disable_input = 'disabled="disabled"';
	if ( current_user_can( 'create_users', $user->ID ) ) {
		$disable_input = '';
	}
	?>

	<h3>Assassins Info</h3>

	<table class="form-table">

		<tr>
			<th><label for="killcode">Kill Code</label></th>

			<td>
				<input type="text" name="killcode" id="killcode" value="<?php echo esc_attr( get_the_author_meta( 'killcode', $user->ID ) ); ?>" class="regular-text" <?php echo $disable_input ?> /><br />
				<span class="description">This is your kill code. Give it to the person who kills you. It resets after each death!</span>
			</td>
		</tr>
		
		<tr>
			<th><label for="score">Score</label></th>

			<td>
				<input type="text" name="score" id="score" value="<?php echo esc_attr( get_the_author_meta( 'score', $user->ID ) ); ?>" class="regular-text" <?php echo $disable_input ?> /><br />
				<span class="description">This is your score. It goes up each time you get a kill!</span>
			</td>
		</tr>

	</table>
	<?php 
} // end assassin_extra_profile_fields

// 2. Save changes to the assassin fields
// Only admins can update the fields
add_action( 'personal_options_update', 'assassin_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'assassin_save_extra_profile_fields' );
function assassin_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'create_users', $user_id ) )
		return false;

	update_user_meta( $user_id, 'killcode', $_POST['killcode'] );
	update_user_meta( $user_id, 'score', $_POST['score'] );
} // end assassin_save_extra_profile_fields

// 3. Hide unused user profile fields
// Note: If someone has Javascript disabled, this won't work, but it's okay if the fields ultimately show
add_action( 'show_user_profile', 'assassin_hide_fields' );
add_action( 'edit_user_profile', 'assassin_hide_fields' );
function assassin_hide_fields( $user ) {
	?>
	<script type="text/javascript">
		var fields_to_remove = [
			".show-admin-bar",
			".user-nickname-wrap",
			".user-display-name-wrap",
			".user-url-wrap",
			".user-description-wrap"
		];
		jQuery(document).ready(function( $ ){
			$.each(fields_to_remove, function ( i, selector) {
				$(selector).hide();
			});
		});
	</script>
	<?php
} // end assassin_hide_fields