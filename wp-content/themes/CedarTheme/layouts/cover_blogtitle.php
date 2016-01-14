<?php 

	/**
	 * COVER - BLOG TITLE
	 */


	if(!get_theme_mod('blogcover_disable', false)){

		$cover_logo = "";
		if(get_theme_mod('blogcover_logo', false)){
			$cover_logo = get_theme_mod('blogcover_logo');
		}elseif(get_theme_mod('general_blog_image', false)){
			$cover_logo = get_theme_mod('general_blog_image');
		}

?>

	<section class="cover front" style="background-color:#101010; height:70vh;" data-height="60">
		<div class="background" style="background-image:url('<?php echo esc_url(get_theme_mod('blogcover_background')); ?>');">
			<meta itemprop="image" content="<?php echo esc_url(get_theme_mod('blogcover_background')); ?>">
		</div>
		<div class="patternbg"></div>
		<?php get_template_part('layouts/header_bloginfo'); ?>
		<?php if(!get_theme_mod('blogcover_use_sticky_post', false) || is_paged()){ ?>
		<section class="blogtitle wrapper">
			<?php if($cover_logo != ""){ ?>
				<a href="<?php echo esc_url(home_url()); ?>" class="logo"><img src="<?php echo esc_url($cover_logo); ?>" alt="<?php esc_attr(bloginfo('name')); ?>"></a>
			<?php }else{ ?>
				<a href="<?php echo esc_url(home_url()); ?>"><h1 itemprop="headline"><?php esc_html(bloginfo('name')); ?></h1></a>
			<?php } ?>
			<p class="description" itemprop="description"><?php echo esc_html(get_theme_mod('general_blog_description')); ?></p>
			<hr>
		</section>
		<?php 
			}else{ 
				ecko_get_latest_sticky_post();
		?>
		<section class="postitem posttitle center wrapper">
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
				<li class="readtime"><a href="<?php the_permalink(); ?>"><?php echo ecko_estimated_reading_time(); ?> <?php esc_html_e('Min Read', ECKO_THEME_ID); ?></a></li>
				<li class="date"><a href="<?php the_permalink(); ?>"><span itemprop="datePublished"><time datetime="<?php the_time('Y-m-d'); ?>"><?php echo esc_html(ecko_date_format()); ?></time></span></a></li>
			</ul>
			<h1 class="title" itemprop="name headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<p class="excerpt"><?php echo ecko_truncate_by_words(get_the_excerpt(), 230, ' [...]'); ?></p>
			<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" alt="<?php the_author(); ?>"><span itemprop="author" itemscope itemtype="http://schema.org/Person">
<span itemprop="name"><?php the_author(); ?></span></span></a>
			<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
				<meta itemprop="name" content="VenturePact">
			</span>
		</section>
		<?php } ?>
		<div class="mouse">
			<div class="scroll"></div>
		</div>
	</section>

<?php }else{ ?>

	<section class="headerspace"></section>

<?php } ?>