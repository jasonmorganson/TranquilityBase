<?php

global $themename;
global $shortname;


/* Add extra header options to parse from the theme header */
function add_extra_theme_headers( $extra_headers ) {
	$extra_headers[] = 'Shortname';
	$extra_headers[] = 'Textdomain';
	return $extra_headers;
}

add_filter( 'extra_theme_headers', 'add_extra_theme_headers' );


/* Get the current themes header options */
function themeinfo( $arg ) {

	$theme_data = get_theme_data( get_bloginfo( 'stylesheet_url' ) );

	return $theme_data[$arg];
}


$themename = themeinfo( 'Name' );
$shortname = themeinfo( 'Shortname' );

?>