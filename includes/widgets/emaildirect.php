<?php


class EmailDirectWidget extends WP_Widget {

	function EmailDirectWidget() {
	
		/* Create the widget. */
		parent::WP_Widget(false, 'EmailDirect Widget', array( 'description' => 'Displays a form from EmailDirect' ));
	}

	/* Echo output through the admin console */
	function form( $instance ) { 
	
        $url = esc_attr( $instance['url'] );
        ?>
            <p>
            <label for="<?php echo $this->get_field_id('url'); ?>">
            <?php _e('URL:'); ?>
            <input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
            </label>
            </p>
            
        <?php 
	}

    function update( $new_instance, $old_instance ) {				
		
		$new_instance['url'] = strip_tags( $new_instance['url'] );

		$new_instance['contents'] = "";
        
        if( !empty( $new_instance['url'] ) ) {
			$new_instance['contents'] = file_get_contents( $new_instance['url'] );
		}

		return $new_instance;
    }
    
	/* Echo the content of the widget */
    function widget( $args, $instance ) {
    
        extract( $args );
    
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Output widget content */

		?>
		
		<div class="emaildirectwidget">
		
		<?php
		
		$contents = $instance['contents'];
		
		/* Point the form to the proper URL */
		$pattern = '/(action=[\'\"]?)[^\'\"\s]*/i';
		$replacement = '$1' . $instance['url'];
		$contents = preg_replace( $pattern, $replacement, $contents );

		echo $contents;
		
		?>

		</div>
		
		<?php		
		
  		/* After widget (defined by themes). */
		echo $after_widget;
    }
}


/* Register the widget */
add_action( 'widgets_init', create_function('', 'return register_widget( "EmailDirectWidget" );') );

?>