<?php

//ini_set( "default_charset",	"UTF-8" );              // Default character set for auto content type header    
//ini_set( "mbstring.internal_encoding", "UTF-8" );   // Set default internal encoding to UTF-8
//ini_set( "mbstring.substitute_character", "none" ); // Do not print invalid characters


//php_value mbstring.http_input		 auto		# Set HTTP input character set dectection to auto
//php_value mbstring.http_output		 UTF-8		# Set HTTP output encoding to UTF-8
//php_value mbstring.encoding_translation	 On		#  HTTP input encoding translation is enabled
//php_value mbstring.detect_order		 auto		# Set default character encoding detection order to auto



/* Empty function to be used as a blank callback in functions */
function dont_call_me_i_will_call_you() { }





/* Minify a string by removing any whitespace and comment markup */
function minify( $content ) {

	/* Remove comments */
    $content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
    
    /* Remove whitespace (tabs, spaces, newlines, etc.) */
    $content = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $content);

	return $content;
}







function get_page_by_name( $page_name ) {

	global $wpdb;
	$page_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'" );
	return $page_id;
}



if(! function_exists('getPageContent') ) {

function getPageContent( $pageID ) {

	if(! is_numeric( $pageID) ) { return; }
	
		global $wpdb;
		
		$nsquery = 'SELECT DISTINCT * FROM ' . $wpdb->posts . ' WHERE ID=' . $pageID;
		
		$post_data = $wpdb->get_results( $nsquery );
	
		if(! empty( $post_data) ) {
		
			foreach($post_data as $post) {
			
				//$text_out = nl2br( $post->post_content );
				$text_out = str_replace(']]>', ']]&gt;', $text_out);
				//$text_out = strip_tags($text_out);
				return $text_out;
			}
		}
	}
}

function HTMLbloginfo( $result = '', $show = '' ) {
		
	if( is_admin() ) {
		$result = strip_tags( $result );
	}
	
	else if(! is_admin() ) {
		
		switch( $show ) {
		
			case 'name':
				if( get_option('blogtitle') != '' ) {
					$result = get_option('blogtitle');
				}

			case 'description':
			
			return html_entity_decode( $result );
			
			default: return;
		}
	}
	
	return $result;
}

add_filter( 'bloginfo', 'HTMLbloginfo', 1000, 2 );

function strip_quotes( $string ) {
	return trim( $string, "\x22\x27" );  /* Strip quotes from string */
}

function data_uri( $file ) {

	$contents = file_get_contents( $file );
	$mime = get_mime_type( $file );
	$base64   = base64_encode( $contents ); 
	return ( "data:{$mime};base64,{$base64}" );
}

function utf8_to_html ($data) {

    return preg_replace("/([\\xC0-\\xF7]{1,1}[\\x80-\\xBF]+)/e", '_utf8_to_html("\\1")', $data);
}

function _utf8_to_html ($data) {

    $ret = 0;
    foreach((str_split(strrev(chr((ord($data{0}) % 252 % 248 % 240 % 224 % 192) + 128) . substr($data, 1)))) as $k => $v)
        $ret += (ord($v) % 128) * pow(64, $k);
    return "&#$ret;";
}

function get_file_extension( $filename ) { 

	return pathinfo( $filename, PATHINFO_EXTENSION );
}


function get_mime_type( $filename ) {

	/* Use newer PECL fileinfo functions if available */
	if( defined( 'FILEINFO_MIME' ) ) {

		$finfo = new finfo( FILEINFO_MIME );
		$mime = $finfo->file( $filename );
		list( $mime_type, $mime_encoding ) = explode( ";", $mime );
	}

	/* Fallback to the depreciated functions if available */
	else if( function_exists( 'mime_content_type' ) ) {
		$mime_type = mime_content_type($filename);
	}

	return $mime_type;
}


function include_request_resources() {

	global $wp;

	$dirs = array( '/',
				   '/styles/',
				   '/images/',
				   '/_media/',
				   '/_media/header/',
				   '/_media/backgrounds/',
				   '/_media/common_assets/',
				   '/_fonts/' );

	/* Add extra resources to check before returning a 404 */
//	if( is_404() ) {

		$css_dir = get_stylesheet_directory();
		$css_uri = get_stylesheet_directory_uri();
	
		$requested_filename = basename( $wp->request );
	
		foreach( $dirs as $dir ) {

			$file_path = $css_dir . $dir . $requested_filename;
			$file_uri =  $css_uri . $dir . $requested_filename;

			if( file_exists( $file_path ) ) {

				/* If the file is in PHP */
				if( get_file_extension( $file_path ) === "php" ) {
					header("HTTP/1.1 304 Not Modified"); 
					include $file_path;
					exit();
				}
				
				/* If the file is an image */
				else if( is_image_file( $file_path ) ) {
					send_image_response( $file_path );
				}
			}
		}
//	}
/*	
	Add the uploads dir also
	$uploads = wp_upload_dir(); // Array of key => value pairs

	$uploads now contains something like the following (if successful)
	Array ( 
		[path] => C:\path\to\wordpress/wp-content/uploads/2010/05 
		[url] => http://example.com/wp-content/uploads/2010/05 
		[subdir] => /2010/05 
		[basedir] => C:\path\to\wordpress/wp-content/uploads 
		[baseurl] => http://example.com/wp-content/uploads 
		[error] => 
	) 
	// Descriptions
	[path] - base directory and sub directory or full path to upload directory.
	[url] - base url and sub directory or absolute URL to upload directory.
	[subdir] - sub directory if uploads use year/month folders option is on.
	[basedir] - path without subdir.
	[baseurl] - URL path without subdir.
	[error] - set to false.
*/
}

/*add_action( 'get_header', 'include_request_resources' );*/
/*add_filter( 'parse_request', 'include_request_resources' );*/




function is_image_file( $filename ) {

	return preg_match( "|image|i", get_mime_type( $filename ) );
}

function send_image_response( $filename ) {

	$mime = $size = getimagesize( $filename );
	$length = filesize( $filename );
	$last_modified_time = filemtime( $filename ); 
	$etag = md5_file( $filename );

	header( "Location: " . get_stylesheet_directory_uri() . '/' . $filename );
	header( "Content-Length: $length" );
	header( "Content-Type: {$size['mime']}" );
	header( "Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT" ); 
	header( "Etag: $etag" ); 
	
	if( @strtotime( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) == $last_modified_time || 
		trim( $_SERVER['HTTP_IF_NONE_MATCH'] ) == $etag ) { 
		header("HTTP/1.1 304 Not Modified"); 
	}

	exit();
}







if ( ! function_exists( 'posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

?>