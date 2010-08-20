<?php

global $options;
global $option_name;

$option = get_option( $option_name );

define( 'NO_HEADER_TEXT', true );
define( 'HEADER_TEXTCOLOR', '' );
define( 'HEADER_IMAGE_WIDTH',  $option['banner_width'] );
define( 'HEADER_IMAGE_HEIGHT', $option['banner_height'] );
define( 'HEADER_IMAGE', get_bloginfo('stylesheet_directory') . '/images/header/default_header.jpg' );



function header_style() {

	?>
	<style type="text/css">
	
		#banner {
			background: url( <?php header_image(); ?> );
			width:  <?php echo HEADER_IMAGE_WIDTH;  ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		}
	
	</style>
	<?php
}



function admin_header_style() {

	?>
	<style type="text/css">
	
		#headimg {
			width:  <?php echo HEADER_IMAGE_WIDTH;  ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		}
	
	</style>
	<?php
}

add_custom_image_header( 'dont_call_me_i_will_call_you', 'admin_header_style' );

?>