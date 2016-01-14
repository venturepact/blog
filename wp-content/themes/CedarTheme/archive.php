<?php 

	/**
	 * ARCHIVE TEMPLATE
	 */

	get_header(); 

?>

	<?php get_template_part('layouts/cover_blogtitle'); ?>

	<section class="altpageheader">
		<div class="wrapper">
			<i class="fa fa-clock-o"></i>
			<span class="name">
				<?php if (is_day()) { ?>
					<span class="message"><?php esc_html(the_time('F jS, Y')); ?></span>
				<?php } elseif (is_month()) { ?>
					<span class="message"><?php esc_html(the_time('F, Y')); ?></span>
				<?php } elseif (is_year()) { ?>
					<span class="message"><?php esc_html(the_time('Y')); ?></span>
				<?php } ?>
			</span>
			<span class="postcount"><?php echo esc_html(count($posts)); ?></span>
		</div>
	</section>

	<?php get_template_part('layouts/postlist'); ?>
	<?php get_template_part('layouts/footer_main'); ?>

<?php get_footer(); ?>