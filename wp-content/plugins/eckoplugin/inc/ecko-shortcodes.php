<?php

	/**
	 * 
	 * ECKO SHORTCODES
	 * 
	 */

	/*-----------------------------------------------------------------------------------*/
	/* WORDPRESS HOOK
	/*-----------------------------------------------------------------------------------*/

	function ecko_short_code_highlight($atts, $content = null) {
		extract( shortcode_atts( array(
			'language' => 'javascript'
		), $atts, 'code_highlight' ) );
		$output = '<pre><code data-language="' . $language .'">' . $content . '</code></pre>';
		return $output;
	}

	function ecko_short_columns($atts, $content = null) {
		$output = '<div class="grid">' . do_shortcode($content) . '</div>';
		return $output;
	}

	function ecko_short_columns_left($atts, $content = null) {
		$output = '<div class="half left">' . do_shortcode($content) . '</div>';
		return $output;
	}

	function ecko_short_columns_right($atts, $content = null) {
		$output = '<div class="half right">' . do_shortcode($content) . '</div>';
		return $output;
	}

	function ecko_short_youtube($atts, $content = null) {
		$output = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $content . '" frameborder="0" allowfullscreen></iframe>';
		return $output;
	}

	function ecko_short_vimeo($atts, $content = null) {
		$output = '<iframe src="https://player.vimeo.com/video/' . do_shortcode($content) . '?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		return $output;
	}

	function ecko_short_annotated($atts, $content = null) {
		extract( shortcode_atts( array(
			'header' => '',
			'annotation' => '',
		), $atts, 'annotated' ) );
		$output = '<div class="annotation">';
		$output .= $content;
		$output .= '<div class="main"><h5>' . $header . '</h5>' . $annotation . '</div></div>';
		return $output;
	}

	function ecko_short_icon($atts, $content = null) {
		extract( shortcode_atts( array(
			'alias' => '#',
			'size' => '28px'
		), $atts, 'icon' ) );
		$output = '<i class="fa ' . $alias . '" style="font-size:' . $size . '"></i>';
		return $output;
	}

	function ecko_short_alert($atts, $content = null) {
		extract( shortcode_atts( array(
			'color' => ''
		), $atts, 'alert' ) );
		$output = '<div class="alert ' . $color . '">' . do_shortcode($content) . '</div>';
		return $output;
	}

	function ecko_short_button($atts, $content = null) {
		extract( shortcode_atts( array(
			'color' => '',
			'size' => 'normal',
			'url' => '#'
		), $atts, 'button' ) );
		$output = '<a href="' . $url . '" target="_blank" class="shortbutton ' . $color . ' ' . $size . '">' . do_shortcode($content) . '</a>';
		return $output;
	}

	function ecko_short_toggle($atts, $content = null) {
		extract( shortcode_atts( array(
			'title' => '',
			'state' => 'closed',
			'style' => ''
		), $atts, 'toggle' ) );
		$output = '<div class="shorttoggle ' . $style . ' ' . $state . '"><div class="toggleheader"><div class="left">' . $title . '</div><div class="right"><i class="fa fa-chevron-down"></i></div></div><div class="togglecontent">' . do_shortcode($content) .'</div></div>';
		return $output;
	}

	function ecko_short_tabs($atts, $content = null) {
		$output = '<div class="shorttabs"> ' . do_shortcode($content) . ' </div>';
		return $output;
	}

	function ecko_short_tabs_header($atts, $content = null) {
		extract( shortcode_atts( array(
			'id' => ''
		), $atts, 'tabs' ) );
		$output = '<div class="shorttabsheader" data-id="' . $id . '"> ' . do_shortcode($content) . ' </div>';
		return $output;
	}

	function ecko_short_tabs_content($atts, $content = null) {
		extract( shortcode_atts( array(
			'id' => ''
		), $atts, 'tabs' ) );
		$output = '<div class="shorttabscontent" data-id="' . $id . '"> ' . do_shortcode($content) . ' </div>';
		return $output;
	}

	function ecko_short_progress($atts) {
		extract( shortcode_atts( array(
			'percentage' => '80',
			'color' => ''
		), $atts, 'progress' ) );
		$output = '<div class="shortprogress"><div class="inner ' . $color . '" style="width:' . $percentage . '%;"></div><div class="percentage">' . $percentage . '%</div></div>';
		return $output;
	}

	function ecko_short_status_format($atts, $content = null) {
		$output = '<div class="statusmessage">' . do_shortcode($content) . '</div>';
		return $output;
	}

	function ecko_short_gallery_wrapper($atts, $content = null) {
		$output = '<ul class="gallery">' . do_shortcode($content) . '</ul>';
		return $output;
	}

	function ecko_short_gallery_item($atts, $content = null) {
		$output = '<li>' . do_shortcode($content) . '</li>';
		return $output;
	}

	function ecko_short_quote($atts, $content = null) {
		extract( shortcode_atts( array(
			'source' => ''
		), $atts, 'quote' ) );
		$output = '<blockquote>"' . do_shortcode($content) . '"<footer><cite>— ' . $source . '</cite></footer></blockquote>';
		return $output;
	}

	function ecko_short_link($atts, $content = null) {
		extract( shortcode_atts( array(
			'url' => ''
		), $atts, 'quote' ) );
		$output = '<a href="' . $url . '">' . $content . '</a>';
		return $output;
	}

	function ecko_short_wide($atts, $content = null) {
		$output = '<div class="wide">' . $content . '</div>';
		return $output;
	}

	function ecko_short_contrast($atts, $content = null) {
		$output = '</section><div class="postcontents full dark"><div class="wrapper">' . do_shortcode($content) . '</div></div><section class="postcontents wrapper">';
		return $output;
	}

	function ecko_short_fullpage_image($atts, $content = null) {
		$output = '</section><div class="postcontents full">' . do_shortcode($content) . '</div><section class="postcontents wrapper">';
		return $output;
	}


	/*-----------------------------------------------------------------------------------*/
	/* LOAD SHORTCODES
	/*-----------------------------------------------------------------------------------*/

	add_shortcode('ecko_code_highlight', 'ecko_short_code_highlight');
	add_shortcode('ecko_columns', 'ecko_short_columns');
	add_shortcode('ecko_columns_left', 'ecko_short_columns_left');
	add_shortcode('ecko_columns_right', 'ecko_short_columns_right');
	add_shortcode('ecko_youtube', 'ecko_short_youtube');
	add_shortcode('ecko_vimeo', 'ecko_short_vimeo');
	add_shortcode('ecko_annotated', 'ecko_short_annotated');
	add_shortcode('ecko_alert', 'ecko_short_alert');
	add_shortcode('ecko_button', 'ecko_short_button');
	add_shortcode('ecko_icon', 'ecko_short_icon');
	add_shortcode('ecko_toggle', 'ecko_short_toggle');
	add_shortcode('ecko_tabs', 'ecko_short_tabs');
	add_shortcode('ecko_tab_header', 'ecko_short_tabs_header');
	add_shortcode('ecko_tab_content', 'ecko_short_tabs_content');
	add_shortcode('ecko_progress', 'ecko_short_progress');
	add_shortcode('ecko_statusmessage', 'ecko_short_status_format');
	add_shortcode('ecko_gallery_main', 'ecko_short_gallery_wrapper');
	add_shortcode('ecko_gallery_item', 'ecko_short_gallery_item');
	add_shortcode('ecko_quote', 'ecko_short_quote');
	add_shortcode('ecko_link', 'ecko_short_link');
	add_shortcode('ecko_wide', 'ecko_short_wide');
	add_shortcode('ecko_contrast', 'ecko_short_contrast');
	add_shortcode('ecko_fullpage_image', 'ecko_short_fullpage_image');


	/*-----------------------------------------------------------------------------------*/
	/* SHORTCODE CONTENT FILTER
	/*-----------------------------------------------------------------------------------*/

	function ecko_the_content_filter($content) {
		$block = join("|",array("ecko_tab_header", "ecko_tab_content", "ecko_columns", "ecko_columns_left", "ecko_columns_right", "ecko_gallery_main", "ecko_gallery_item", "ecko_code_highlight"));
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
		return $rep;
	}

	add_filter('the_content', 'do_shortcode', 7);
	add_filter("the_content", "ecko_the_content_filter");


	/*-----------------------------------------------------------------------------------*/
	/* TINYMCE CONTROLS
	/*-----------------------------------------------------------------------------------*/

	function ecko_tinymce_init() {
		global $typenow;
		if( ! in_array( $typenow, array( 'post', 'page' ) ) )
			return ;
		add_filter( 'mce_external_plugins', 'ecko_tinymce_plugin' );
		add_filter( 'mce_buttons', 'ecko_tinymce_button' );
	}
	add_action( 'admin_head', 'ecko_tinymce_init' );

	function ecko_theme_css(){ 
		$active_theme = wp_get_theme();
		$active_theme = $active_theme->get('Name');
		$active_theme = explode(' ', $active_theme);
		?>
			 <style>
			 .mce-theme-specific{ display:none !important; }
			 .mce-theme-<?php echo $active_theme[0]; ?> { display:block !important; }
			 </style>
		<?php
	}
	add_action( 'admin_head', 'ecko_theme_css' );

	function ecko_tinymce_plugin( $plugin_array ) {
		$plugin_array['eckoshortcodes_options'] = ECKO_URL . '/assets/js/eckoshortcodes.js';
		return $plugin_array;
	}

	function ecko_tinymce_css() {
		wp_enqueue_style('eckoshortcodes_css', ECKO_URL . '/assets/css/eckoshortcodes.css' );
	}
	add_action( 'admin_enqueue_scripts', 'ecko_tinymce_css' );

	function ecko_tinymce_button( $buttons ) {
		array_push( $buttons, 'eckoshortcodes_button' );
		return $buttons;
	}


?>