<?php 

	/*-----------------------------------------------------------------------------------*/
	/* SOCIAL SHARE WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_share extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_share', 
				'Ecko Share', 
				array( 'description' => 'Add Facebook, Twitter, Google+, Reddit, Pinterest & LinkedIn share buttons.' ) 
			);
		}

		public function widget( $args, $instance ) {
			?>
				<section class="widget socialshare">
					<?php if($instance['title'] != '') { ?>
						<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
						<hr>
					<?php } ?>
					<div class="options">
						<?php if(isset($instance['twitter'])){ ?><a href="http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;" class="sharebutton twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a><?php } ?>
						<?php if(isset($instance['facebook'])){ ?><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;" class="sharebutton facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a><?php } ?>
						<?php if(isset($instance['googleplus'])){ ?><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;" class="sharebutton google"><i class="fa fa-google-plus"></i><span>Google+</span></a><?php } ?>
						<?php if(isset($instance['reddit'])){ ?><a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>" onclick="window.open(this.href, 'reddit-share', 'width=490,height=530');return false;" class="sharebutton reddit"><i class="fa fa-reddit"></i><span>Reddit</span></a><?php } ?>
						<?php if(isset($instance['pinterest'])){ ?><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;description=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>" onclick="window.open(this.href, 'pinterest-share', 'width=490,height=530');return false;" class="sharebutton pinterest"><i class="fa fa-pinterest"></i><span>Pinterest</span></a><?php } ?>
						<?php if(isset($instance['linkedin'])){ ?><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=490,height=530');return false;" class="sharebutton linkedin"><i class="fa fa-linkedin"></i><span>LinkedIn</span></a><?php } ?>
					</div>
				</section>
			<?php
		}
				
		public function form( $instance ) { 
			$defaults = array( 
				'title' => '', 
				'twitter' => 'off',
				'facebook' => 'off',
				'googleplus' => 'off',
				'reddit' => 'off',
				'pinterest' => 'off',
				'linkedin' => 'off'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Enable Twitter Share: </label> 
					<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="checkbox" <?php checked($instance['twitter'], 'on'); ?> />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Enable Facebook Share: </label> 
					<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="checkbox" <?php checked($instance['facebook'], 'on'); ?> />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'googleplus' ); ?>">Enable Google+ Share: </label> 
					<input id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" type="checkbox" <?php checked($instance['googleplus'], 'on'); ?> />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'reddit' ); ?>">Enable Reddit Share: </label> 
					<input id="<?php echo $this->get_field_id( 'reddit' ); ?>" name="<?php echo $this->get_field_name( 'reddit' ); ?>" type="checkbox" <?php checked($instance['reddit'], 'on'); ?> />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'pinterest' ); ?>">Enable Pinterest Share: </label> 
					<input id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" type="checkbox" <?php checked($instance['pinterest'], 'on'); ?> />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">Enable LinkedIn Share: </label> 
					<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="checkbox" <?php checked($instance['linkedin'], 'on'); ?> />
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