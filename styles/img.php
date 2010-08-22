<?php

$image = get_background_image();


if ( $image != '' ) :

$repeat = get_theme_mod( 'background_repeat', 'repeat' );
if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
	$repeat = 'repeat-x';

$position = get_theme_mod( 'background_position_x', 'left' );
if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
	$position = 'left';

$attachment = get_theme_mod( 'background_attachment', 'scroll' );
if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
	$attachment = 'fixed';

?>

body {
	
	background-repeat: <?php echo $repeat; ?>; 
	background-position: top <?php echo $position; ?>;
	background-attachment: <?php echo $attachment; ?>;
	background-image: url(<?php echo $image; ?>);
}

<?php endif; ?>


#banner {
	background: url(<?php header_image(); ?>);
}

