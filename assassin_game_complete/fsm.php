<?php

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