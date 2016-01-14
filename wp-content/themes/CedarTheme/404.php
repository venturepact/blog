<?php 

	/**
	 * ERROR 404 TEMPLATE
	 */

	get_header(); 

?>

	<section class="cover front">
		<div class="background" style="background-image:url('<?php echo esc_url(get_theme_mod('blogcover_background')); ?>');"></div>
		<?php get_template_part('layouts/header_bloginfo'); ?>
		<section class="blogtitle wrapper">
			<h1><?php esc_html_e('Error', ECKO_THEME_ID); ?> 404</h1>
			<p class="description">
				<?php esc_html_e('The page you were looking for cannot be found, it may have been moved or no longer exists. You can navigate back to the homepage by clicking', ECKO_THEME_ID); ?> <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('here', ECKO_THEME_ID); ?></a>.
			</p>
		</section>
		<div class="mouse">
			<div class="scroll"></div>
		</div>
	</section>
	
<?php get_footer(); ?>