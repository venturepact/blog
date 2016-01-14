<?php

	/*-----------------------------------------------------------------------------------*/
	/* SUBSCRIBE WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_subscribe extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_subscribe', 
				'Ecko Subscription', 
				array( 'description' => 'Subscription form for MailChimp.' ) 
			);
		}

		public function widget( $args, $instance ) {
			?>
				<section class="widget subscribe">
					<?php if($instance['title'] != '') { ?>
						<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
						<hr>
					<?php } ?>
					<p><?php echo esc_html($instance['description']); ?></p>
					<i class="fa fa-envelope-o"></i>
					<?php echo $instance['formcode']; ?>
				</section>
			<?php 
		}
				
		public function form( $instance ) {
			$defaults = array( 
				'title' => 'Subscribe', 
				'description' => '',
				'formcode' => ''
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'description' ); ?>">Description: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $instance['description'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'formcode' ); ?>">Form Embed Code: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'formcode' ); ?>" name="<?php echo $this->get_field_name( 'formcode' ); ?>" type="text" value="<?php echo esc_attr( $instance['formcode'] ); ?>" />
				</p>
			<?php
		}
			
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			foreach ($new_instance as $key => $value) {
				if($key == 'formcode'){ 
					$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? $new_instance[$key] : ''; 
				}else{
					$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? strip_tags( $new_instance[$key] ) : '';
				}
			}
			return $instance;
		}

	}

?>