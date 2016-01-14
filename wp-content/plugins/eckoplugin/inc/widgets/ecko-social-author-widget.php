<?php

	/*-----------------------------------------------------------------------------------*/
	/* SOCIAL (AUTHOR) WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_social_author extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_social_author', 
				'Ecko Social (Author)', 
				array( 'description' => 'Display author specific social profiles.' )
			);
		}

		public function widget( $args, $instance ) {
			global $post;
			?>
				<section class="widget social">
					<?php if($instance['title'] != '') { ?>
						<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
						<hr>
					<?php } ?>
					<nav class="social">
						<ul>
							<?php if(get_the_author_meta('twitter', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('twitter', $post->post_author)); ?>" target="_blank" class="socialdark twitter"><i class="fa fa-twitter"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('facebook', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('facebook', $post->post_author)); ?>" target="_blank" class="socialdark facebook"><i class="fa fa-facebook"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('google-plus', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('google-plus', $post->post_author)); ?>" target="_blank" class="socialdark google"><i class="fa fa-google-plus"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('dribbble', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('dribbble', $post->post_author)); ?>" target="_blank" class="socialdark dribbble"><i class="fa fa-dribbble"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('instagram', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('instagram', $post->post_author)); ?>" target="_blank" class="socialdark instagram"><i class="fa fa-instagram"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('github', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('github', $post->post_author)); ?>" target="_blank" class="socialdark github"><i class="fa fa-github"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('youtube', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('youtube', $post->post_author)); ?>" target="_blank" class="socialdark youtube"><i class="fa fa-youtube"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('pinterest', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('pinterest', $post->post_author)); ?>" target="_blank" class="socialdark pinterest"><i class="fa fa-pinterest"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('linkedin', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('linkedin', $post->post_author)); ?>" target="_blank" class="socialdark linkedin"><i class="fa fa-linkedin"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('skype', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('skype', $post->post_author)); ?>" target="_blank" class="socialdark skype"><i class="fa fa-skype"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('tumblr', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('tumblr', $post->post_author)); ?>" target="_blank" class="socialdark tumblr"><i class="fa fa-tumblr"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('flickr', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('flickr', $post->post_author)); ?>" target="_blank" class="socialdark flickr"><i class="fa fa-flickr"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('reddit', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('reddit', $post->post_author)); ?>" target="_blank" class="socialdark reddit"><i class="fa fa-reddit"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('stack-overflow', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('stack-overflow', $post->post_author)); ?>" target="_blank" class="socialdark stack-overflow"><i class="fa fa-stack-overflow"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('twitch', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('twitch', $post->post_author)); ?>" target="_blank" class="socialdark twitch"><i class="fa fa-twitch"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('vine', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('vine', $post->post_author)); ?>" target="_blank" class="socialdark vine"><i class="fa fa-vine"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('vk', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('vk', $post->post_author)); ?>" target="_blank" class="socialdark vk"><i class="fa fa-vk"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('vimeo', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('vimeo', $post->post_author)); ?>" target="_blank" class="socialdark vimeo"><i class="fa fa-vimeo-square"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('weibo', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('weibo', $post->post_author)); ?>" target="_blank" class="socialdark weibo"><i class="fa fa-weibo"></i></a></li>
							<?php } ?>
							<?php if(get_the_author_meta('soundcloud', $post->post_author) != ''){ ?>
								<li><a href="<?php echo esc_url(get_the_author_meta('soundcloud', $post->post_author)); ?>" target="_blank" class="socialdark soundcloud"><i class="fa fa-soundcloud"></i></a></li>
							<?php } ?>
						</ul>
					</nav>
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
				<p>Author social profile links can be set within the author specific WordPress settings. Found within 'Users' -> 'All Users' -> 'Edit'.</p>
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