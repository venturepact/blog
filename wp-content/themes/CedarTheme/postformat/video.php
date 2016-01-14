<?php

	/**
	 * VIDEO POST FORMAT
	 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("postitem"); ?>>
		<div class="wrapper">
			<div class="content"><?php echo the_content(); ?></div>
			<ul class="meta">
				<?php 
					$post_category = get_the_category();
					if ($post_category) {
						$color_option = get_option('category_meta_' . $post_category[0]->term_id . '_color');
						if(!empty($color_option)){ $color = get_option('category_meta_' . $post_category[0]->term_id . '_color'); }else{ $color = '0085c3'; };
						echo '<li class="category"><a style="background:#' . $color . ';" href="' . esc_url(get_category_link( $post_category[0]->term_id )) . '">' . esc_html($post_category[0]->name) . '</a></li> ';
					} 
				?>
				<li class="readtime"><a href="<?php the_permalink(); ?>"><?php echo ecko_estimated_reading_time(); ?> <?php esc_html_e('Min Read', ECKO_THEME_ID); ?></a></li>
				<li class="date"><a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('Y-m-d'); ?>"><?php echo esc_html(ecko_date_format()); ?></time></a></li>
			</ul>
			<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="excerpt"><?php echo ecko_truncate_by_words(get_the_excerpt(), 340, ' [...]'); ?></p>
			<!--<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" alt="<?php the_author(); ?>"><?php the_author(); ?></a>-->
		</div>
	</article>