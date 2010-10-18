<?php 


$gradient_color = get_theme_mod( 'gradient_color', '' );

/* If a gradient color is set, then enable the background gradient */
if( $gradient_color !== '' ) :

?>


body {

	background-attachment: scroll;
	background-image: filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#<?php echo $gradient_color; ?>", endColorstr="#<?php background_color(); ?>" ); /* for <=IE7 */
    background-image: -ms-filter: "progid:DXImageTransform.Microsoft.gradient( GradientType=0, startColorstr=#<?php echo $gradient_color; ?>, endColorstr=#<?php background_color(); ?> )"; /* IE8+ */
    background-image; -o-gradient( top, bottom, from(#<?php echo $gradient_color; ?>), to(#<?php background_color(); ?>) );  /* for Opera */
	background-image: -moz-linear-gradient( top, #<?php echo $gradient_color; ?>, #<?php background_color(); ?> ); /* for firefox 3.6+ */
	background-image: -webkit-gradient( linear, left top, left bottom, from(#<?php echo $gradient_color; ?>), to(#<?php background_color(); ?>) ); /* for webkit browsers */
}


<?php endif; ?>