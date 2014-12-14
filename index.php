<?php

/*
Plugin Name: Get Avatar URL
Plugin URI: https://github.com/faizan1041/get-avatar-url
Description: get_avatar returns image, get_avatar_url will give you the image src.
Author: Faizan Ali
Version: 1.0
Author URI: https://github.com/faizan1041/
*/



function get_avatar_url($user_id, $size) {
    $avatar_url = get_avatar($user_id, $size);
    $doc = new DOMDocument();
    $doc->loadHTML($avatar_url);
    $xpath = new DOMXPath($doc);
    $src = $xpath->evaluate("string(//img/@src)");
    return $src;
}


function sc_get_avatar_url( $atts ) {
	$atts = shortcode_atts( array(
		'email' => '',
		'size' => 150
	), $atts, 'avatar_url' );

	return get_avatar_url($atts['email'],$atts['size']);
}
add_shortcode( 'avatar_url', 'sc_get_avatar_url' );
