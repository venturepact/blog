<?php

	/**
	 * QUOTE
	 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("postitem"); ?>>
		<div class="wrapper">
			<div class="content"><?php echo the_content(); ?></div>
		</div>
	</article>