<!DOCTYPE html>
<!--[if IE 9]><html <?php xt_html_class('lt-ie10 no-js'); ?> <?php language_attributes(); ?>> <![endif]-->
<html <?php xt_html_class('no-js flexbox'); ?> <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="author" href="https://plus.google.com/106404212322025235145/posts/about">
		<link rel="publisher" href="https://plus.google.com/106404212322025235145/posts/about">

		<?php wp_head(); ?>	
	</head>
	<body <?php body_class(); ?>>
	
		<?php get_template_part('parts/facebook', 'init'); ?>

		<?php do_action('xt_after_body');?>
		
		<div class="body_overlay"></div>

		<div id="pusher" class="off-canvas-wrap closed" data-offcanvas>
			<div id="wrapper" class="container inner-wrap">

				<?php 
				$push_menu = xt_option('push-menu-position');
				if($push_menu != "disabled") {

					if($push_menu == "left")
						get_template_part('parts/menu', 'push-left');
					
					else
						get_template_part('parts/menu', 'push-right');

				}
				?>
				
				
					<!-- Header -->
					<header id="main-header">
						
						<?php get_template_part('parts/menu', 'top'); ?>
	
						<?php get_template_part('parts/menu', 'main'); ?>
						
						<?php get_template_part('parts/page', 'header'); ?>
		<div id="outer_wrapper" class="outer_wrapper">

					</header>
					<!-- End Header -->
										
					<?php global $page_container_no_padding; ?>
										
					<!-- Main Page Content and Sidebar -->
					<div id="inner_wrapper" class="<?php echo (!empty($page_container_no_padding) ? 'inner_wrapper no-padding' : 'inner_wrapper'); ?> hide-on-mobile-menu">
					