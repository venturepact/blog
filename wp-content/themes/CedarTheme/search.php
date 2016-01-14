<?php 

	/**
	 * SEARCH TEMPLATE
	 */

	get_header(); 

?>

	<?php get_template_part('layouts/cover_blogtitle'); ?>

	<section class="altpageheader">
		<div class="wrapper">
			<i class="fa fa-search"></i><span class="name"><?php echo esc_html(get_search_query()); ?></span><span class="postcount"><?php echo esc_html(count($posts)); ?></span>
		</div>
	</section>

	<?php get_template_part('layouts/postlist'); ?>
	<?php get_template_part('layouts/footer_main'); ?>

<?php get_footer(); ?>