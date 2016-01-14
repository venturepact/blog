<?php 

	/**
	 * POSTLIST
	 */

?>
	
	<?php if( have_posts() ): ?>
		
		<section class="postlist">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php 				

					$post_format = (get_post_format() === false) ? "standard" : get_post_format();

					switch($post_format){
						case "standard":
							include(locate_template('postformat/standard.php'));
							break;
						case "status":
							include(locate_template('postformat/status.php'));
							break;
						case "aside":
							include(locate_template('postformat/status.php'));
							break;
						case "quote":
							include(locate_template('postformat/quote.php'));
							break;
						case "video":
							include(locate_template('postformat/video.php'));
							break;
						case "audio":
							include(locate_template('postformat/video.php'));
							break;
						case "image":
							include(locate_template('postformat/image.php'));
							break;
						default:
							include(locate_template('postformat/standard.php'));
							break;

				} ?>

			<?php endwhile; ?>
		</section>

		<?php get_template_part('layouts/pagination'); ?>

	<?php else : ?>

		<?php get_template_part('no-results'); ?>

	<?php endif; ?>