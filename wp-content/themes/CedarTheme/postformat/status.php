<?php

	/**
	 * STATUS / ASIDE POST TEMPLATE
	 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("postitem"); ?>>
		<div class="wrapper">
			<div class="content"><?php echo the_content(); ?></div>
			<!--<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" alt="<?php the_author(); ?>"><?php the_author(); ?></a>-->
		</div>
	</article>