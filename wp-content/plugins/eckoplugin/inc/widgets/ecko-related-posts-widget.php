<?php

	/*-----------------------------------------------------------------------------------*/
	/* RELATED POSTS WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_related_posts extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_related_posts', 
				'Ecko Related Posts', 
				array( 'description' => 'Display related blog posts (post pages only).' )
			);
		}

		public function widget( $args, $instance ) {
			global $post;
			$ecko_related_posts = get_posts( array (
				'numberposts' => $instance['postcount'],
				'category__in' => wp_get_post_categories($post->ID),
				'meta_key'    	=> '_thumbnail_id',
				'post__not_in' 	=> array( $post->ID ),
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array( 
							'post-format-aside',
							'post-format-audio',
							'post-format-chat',
							'post-format-gallery',
							'post-format-image',
							'post-format-link',
							'post-format-quote',
							'post-format-status',
							'post-format-video'
						),
						'operator' => 'NOT IN'
					)
				)
			));
			if(count($ecko_related_posts) > 0){ 
				?>
					<section class="widget relatedposts">
						<?php if($instance['title'] != '') { ?>
							<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
							<hr>
						<?php }
							foreach ( $ecko_related_posts as $post ) : setup_postdata( $post ); 
								$ecko_thumb_id = get_post_thumbnail_id();
								$ecko_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sidebar');
						?>
						<article>
							<a href="<?php esc_url(the_permalink()); ?>" class="feature"><img src="<?php echo esc_attr($ecko_thumb_url[0]); ?>" alt="<?php esc_attr(the_title()); ?>"></a>
							<h4><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h4>
							<div class="meta">
								<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><?php esc_html(the_author()); ?></a>
								<span class="divider">/</span>
								<a href="<?php esc_url(the_permalink()); ?>" class="date"><?php esc_html(ecko_date_format()); ?></a>
							</div>
						</article>
						<?php 
							endforeach; 
							wp_reset_postdata();
						?>
					</section>
				<?php
			}
		}

		public function form( $instance ) { 
			$defaults = array( 
				'title' => '',
				'postcount' => '3'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Number of Posts to show: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" type="number" value="<?php echo esc_attr( $instance['postcount'] ); ?>" min="1" max="6" />
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