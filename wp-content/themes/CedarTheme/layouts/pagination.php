<?php 

	/**
	 * PAGINATION
	 */

?>

	<?php if ($wp_query->max_num_pages > 1){ ?>
	<nav class="pagination">
		<div class="wrapper">
			<?php previous_posts_link('<span class="main">' . esc_html__('Newer Posts', ECKO_THEME_ID) . '</span><span class="sub"><i class="fa fa-chevron-right"></i></span>'); ?>
			<?php ecko_paging_nav(); ?>
			<?php next_posts_link('<span class="main">' . esc_html__('Older Posts', ECKO_THEME_ID) . '</span><span class="sub"><i class="fa fa-chevron-left"></i></span>'); ?>
		</div>
	</nav>
	<?php } ?>