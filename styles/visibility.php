<?php

if( $option["sidebar-left-width"] === "0" ) {

	?>
	
	#sidebar-left {
		display: none;
	}
	
	<?php
	
	global $wpdb;
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_value = 'index-right.php' WHERE meta_key = '_wp_page_template'");
}

if( $option["sidebar-right-width"] === "0" ) {
	
	?>
	
	#sidebar-right {
		display: none;
	}
	
	<?php
	
	global $wpdb;
	$wpdb->query("UPDATE $wpdb->postmeta SET meta_value = 'index-left.php' WHERE meta_key = '_wp_page_template'");
}

?>