<?php


/* Register sidebars */

if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name' => 'Intro',
		'description'   => 'Widgets in this area will be shown in the header.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  =>  '<h5>',
		'after_title'   => '</h5>',
	));

	register_sidebar(array(
		'name' => 'Left Sidebar',
		'description'   => 'Widgets in this area will be shown on the left-hand side.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  =>  '<h2>',
		'after_title'   => '</h2>',
	));

	register_sidebar( array(
		'name' => 'Right Sidebar',
		'description'   => 'Widgets in this area will be shown on the right-hand side.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  =>  '<h2>',
		'after_title'   => '</h2>',
	));
    
    register_sidebar( array(
    	'name' => 'Footer',
    	'description'   => 'Widgets in this area will be shown in the footer.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget'  => '</div>',
    	'before_title'  =>  '<h6>',
    	'after_title'   => '</h6>',
    ));
}

?>