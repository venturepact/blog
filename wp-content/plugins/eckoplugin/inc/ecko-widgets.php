<?php

	/**
	 * 
	 * ECKO WIDGETS
	 * 
	 */

	include (ECKO_DIR . '/inc/widgets/ecko-blog-info-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-share-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-social-author-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-social-blog-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-twitter-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-subscribe-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-author-profile-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-latest-posts-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-related-posts-widget.php');
	include (ECKO_DIR . '/inc/widgets/ecko-navigation-widget.php');


	/*-----------------------------------------------------------------------------------*/
	/* LOAD CUSTOM WIDGETS
	/*-----------------------------------------------------------------------------------*/

	function ecko_load_widgets() {
		register_widget( 'ecko_widget_blog_info' );
		register_widget( 'ecko_widget_share' );
		register_widget( 'ecko_widget_subscribe' );
		register_widget( 'ecko_widget_twitter' );
		register_widget( 'ecko_widget_social_author' );
		register_widget( 'ecko_widget_social_blog' );
		register_widget( 'ecko_widget_author_profile' );
		register_widget( 'ecko_widget_latest_posts' );
		register_widget( 'ecko_widget_related_posts' );
		register_widget( 'ecko_widget_navigation' );
	}
	add_action( 'widgets_init', 'ecko_load_widgets' );

?>