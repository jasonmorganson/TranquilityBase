<?php

// remove junk from head
/*
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
*/

// disable all feeds
function fb_disable_feed() {
	wp_die(__('<h1>Feed not available, please visit our <a href="'.get_bloginfo('url').'">Home Page</a>!</h1>'));
}
//add_action('do_feed',      'fb_disable_feed', 1);
//add_action('do_feed_rdf',  'fb_disable_feed', 1);
//add_action('do_feed_rss',  'fb_disable_feed', 1);
//add_action('do_feed_rss2', 'fb_disable_feed', 1);
//add_action('do_feed_atom', 'fb_disable_feed', 1);

// remove version info from head and feeds
function complete_version_removal() {
	return '';
}
//add_filter('the_generator', 'complete_version_removal');

//cache_javascript_headers();

add_theme_support('automatic-feed-links');


function print_styles() {
?>

	<link rel="stylesheet" id="dynamic-css" href="<?php get_bloginfo('home') ?>/?css=dynamic" type="text/css" media="all">

<?php
}


function enqueue_styles() {
	
	/* If the W3 Cache plugin exists, then use it */ 
	if( function_exists( 'w3tc_styles' ) ) {

		w3tc_styles( 'include' );
	
	/* Otherwise, add stylesheet in the head */
	} else {

		wp_register_style( 'dynamic', get_bloginfo('home') . '/?css=dynamic' );

		wp_enqueue_style( 'dynamic' );
	}
}


add_action( 'wp_print_styles', 'enqueue_styles' );	
add_action( 'login_head', 'print_styles' );
add_editor_style( 'style.css' );



/* Add a favicon to the document head */
function favicon_link() {

	/* Check for favicon in the stylesheet directory */
	if( file_exists( "<?php get_stylesheet_directory(); ?>/favicon.ico" ) ) {

		?><link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" /><?php
	}

	/* Check for favicon in the template (parent) directory */
	else if( file_exists( "<?php get_template_directory(); ?>/favicon.ico" ) ) {
	
		?><link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" /><?php
	}

	/* Check for favicon in the root directory */
	else if( file_exists( ABSPATH . "favicon.ico" ) ) {

		?><link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('url'); ?>/favicon.ico" /><?php
	}

	/* If no favicon is found, then generate a blank one */
	else {

		?><link rel="shortcut icon" type="image/x-icon" href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII="/><?php
	}
	
}

add_action( 'wp_head', 'favicon_link' );


/* Embed the the IE7-JS Internet Explorer fixes in the document head */
function ie7js() {
?>

<!--[if lt IE 7]>
<script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7-squish.js" 
 type="text/javascript">
 </script>
<![endif]-->

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js">IE7_PNG_SUFFIX=".png";</script>
<![endif]-->

<?php
}

add_action( 'wp_head', 'ie7js' );


?>