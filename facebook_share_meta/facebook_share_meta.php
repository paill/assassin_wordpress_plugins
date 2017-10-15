<?php
/* 
Plugin Name: Facebook Share Meta 
Description: Add image and description metadata for Facebook sharing
Author:		 Paul Salessi
Plugin URI: https://github.com/psalessi/assassin_wordpress_plugins

Copyright 2017 Paul Salessi

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

add_action('wp_head','facebook_meta_content');
function facebook_meta_content() {
	$fb_meta = '<meta property="og:title" content="Davis Nerf Club">';
	$fb_meta .= '<meta property="og:description" content="DaNC is a UC Davis club that plays Nerf in the Deathstar every Saturday!">';
	$fb_meta .= '<meta property="og:image" content="http://i.imgur.com/OjNrrOJ.jpg">';
	$fb_meta .= '<meta property="og:image:secure_url" content="https://i.imgur.com/OjNrrOJ.jpg">';
	$fb_meta .= '<meta property="og:image:type" content="image/png">';
	$fb_meta .= '<meta property="og:image:width" content="1200">';
	$fb_meta .= '<meta property="og:image:height" content="480">';
	echo $fb_meta;
}