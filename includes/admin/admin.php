<?php

global $themename;
global $shortname;

global $options;
global $option_name;
global $option_group;
global $page;

add_custom_background( 'dont_call_me_i_will_call_you' );

add_editor_style( "styles/style.php" );         
add_editor_style( "style.css" );         

require_once( get_template_directory() . "/includes/admin/options.php" );
require_once( get_template_directory() . "/includes/admin/theme_admin_page.php" );
require_once( get_template_directory() . "/includes/admin/header_image.php" );
require_once( get_template_directory() . "/includes/admin/background_options.php" );

?>