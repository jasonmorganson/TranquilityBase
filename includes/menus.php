<?php


function register_theme_menus() {

	if( function_exists( 'register_nav_menus' ) ) {
		
		register_nav_menus( array(
		  'Header' => '<b>Header</b>: Menus placed in this location will appear in the header',
		  'Left Sidebar' => '<b>Left Sidebar</b>: Menus placed in this location will appear in the left sidebar',
		  'Right Sidebar' => '<b>Right Sidebar</b>: Menus placed in this location will appear in the right sidebar',
		  'Footer' => '<b>Footer</b>: Menus placed in this location will appear in the footer'
		));
	}

}

add_action( 'init', 'register_theme_menus' );

?>