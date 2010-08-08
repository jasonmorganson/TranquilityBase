<?php

function check_compatiblity() {

	global $themename;
	
	$compatible = true;
	
	$echo = "";
	
	$echo .= "<html>";
	$echo .= "<body>";
	
	$echo .= "<style type='text/css'>";

	$echo .= <<<EOF
	
	.error {
	
		margin: 5em;
		padding: 3em;
		border: 1px solid red;
		background-color: #fabdbd;
	}
	
	h1 {
		color: white;
	}
	
	pre {
		display: inline;
	}
	
EOF;


	
	$echo .= "</style>";

	$echo .= "<div class='error'>";
	
	$echo  .= "<h1>" . $themename . " theme is not compatible with your current WordPress setup</h1>";
	$echo .= "<h2>The following sections of this theme are not compatible with the currently installed version of WordPress:</h2>";
	$echo .= "<ul>";
	
	if( get_bloginfo( "version" ) < 3 ) {
		$compatible = false;
		$echo .= "<li>WordPress v3.0 or higher is required (Current version is ". get_bloginfo( 'version') . ")</li>";	
	}
	
	if( !function_exists( 'add_theme_support' ) ) {
		$compatible = false;
		$echo .= "<li><pre>add_theme_support</pre> function doesnt exist</li>";	
	}

	if( !function_exists( 'get_template_part' ) ) {
		$compatible = false;
		$echo .= "<li><pre>get_template_part</pre> function doesnt exist</li>";	
	}

	if( !function_exists( 'add_custom_background' ) ) {
		$compatible = false;
		$echo .= "<li>Custom backgrounds are not supported</li>";	
	}

	if( !function_exists( 'wp_nav_menu' ) || !function_exists( 'register_nav_menus' ) ) {
		$compatible = false;
		$echo .= "<li>Navigation menus are not supported</li>";	
	}

	if( !function_exists( 'dynamic_sidebar' ) || ! function_exists('register_sidebar') ) {
		$compatible = false;
		$echo .= "<li>Widgets are not supported</li>";
	}
	
	$echo .= "</ul>";

	$echo .= "</div>";
	
	$echo .= "</body>";	
	$echo .= "</html>";

	if( $compatible === false ) {
		wp_die( $echo );
	}
}

add_action( 'init', 'check_compatiblity' );

?>