<?php 

	/**
	 * POST INFO
	 */

?>

	<section class="postbottom wrapper">
		<div class="info">
			<div class="tags">
				<?php echo get_the_tag_list(); ?>
			</div>
			<?php 
				$post_category = get_the_category();
				if ($post_category) {
					$color_option = get_option('category_meta_' . $post_category[0]->term_id . '_color');
					if(!empty($color_option)){ $color = get_option('category_meta_' . $post_category[0]->term_id . '_color'); }else{ $color = '0085c3'; };
					echo '<a class="category" style="background:#' . $color . ';" href="' . esc_url(get_category_link( $post_category[0]->term_id )) . '">' . esc_html($post_category[0]->name) . '</a>';
				} 
			?>
		</div>
		<div class="shareoptions">
			<a href="<?php the_permalink(); ?>" class="permalink"><?php esc_html_e('Permalink', ECKO_THEME_ID); ?>: <?php the_permalink(); ?></a>
			<ul class="sharebuttons">
				<li><?php esc_html_e('Share', ECKO_THEME_ID); ?>:</li>
				<li><a href="http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;" class="socialdark twitter"><i class="fa fa-twitter"></i></a></li>
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;" class="socialdark facebook"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;" class="socialdark google"><i class="fa fa-google-plus"></i></a></li>
				<li><a href="mailto:?body=<?php the_permalink(); ?>" class="socialdark email"><i class="fa fa-envelope"></i></a></li>
			</ul>
		</div>
	</section>