<?php 

	/**
	 * COVER - BLOG TITLE
	 */
	
	$background_image = ( function_exists('z_taxonomy_image_url') && z_taxonomy_image_url() != "" ? z_taxonomy_image_url() : get_theme_mod('blogcover_background') );

?>

	<section class="cover front" data-height="65">
		<div class="background" style="background-image:url('<?php echo esc_url($background_image); ?>');"></div>
		<?php get_template_part('layouts/header_bloginfo'); ?>
		<section class="categorytitle wrapper">
			<h1 class="name"><?php esc_html(single_cat_title()); ?></h1>
			<?php echo category_description(); ?>
		</section>
		<div class="mouse">
			<div class="scroll"></div>
		</div>
	</section>