<?php
/* 
Plugin Name: Assassin Login Page
Description: Adds custom CSS to login page and all variants (forgot-password & register)
Author:		 Paul Salessi
Plugin URI: https://github.com/psalessi/assassin_wordpress_plugins

Copyright 2017 Paul Salessi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

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