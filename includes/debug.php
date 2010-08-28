<?php
echo "ABSPATH ".ABSPATH."<br />";
echo "WP_CONTENT_DIR ".WP_CONTENT_DIR."<br />";
echo "WP_CONTENT_URL ".WP_CONTENT_URL."<br />";
echo "WPINC ".WPINC."<br />";
echo "WP_PLUGIN_DIR ".WP_PLUGIN_DIR."<br />";
echo "WP_PLUGIN_URL ".WP_PLUGIN_URL."<br />";
echo "PLUGINDIR ".PLUGINDIR."<br />";
echo "WPMU_PLUGIN_DIR ".WPMU_PLUGIN_DIR."<br />";
echo "WPMU_PLUGIN_URL ".WPMU_PLUGIN_URL."<br />";
echo "MUPLUGINDIR ".MUPLUGINDIR."<br />";
echo "Parent theme ".TEMPLATEPATH."<br />";
echo "Child theme ".STYLESHEETPATH."<br />";
echo "Parent template_directory ".get_bloginfo('template_directory')."<br />";
echo "Parent template_url ".get_bloginfo('template_url')."<br />";
echo "Child stylesheet_directory ".get_bloginfo('stylesheet_directory')."<br />";
echo "Child stylesheet_url ".get_bloginfo('stylesheet_url')."<br />";
echo "current_theme option ".get_option('current_theme')."<br />";
echo "template option ".get_option('template')."<br />";
echo "stylesheet option ".get_option('stylesheet')."<br />";

function ByteSize( $bytes ) { 

	$size = $bytes / 1024; 

	if($size < 1024) { 
		$size = number_format($size, 2); 
		$size .= ' KB'; 
	} else if($size / 1024 < 1024) { 
		$size = number_format($size / 1024, 2); 
		$size .= ' MB'; 
	} 
	
	return $size; 
} 

echo "Using ", ByteSize( memory_get_peak_usage(1) ), " of ram.";


function list_hooked_functions($tag=false){

 global $wp_filter;

 if ($tag) {

  $hook[$tag]=$wp_filter[$tag];

  if (!is_array($hook[$tag])) {

  trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);

  return;

  }

 }

 else {

  $hook=$wp_filter;

  ksort($hook);

 }

 echo '<pre>';

 foreach($hook as $tag => $priority){

  echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";

  ksort($priority);

  foreach($priority as $priority => $function){

  echo $priority;

  foreach($function as $name => $properties) echo "\t$name<br />";

  }

 }

 echo '</pre>';

 return;

}

//list_hooked_functions();
?>