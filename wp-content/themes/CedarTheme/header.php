<?php

	/**
	 * HEADER TEMPLATE
	 */

?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

	<meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
	<?php if(get_theme_mod('general_fav_icon') != ''){ ?>
	<link rel="icon" href="<?php echo esc_url(get_theme_mod('general_fav_icon')) ?>" type="image/x-icon"/>
	<?php } ?>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php ecko_tag_schema(); ?>>

	<?php get_template_part('layouts/header_fixed'); ?>
	<?php get_template_part('layouts/search_overlay'); ?>
	<?php get_template_part('layouts/drawer'); ?>

	<main itemscope itemtype="http://schema.org/Article" class="pagewrapper">