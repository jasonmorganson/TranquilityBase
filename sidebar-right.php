
<div id="sidebar-right">

	<?php
	
		if( function_exists( 'wp_nav_menu' ) ) {
	
			wp_nav_menu( array( 'theme_location' => 'Right Sidebar' ) );
	
		}
	
		if( function_exists( 'dynamic_sidebar' ) ) {
	
			dynamic_sidebar( 'Right Sidebar' );
		
		}
	?>

</div>