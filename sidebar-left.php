
<div id="sidebar-left">

	<?php
	
		if( function_exists( 'wp_nav_menu' ) ) {
	
			wp_nav_menu( array( 'theme_location' => 'Left Sidebar' ) );
	
		}
	
		if( function_exists( 'dynamic_sidebar' ) ) {
	
			dynamic_sidebar( 'Left Sidebar' );
		
		}
	?>

</div>