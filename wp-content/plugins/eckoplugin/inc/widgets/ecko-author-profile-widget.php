<?php 

	/*-----------------------------------------------------------------------------------*/
	/* SOCIAL PROFILE WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_author_profile extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_author_profile', 
				'Ecko Author Profile', 
				array( 'description' => 'Display author bio and social links (post & custom pages only).' ) 
			);
		}

		public function widget( $args, $instance ) {
			if(is_single() || is_page()){
				global $post;
				setup_postdata( $post );
			?>
				<section class="widget authorprofile">
					<div class="info" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
						<?php if(isset($instance['disable_author_url'])){ ?>
						<div class="profile gravatar"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=80" itemprop="image" alt="<?php esc_attr(the_author()); ?>" ></div>
						<?php }else{ ?>
						<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="profile gravatar"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=80" itemprop="image" alt="<?php esc_attr(the_author()); ?>" ></a>
						<?php } ?>
						<div class="meta">
							<span class="title"><?php esc_html_e('Author', ECKO_THEME_VERSION); ?></span>
							<h3 itemprop="name">
								<?php if(isset($instance['disable_author_url'])){ ?>
								<span href="<?php ecko_get_author_url(); ?>" itemprop="url" rel="author"><?php esc_html(the_author()); ?></span>
								<?php }else{ ?>
								<a href="<?php ecko_get_author_url(); ?>" itemprop="url" rel="author"><?php esc_html(the_author()); ?></a>
								<?php } ?>
							</h3>
							<?php if(get_the_author_meta('twitter_handle') != "") { ?><a href="http://twitter.com/<?php echo esc_attr(get_the_author_meta('twitter_handle')); ?>" target="_blank" class="twittertag">@<?php echo esc_html(get_the_author_meta('twitter_handle')); ?></a><?php } ?>
						</div>
					</div>
					<p><?php echo esc_html(get_the_author_meta('description')); ?></p>
					<ul class="authorsocial">
						<?php if(get_the_author_meta('twitter') != ''){ ?>
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
				</section>
			<?php
				}
		}
				
		public function form( $instance ) { 
			$defaults = array(
				'disable_author_url' => 'off'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'disable_author_url' ); ?>">Disable Author URL: </label> 
					<input id="<?php echo $this->get_field_id( 'disable_author_url' ); ?>" name="<?php echo $this->get_field_name( 'disable_author_url' ); ?>" type="checkbox" <?php checked($instance['disable_author_url'], 'on'); ?> />
				</p> 
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