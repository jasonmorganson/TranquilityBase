<?php


function screenshot() {

	$screenshot = get_stylesheet_directory() . "/screenshot.png";

	/* If a screenshot file does not exists, then create one */
	if( !file_exists( $screenshot ) ) {

		/* This is a MD5 hash that is equivalent to the loading image */
		$loading = "e89e34619e53928489a0c703c761cd58";

		$wp_url = urlencode( clean_url( get_bloginfo( 'wpurl' ) ) );
		$screenshot_url = "http://s.wordpress.com/mshots/v1/" . $wp_url;

		/* Use cURL to retrieve the HTTP status code */
		$ch = curl_init( $screenshot_url );
		curl_setopt( $ch, CURLOPT_HEADER, true ); 
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true ); 
		curl_exec( $ch );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		
		/* Get the image size and data */
		$imagesize = getimagesize( $screenshot_url );
	
		/* Get the MD5 hash of the current image */
		$md5 = md5_file( $screenshot_url );


		/* Check to see if the screenshot is done loading */
		if( $http_code !== 307 &&
			$imagesize[2] !== IMAGETYPE_GIF &&
		    $imagesize['mime'] !== "image/gif" &&
			$md5 !== $loading ) {
		
			/* Retrieve the screenshot */
			wp_get_http( $screenshot_url, $screenshot );
		}
		
		curl_close( $ch );
	}
}

add_action( 'init', 'screenshot' );

?>