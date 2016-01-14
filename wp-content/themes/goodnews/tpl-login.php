<?php
/**
 * Template Name: Login
 */

if ( is_user_logged_in() ) {
	wp_redirect(home_url('/'));
	exit;
}
get_header();
?>

<div class="row tpl-login">
  	<div class="small-12 medium-7 small-centered columns">
	  
	  	<?php the_content(); ?>
	  	<?php echo do_shortcode('[ajax_login]');?>

	</div>
</div>


<?php
get_footer();
