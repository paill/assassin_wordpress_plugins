<?php
/* 
Plugin Name: Assassin Login Page
Description: Adds custom CSS to login page and all variants (forgot-password & register)
Author:		 Paul Salessi
*/

// Update Login Page
// Code based on https://codex.wordpress.org/Customizing_the_Login_Form

// 1. Update login logo
function dnc_logo() { 
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo plugins_url( 'images/dnc_avatar.jpg', __FILE__ ); ?>);
            padding-bottom: 30px;
        }
    </style>
<?php 
} // end dnc_logo
add_action( 'login_enqueue_scripts', 'dnc_logo' );

// 2. Probably add some style later"
// end Update Login Page