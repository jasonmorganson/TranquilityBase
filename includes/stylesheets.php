<?php

global $ie_base64_images;
$ie_base64_images = array();

		
function add_css_query_var( $public_query_vars ) {

	$public_query_vars[] = 'css';

	return $public_query_vars;

}

add_filter( 'query_vars', 'add_css_query_var' );


function dynamic_css() {

	global $ie_base64_images;
	
	$css = get_query_var('css');
	
	if( $css == 'dynamic' ) {
	
		$stylesheet = get_template_directory() . "/styles/style.php";
		$offset = 72000 ;
		$last_modified_time = filemtime( $stylesheet ); 
		header( "Content-type: text/css" );
		header( "Cache-Control: public, max-age={$offset}" );
		header( "Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT" ); 
		$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
		header($ExpStr);

		include $stylesheet;

		exit;
	}
	
	if( preg_match( "/mhtml/i", $css ) ) {

		header( "Content-type: multipart/related; boundary=\"--_BOUNDARY_SEPARATOR\"" );
		header( "Cache-Control: must-revalidate" );
		$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() ) . " GMT";
		header($ExpStr);

		echo implode( '--_BOUNDARY_SEPARATOR', $ie_base64_images );

		exit;
	}
}

add_action( 'template_redirect', 'dynamic_css' );


/* Convert any resources contained in the file in an URL into data URIs */
function embed_data_uris( $url_match ) {

	global $ie_base64_images;
	
	$filename = trim( strip_quotes( $url_match[2] ), "/" );
	$basename = basename( $filename, '.'.get_file_extension( $filename ) );
  	
	if( preg_match( "/http/i", $url_match[0] ) ) {
		$url = $filename;
		$filepath = $filename;
	} else { 
		$url =  get_stylesheet_directory_uri() . "/" . $filename;
  		$filepath = get_stylesheet_directory() . '/' . $filename;
  	}
  	
	/* Dont process certain URLs */
	if( preg_match( "/(\.htc)/i", $url_match[0] ) )
		return $url_match[0];

	/* Import external stylesheets */
	else if( preg_match( "/@import/i", $url_match[0] ) )
		preprocess_stylesheet( $filepath );

	else {

		$uri = '';

		$uri .= $url_match[1] . "url(" . data_uri( $filepath ) . ")" . $url_match[3] . "\n";

		$uri .= "*" . trim( $url_match[1] . "url(" . 'mhtml:' . get_bloginfo('home') . '/?css=mhtml!' . $basename . ")" . $url_match[3] ) . "\n";

		$uri .= "*" . trim( $url_match[1] . "url(" . $url . ")" . $url_match[3] ) . "\n"; /* Add hack for IE to keep regular images */

		$ie_encoded_image   = "Content-Location:" . $basename . "\n";
		$ie_encoded_image  .= "Content-Transfer-Encoding:base64\n\n\n";
		$ie_encoded_image  .= base64_encode( $filename );
		$ie_base64_images[] = $ie_encoded_image;
		
		return $uri;		
	}
}


/* Perform preprocessing actions on a stylesheet with the given filename */
function preprocess_stylesheet( $stylesheet_contents ) {

	global $option;
	
	//if( $option['minify_css'] == "true" ) {

		/* Minify the stylesheet */
	//	$stylesheet_contents = minify( $stylesheet_contents );
	//}

	//if( $option['embed_uris'] == "true" ) {
		
		/* Covert URLs into data URIs */	
		$stylesheet_contents = preg_replace_callback(
							   "|(.*)url\((.*)\)(.*)|",
							   "embed_data_uris",
							   $stylesheet_contents );
	//}
	
	return $stylesheet_contents;
}


function include_stylesheet( $filename, $preprocess = TRUE ) {

	global $option;

	if( pathinfo( $filename, PATHINFO_EXTENSION ) == "php" ) {

		ob_start();
		include $filename;
		$stylesheet_contents = ob_get_contents();
		ob_end_clean();
    }

    else {

		$stylesheet_contents = file_get_contents( $filename );
	}

	if( $preprocess ) {
	
		echo preprocess_stylesheet( $stylesheet_contents );
	
	} else {
	
		echo $stylesheet_contents;
	}
	
}
?>