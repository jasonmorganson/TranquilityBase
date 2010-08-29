<?php



global $themename;
global $shortname;

global $option_name;
global $option_group;
global $page;

$option_name = $shortname.'_options';
$option_group = $shortname.'_options';
$page = $shortname;




/* Add an options page in the WordPress admin under Themes */
function add_theme_admin_page() {

	global $themename, $shortname;
	global $options, $option_name, $option_group, $page;

	add_theme_page( $themename." Options", $themename." Options", 'edit_themes', $page, 'display_theme_admin_page');
}

add_action('admin_menu', 'add_theme_admin_page');



/* Display the theme options page */
function display_theme_admin_page() {

	global $themename, $shortname;
	global $options, $option_name, $option_group, $page;

	?>

	<div class="wrap">
	
		<div id="icon-themes" class="icon32"><br /></div>
		<h2><?php echo $themename." Options"; ?></h2>
		
		<?php if( $_GET['updated'] === 'true' ) : ?>

			<div id="my-theme-options-updated" class="updated fade">
				<p><?php _e( "Options saved" ); ?></p>
			</div>

		<?php endif; ?>
  
		<form action="options.php" method="post">

			<?php settings_fields( $option_group ); ?>
	
			<?php do_settings_sections( $page ); ?>
			
			<input class="button-primary" type="submit" name="Submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		
		</form>
	
	</div>

	<?php
}



/* Define theme settings */
function theme_admin_init(){

	global $themename, $shortname;
	global $options, $option_name, $option_group, $page;

	$stored_options = get_option( $option_name );
	
	/* Loop through all of the options */
	foreach( $options as $option ) {

		/* If the options section isnt the current section, then update the current section */
		if( $current_section !== $option['section'] ) {
			$current_section   = $option['section'];

			/* Add a new section if one doesnt exist */
			add_settings_section( $current_section, $option['section'], 'section_text', $page );
		}

		/* If the stored option is empty, then... */
		if( !isset( $stored_options[$option['id']] ) ) {
			
			/* Set the stored option to the default setting */
			$stored_options[$option['id']] = $option['default'];
			
			update_option( $option_name, $stored_options );
		}

		add_settings_field( $option['id'], $option['description'], 'theme_setting', $page, $current_section, $option );
	}

	register_setting( $option_group, $option_name, 'validate_theme_options' );
}

add_action('admin_init', 'theme_admin_init');



/* Callback function used to display just after a section header */
function section_text() {
/* Dont output anything */
}



/* Callback function for the theme settings */
function theme_setting( $option ) {

	global $themename, $shortname;
	global $options, $option_name, $option_group, $page;

	$stored_option = get_option( $option_name );
	
	$id = $option['id'];
	$name = "{$option_name}[{$id}]";
	$value = $stored_option["$id"];
	$type = $option['type'];

	$echo = "<input id='{$id}' name='{$name}' value='{$value}' type='{$type}' ";
	
	if( $type == "text" )
		$echo .= "size='40' ";
	
	if( $type == "checkbox" ) {

		if( $value == "true" )
			$echo .= "checked ";
	}
		
	$echo .= "/>";
	
	echo $echo;

}



/* Validate theme options */
function validate_theme_options( $submitted_options ) {
	
	global $options, $option_name, $option_group, $page;
	
	require( get_template_directory() . "/includes/admin/options.php" );
	
	
	/* Loop through all of the options */
	foreach( $options as $option ) {

		/* Perform any validations */

		if( $option['type'] == "checkbox" )

			isset( $submitted_options[$option['id']] ) ? $submitted_options[$option['id']] = TRUE : $submitted_options[$option['id']] = FALSE;
	}

	return $submitted_options;
}


?>