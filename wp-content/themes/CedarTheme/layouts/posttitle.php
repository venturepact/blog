<?php 

	/**
	 * COVER - BLOG TITLE
	 */
	
	if(has_post_thumbnail()){
		$post_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'background' );
		$post_image = $post_image[0];
	}

	$cedar_cover_enabled_meta = get_post_meta($post->ID, 'cedar_cover_enabled', true);

	$cedar_cover_height_meta = get_post_meta($post->ID, 'cedar_cover_height', true);
	$cedar_cover_height_meta = (!empty($cedar_cover_height_meta) ? get_post_meta($post->ID, 'cedar_cover_height', true) : 100 );

	$cedar_cover_color_meta = get_post_meta($post->ID, 'cedar_cover_color', true);
	$cedar_cover_color_meta = (!empty($cedar_cover_color_meta) ? get_post_meta($post->ID, 'cedar_cover_color', true) : '101010' );

	$cedar_cover_opacity_meta = get_post_meta($post->ID, 'cedar_cover_opacity', true);
	$cedar_cover_opacity_meta = (!empty($cedar_cover_opacity_meta) ? (get_post_meta($post->ID, 'cedar_cover_opacity', true) / 100) : '0.2' );

	$cedar_title_center_meta = (get_post_meta($post->ID, 'cedar_title_center', true) == "yes" ? $class = "middle" : $class = "" );

	$cedar_subtitle_meta = get_post_meta($post->ID, 'cedar_subtitle', true);
	$cedar_subtitle_meta = (!empty($cedar_subtitle_meta) ? get_post_meta($post->ID, 'cedar_subtitle', true) : "" );

	if($cedar_cover_enabled_meta == "yes"){

?>

	<section class="cover" style="background-color:#<?php echo esc_attr($cedar_cover_color_meta); ?>; height:<?php echo esc_attr($cedar_cover_height_meta); ?>vh;" data-height="<?php echo esc_attr($cedar_cover_height_meta); ?>" data-opacity="<?php echo esc_attr($cedar_cover_opacity_meta); ?>">
		<div class="background" style="background-image:url('<?php echo esc_url($post_image); ?>');"></div>
		<?php get_template_part('layouts/header_bloginfo'); ?>
		<section class="postitem posttitle center wrapper <?php echo $class; ?>">
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
				<li class="date"><a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php echo esc_html(ecko_date_format()); ?></time></a></li>
			</ul>
			<h1 class="title" itemprop="name headline"><?php the_title(); ?></h1>
			<?php if(!empty($cedar_subtitle_meta)){ ?>
				<p class="excerpt"><?php echo esc_html($cedar_subtitle_meta); ?></p>
			<?php } ?>
			<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" alt="<?php the_author(); ?>"><?php the_author(); ?></a>
		</section>
		<div class="mouse">
			<div class="scroll"></div>
		</div>
	</section>

<?php }else { ?>

	<section class="postitem posttitle single wrapper <?php echo $class; ?>">
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
			<li class="date"><a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('Y-m-d'); ?>" itemprop="datePublished"><?php echo esc_html(ecko_date_format()); ?></time></a></li>
		</ul>
		<h1 class="title" itemprop="name headline"><?php the_title(); ?></h1>
		<?php if(!empty($cedar_subtitle_meta)){ ?>
			<p class="excerpt"><?php echo esc_html($cedar_subtitle_meta); ?></p>
		<?php } ?>
		<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" alt="<?php the_author(); ?>"><?php the_author(); ?></a>
	</section>

<?php } ?>