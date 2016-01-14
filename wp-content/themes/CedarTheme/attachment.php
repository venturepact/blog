<?php 

	/**
	 * ATTACHMENT TEMPLATE
	 */

	get_header(); 

?>

	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php get_template_part('layouts/posttitle'); ?>

		<section class="postcontents wrapper">
			<?php the_content(); ?>
		</section>

		<?php get_template_part('layouts/postbottom'); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>