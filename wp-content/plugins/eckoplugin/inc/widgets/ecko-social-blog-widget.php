<?php

	/*-----------------------------------------------------------------------------------*/
	/* SOCIAL (BLOG) WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_social_blog extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_social_blog', 
				'Ecko Social (Blog)', 
				array( 'description' => 'Display blog specific social profiles.' )
			);
		}

		public function widget( $args, $instance ) {
			?>
				<section class="widget social">
					<?php if($instance['title'] != '') { ?>
						<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
						<hr>
					<?php } ?>
					<nav class="social">
						<ul>
							<?php foreach ($instance as $key => $value) { ?>
								<?php if($value != '' && $value != 'http://' && $key != 'title'){ ?>
									<li><a href="<?php echo esc_url($value); ?>" target="_blank" class="socialdark <?php echo esc_attr($key); ?>"><i class="fa fa-<?php echo esc_attr($key); ?>"></i></a></li>
								<?php }elseif(get_theme_mod('social_' . $key)){ ?>
									<li><a href="<?php echo esc_url(get_theme_mod('social_' . $key)); ?>" target="_blank" class="socialdark <?php echo esc_attr($key); ?>"><i class="fa fa-<?php echo esc_attr($key); ?>"></i></a></li>
								<?php } ?>
							<?php } ?>
						</ul>
					</nav>
				</section>
			<?php
		}

		public function form( $instance ) { 
			$defaults = array( 
				'title' => '',
				'twitter' => 'http://',
				'facebook' => 'http://',
				'github' => 'http://',
				'youtube' => 'http://',
				'dribbble' => 'http://',
				'google-plus' => 'http://',
				'instagram' => 'http://',
				'linkedin' => 'http://',
				'pinterest' => 'http://',
				'skype' => 'http://',
				'tumblr' => 'http://',
				'flickr' => 'http://',
				'reddit' => 'http://',
				'stackoverflow' => 'http://',
				'twitch' => 'http://',
				'vine' => 'http://',
				'vk' => 'http://',
				'vimeo' => 'http://',
				'weibo' => 'http://',
				'soundcloud' => 'http://',
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>By default the social profiles in the theme customizer will be used. If an option is set below it will override the customizer setting for that social link.</p>
			<?php
			foreach ($defaults as $key => $value) {
			?>
				<p>
					<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo ucwords($key); ?>: </label> 
					<input id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr( $instance[$key] ); ?>" />
				</p>
			<?php
			}
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