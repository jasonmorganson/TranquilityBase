<?php


class GoogleFormWidget extends WP_Widget {

	function GoogleFormWidget() {
	
		/* Create the widget. */
		parent::WP_Widget( false, 'Google Form Widget', array( 'description' => 'Displays a form from Google Forms' ));
	}

	/* Echo output through the admin console */
	function form( $instance ) { 
	
		$title = esc_attr( $instance['title'] );
        $url = esc_attr( $instance['url'] );
        $redirect_url = esc_attr( $instance['redirect_url'] );
        
        ?>

            <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
            <?php _e('Title:'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </label>
            </p>
            
            <p>
            <label for="<?php echo $this->get_field_id('url'); ?>">
            <?php _e('URL:'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
            </label>
            </p>
            
            <p>
            <label for="<?php echo $this->get_field_id('redirect_url'); ?>">
            <?php _e('Redirect URL:'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('redirect_url'); ?>" name="<?php echo $this->get_field_name('redirect_url'); ?>" type="text" value="<?php echo $redirect_url; ?>" />
            </label>
            </p>
            
        <?php 
	}

    function update( $new_instance, $old_instance ) {

		if( empty( $new_instance['title'] ) )
			$new_instance['title'] = $old_instance['title'];
		
		if( empty( $new_instance['url'] ) )
			$new_instance['url'] = $old_instance['url'];
		
		if( empty( $new_instance['url'] ) )
			$new_instance['redirect_url'] = $old_instance['redirect_url'];
		
		return $new_instance;
    }
    
	/* Echo the content of the widget */
    function widget( $args, $instance ) {
    
        extract( $args );

    	$title = apply_filters( 'widget_title', $instance['title'] );
    	$url = $instance['url'];
    	$redirect_url = $instance['redirect_url'];
    	$iframe_id = $this->id."-iframe";
    	
    	/* Figure out what type of form it is, either Short or Long,
    	 * if being called from a widget, then assume its a Short form,
    	 * if being called from a shortcode, then assume its a Long form
    	 */
    	if( $form_type != "Long" )
    		$form_type = "Short";

    	/* Get the form content from the database */
    	$content = get_option( $this->id."-content" );
    	
    	/* If the content is empty... */
    	if( empty( $content ) ) {
	
			if( ! empty( $url ) )
			
			/* Get the content from the form url */
			$content = file_get_contents( $url );
	
			/* Store the content in the database */
			update_option( $this->id."-content", $content );
		}
		
		
		if( ! empty( $content ) ) {

		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Output widget content */

		?>
		
		<div class="gform">

		<h2><?php echo $title; ?></h2>

		<div id="top"></div>

		<?php
				
		/* Create a new DOM document object */ 
		$contentDOM = new DOMDocument( );

		/* Load the content string into the DOM document object */ 
		$contentDOM->loadHTML( $content ); 
	
		if( ! empty( $contentDOM ) ) {

			/* Get the form */
			$form = $contentDOM->getElementById( 'ss-form' );
			$action = $form->getAttribute( 'action' );
			
			?>
			
			<script type="text/javascript"> var submitted = false; </script>
			
			<iframe id="<?php echo $iframe_id; ?>" style="display: none;" onload="if( submitted ) { window.location = '<?php echo $redirect_url; ?>'; }"></iframe>

			<form action="<?php echo $action; ?>" method="POST" target="<?php echo $iframe_id; ?>" onsubmit="submitted=true;">
			
			<?

			$divs = $contentDOM->getElementsByTagName( 'div' );
			
			foreach( $divs as $div ) {
				
				$class = $div->getAttribute( 'class' );
				
				if( $class == 'ss-form-entry' ) {
				
					/* Fill in and keep the "Source" field from showing */
					if( preg_match( "/Source/i", $div->firstChild->nodeValue ) ) {
					
						$div->removeChild( $div->firstChild );
						$div->lastChild->setAttribute( "type", "hidden" );
						$div->lastChild->setAttribute( "value", $_SERVER['SERVER_NAME'] );
					}

					/* Fill in and keep the "Form" field from showing */					
					if( preg_match( "/Form/i", $div->firstChild->nodeValue ) ) {
					
						$div->removeChild( $div->firstChild );
						$div->lastChild->setAttribute( "type", "hidden" );
						$div->lastChild->setAttribute( "value", $form_type );
					}
					
					/* Display the contents of the DIV */
					echo $contentDOM->saveXML( $div, LIBXML_NOEMPTYTAG );

				}
			}
		}

		?>

		</form>
		
		<div id="bottom"></div>
		
		</div>
		
		<?php	
		
  		/* After widget (defined by themes). */
		echo $after_widget;
		
		}
    }
}


/* Register the widget */
add_action( 'widgets_init', create_function( '', 'return register_widget( "GoogleFormWidget" );' ) );


function gform_shortcode( $atts ) {

	extract( shortcode_atts( array(
		'title' => '',
		'url' => '',
		'redirect_url' => '',
	), $atts ));

	$instance = array(
        'title' => $title,
        'url' => $url,
        'redirect_url' => $redirect_url
        );
        
	$args = array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
        'form_type' => 'Long'
        );
        
    ob_start();
    the_widget( 'GoogleFormWidget', $instance, $args );
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

/* Add a shortcode for the widget also */
add_shortcode( 'gform', 'gform_shortcode' );

?>