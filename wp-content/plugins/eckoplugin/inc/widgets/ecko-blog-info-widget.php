<?php 

	/*-----------------------------------------------------------------------------------*/
	/* BLOG INFO WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_blog_info extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_blog_info', 
				'Ecko Blog Info', 
				array( 'description' => 'Display blog logo and description.' ) 
			);
		}

		public function widget( $args, $instance ) {
			?>
				<section class="widget blog_info">
					<?php if(get_theme_mod('general_blog_image') != ""){ ?>
					<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(get_theme_mod('general_blog_image')); ?>" alt="<?php esc_attr(bloginfo('name')); ?>"></a>
					<?php }else{ ?>
					<a href="<?php echo esc_url(home_url()); ?>"><h1><?php esc_html(bloginfo('name')); ?></h1></a>
					<?php } ?>
					<p><?php echo esc_html(get_theme_mod('general_blog_description')); ?></p>
				</section>
			<?php
		}

		public function form( $instance ) { 
			$defaults = array(
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<br>
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