<?php

	/**
	 * Plugin Name:			Ecko Plugin
	 * Plugin URI:			http://ecko.me
	 * Description:			Shortcodes and Widgets for the EckoThemes WordPress Themes
	 * Version:				1.6.0
	 * Author:				EckoThemes
	 * Author URI:			http://ecko.me
	 * License:				GPL-2.0+
	 * License URI:			http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:			eckoshortcodes
	 *
	 * @link              http://ecko.me
	 * @since             1.6.0
	 * @package           Ecko_Plugin
	 * 
	 */


	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	define( 'ECKO_VERSION', '1.6.0' );
	define( 'ECKO_DIR', ABSPATH . 'wp-content/plugins/eckoplugin' );
	define( 'ECKO_URL', plugins_url( '', __FILE__ ));

	include (ECKO_DIR . '/inc/ecko-shortcodes.php');
	include (ECKO_DIR . '/inc/ecko-widgets.php');


?>