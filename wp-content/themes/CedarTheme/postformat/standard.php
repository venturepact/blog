<?php

	/**
	 * STANDARD POST TEMPLATE
	 */
	
	$cedar_postlist_image_meta = (get_post_meta($post->ID, 'cedar_postlist_image', true) == "yes" ? true : false );
	if(has_post_thumbnail()){
		$post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single' );
		$post_image = $post_image[0];
	}


?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("postitem"); ?>>
		<div class="wrapper">
			<?php if($cedar_postlist_image_meta){ ?>
			<a href="<?php the_permalink(); ?>" class="content postimage" style="background-image:url('<?php echo esc_url($post_image); ?>');"></a>
			<?php } ?>
			<ul class="meta">
				<?php 
					$post_category = get_the_category();
					if ($post_category) {
						$color_option = get_option('category_meta_' . $post_category[0]->term_id . '_color');
						if(!empty($color_option)){ $color = get_option('category_meta_' . $post_category[0]->term_id . '_color'); }else{ $color = '0085c3'; };
						echo '<li class="category"><a style="background:#' . $color . ';" href="' . esc_url(get_category_link( $post_category[0]->term_id )) . '">' . esc_html($post_category[0]->name) . '</a></li> ';
					} 
				?>
				<li class="issticky"><i class="fa fa-thumb-tack"></i></li>
				<!--removed read time-->
				<li class="date"><a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('Y-m-d'); ?>"><?php echo esc_html(ecko_date_format()); ?></time></a></li>
			</ul>
			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="excerpt"><?php echo ecko_truncate_by_words(get_the_excerpt(), 340, ' [...]'); ?></p>
			<!--<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" alt="<?php the_author(); ?>"><?php the_author(); ?></a>-->

<ul class="meta" style="margin-top:20px;"><li class="readtime" style="float:left"><a href="<?php the_permalink(); ?>"><?php echo ecko_estimated_reading_time(); ?> <?php esc_html_e('Min Read', ECKO_THEME_ID); ?></a></li></ul>

		</div>
	</article>