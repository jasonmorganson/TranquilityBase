<?php


class AnchorLinkWidget extends WP_Widget {

	function AnchorLinkWidget() {
	
		/* Create the widget. */
		parent::WP_Widget(false, 'Anchor Links Widget', array( 'description' => 'Displays a menu of the anchor links on the current page' ));
	}

	/* Echo output through the admin console */
	function form( $instance ) { 
	
		/* Output */
		
		echo "Displays a menu of the anchor links on the current page";
		
		return 'noform';
	}

	/* Echo the content of the widget */
    function widget( $args, $instance ) {
    
        extract( $args );
    
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo $before_title . $title . $after_title;
		}
		
		/* Output widget content */
		
		global $wp_query;
		
		/* Pages */
		$About_Cellport = 6;
		$Procedure = 31;
		$Results = 40;
		$In_the_News = 39;
		$Contact_Us = 13;
		
		
		/* If on the front page, then... */
		if( is_front_page() ) { 
		
			/* Use the "About" page in the menu */
			$thisID = $About_Cellport;
		
			/* Get the post ID in the current language */
			$thisID = wpml_get_object_id( $thisID, 'page' );
		
		} else {
		
			/* Use the post/page's own ID */
			$thisID = $wp_query->post->ID;
		
			/* Get the post ID in the current language */
			$thisID = wpml_get_object_id( $thisID, 'page' );
		}
		
		?>
		
		<div class="menu">
		
		<h2><?php wpml_link_to_element($thisID); ?></h2> 
		 
		<ul>
		<?php 
		
		/* Get the post data for the current post ID */
		$post_data = get_post( $thisID );
		
		/* Get the page content as a string from Wordpress */
		$content = $post_data->post_content;
		
		
		if(! empty( $content ) ) {
		
			/* Apply a str_replace that gets done inside the_content() call normally */
			$content = str_replace(']]>', ']]&gt;', $content);
		
			/* Convert encodings to UTF-8 to ensure proper support */
			$content = mb_convert_encoding( $content, 'HTML-ENTITIES', "UTF-8" ); 
			
			/* Create a new DOM document object */ 
			$contentDOM = new DOMDocument('1.0', 'UTF-8');
			
			/* Disable error reporting */
			libxml_use_internal_errors(true);
		
			/* Load the Wordpress content object into the DOM document object */ 
			$contentDOM->loadHTML( $content ); 
		
			if(! empty( $contentDOM ) ) {
			
				/* Get the links by tag name */ 
				$links = $contentDOM->getElementsByTagName('a'); 
				
				foreach( $links as $link ) {
				
					if( $link->hasAttribute('name') ) {
		
						/* Get the name attribute */
						$name_attr = $link->getAttribute('name');
					
						/* Create a menu item link for the anchor */
						echo "<li>";
						wpml_link_to_element( $thisID, 'page', $name_attr, '', $name_attr );
						echo "</li>";
					}			
				}
			}
		}
		?>
		
		</ul>
		
		</div>
		
		<?php		
		
  		/* After widget (defined by themes). */
		echo $after_widget;
    }
}


/* Register the widget */
add_action( 'widgets_init', create_function('', 'return register_widget( "AnchorLinkWidget" );') );

?>