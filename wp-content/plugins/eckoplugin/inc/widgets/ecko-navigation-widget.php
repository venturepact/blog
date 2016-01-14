<?php

	/*-----------------------------------------------------------------------------------*/
	/* NAVIGATION WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_navigation extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_navigation', 
				'Ecko Navigation', 
				array( 'description' => 'Display the primary theme navigation.' )
			);
		}

		public function widget( $args, $instance ) {
			?>
				<section class="widget navigation">
					<?php if($instance['title'] != '') { ?>
						<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
						<hr>
					<?php } ?>
					<?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'primary', 'container' => false ) ); ?>
				</section>
			<?php
		}

		public function form( $instance ) { 
			$defaults = array( 
				'title' => ''
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</p>
			<?php
		}
			
		public function update( $new_instance, $old_instance ) { 
			$instance = array();
			foreach ($new_instance as $key => $value) {
				$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? strip_tags( $new_instance[$key] ) : '';
			}
			return $instance;
		}

	}

?>