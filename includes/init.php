<?

/* Basic functions */
require "functions.php";

/* Check for required functions */
require "compatibility.php";

/* Get basic theme information */
require "themeinfo.php";




global $option;
global $options;
global $option_name;


/* Admin functions */
require "admin/admin.php";



$option = get_option( $option_name );

/* Head specific functions */
require "stylesheets.php";

/* Head specific functions */
require "head.php";

/* Menu specific functions */
require "menus.php";

/* Register sidebars */
require "sidebars.php";

/* Register widgets */
require "theme-widgets.php";

/* Add a live theme screenshot */
require "screenshot.php";

/* Include support for WPML */
include "wpml-integration.php";

/* Include custom functions for theme */

@include get_stylesheet_directory() . "/functions-custom.php";

?>