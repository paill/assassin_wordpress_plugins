<?php

// Code based on https://codex.wordpress.org/Customizing_the_Login_Form

// 1. Update login logo
function dnc_logo() { 
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo plugins_url( 'images/dnc_avatar.png', __FILE__ ); ?>);
            padding-bottom: 30px;
			background-size: initial;
			width: initial;
        }
    </style>
<?php 
} // end dnc_logo
add_action( 'login_enqueue_scripts', 'dnc_logo' );

// 2. Probably add some style later"