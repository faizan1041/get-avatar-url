<?php

/*
Plugin Name: Get Avatar URL
Plugin URI: https://github.com/faizan1041/get-avatar-url
Description: get_avatar returns image, get_avatar_url will give you the image src.
Author: Faizan Ali
Version: 1.0
Author URI: https://github.com/faizan1041/
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
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
