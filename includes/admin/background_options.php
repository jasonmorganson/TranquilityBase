<?php

global $themename, $shortname;

function add_background_options_js() {

	wp_register_script( 'extra-background-options-js', get_bloginfo('template_directory').'/includes/admin/background_options.js');
	
	wp_enqueue_script( 'extra-background-options-js' );
}


function add_background_options($content) {

global $themename;

?>


<div class="wrap" id="custom-background-extra">



<h3><?php echo $themename . ' Options'; ?></h3>

<form method="post" action="">

<table class="form-table">
<tbody>

<tr valign="top">
<th scope="row"><?php _e( 'Band Color' ); ?></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Band Color' ); ?></span></legend>
<input type="text" name="band-color" id="band-color" value="#<?php echo esc_attr(get_theme_mod('band_color', '')) ?>" />
<a class="hide-if-no-js" href="#" id="pickcolorband"><?php _e('Select a Color'); ?></a>
<div id="colorPickerBand" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
</fieldset></td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Gradient Color' ); ?><br /><span style="font-size: 10px; color: #FF8A00;">If set; this will apply a gradient to the background using the background color from above as the ending color and this as the starting color</span></th>
<td><fieldset><legend class="screen-reader-text"><span><?php _e( 'Gradient Color' ); ?></span></legend>
<input type="text" name="gradient-color" id="gradient-color" value="#<?php echo esc_attr(get_theme_mod('gradient_color', '')) ?>" />
<a class="hide-if-no-js" href="#" id="pickcolorgradient"><?php _e('Select a Color'); ?></a>
<div id="colorPickerGradient" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
</fieldset></td>
</tr>

</tbody>
</table>

<?php wp_nonce_field('custom-background'); ?>
<p class="submit"><input type="submit" class="button-primary" name="save-background-options" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
</form>

</div>

<?php
}


function background_options_take_action() {

	if( empty($_POST) )
		return;

	if( isset( $_POST['band-color'] ) ) {

		check_admin_referer( 'custom-background' );
		
		$color = preg_replace( '/[^0-9a-fA-F]/', '', $_POST['band-color'] );

		if ( strlen($color) == 6 || strlen($color) == 3 )
			set_theme_mod('band_color', $color);
		else
			set_theme_mod('band_color', '');
	}
	
	if( isset( $_POST['gradient-color'] ) ) {

		check_admin_referer( 'custom-background' );
		
		$color = preg_replace( '/[^0-9a-fA-F]/', '', $_POST['gradient-color'] );

		if ( strlen($color) == 6 || strlen($color) == 3 )
			set_theme_mod('gradient_color', $color);
		else
			set_theme_mod('gradient_color', '');
	}
}

add_action( 'load-appearance_page_custom-background', 'add_background_options_js', 11 );
add_action( 'appearance_page_custom-background', 'add_background_options', 11 );
add_action( 'load-appearance_page_custom-background', 'background_options_take_action', 50 );


?>