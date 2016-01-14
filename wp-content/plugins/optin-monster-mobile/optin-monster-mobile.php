<?php
/**
 * Plugin Name: OptinMonster - Mobile Addon
 * Plugin URI:  http://optinmonster.com
 * Description: Adds a new optin type - Mobile - to the available optins.
 * Author:      Thomas Griffin
 * Author URI:  http://thomasgriffinmedia.com
 * Version:     1.0.2
 * Text Domain: optin-monster-mobile
 * Domain Path: languages
 *
 * OptinMonster is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * OptinMonster is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OptinMonster. If not, see <http://www.gnu.org/licenses/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define necessary addon constants.
define( 'OPTIN_MONSTER_MOBILE_PLUGIN_NAME', 'OptinMonster - Mobile Addon' );
define( 'OPTIN_MONSTER_MOBILE_PLUGIN_VERSION', '1.0.2' );
define( 'OPTIN_MONSTER_MOBILE_PLUGIN_SLUG', 'optin-monster-mobile' );

add_action( 'plugins_loaded', 'optin_monster_mobile_plugins_loaded' );
/**
 * Ensures the full OptinMonster plugin is active before proceeding.
 *
 * @since 2.0.0
 *
 * @return null Return early if OptinMonster is not active.
 */
function optin_monster_mobile_plugins_loaded() {

    // Bail if the main class does not exist.
    if ( ! class_exists( 'Optin_Monster' ) ) {
        return;
    }

    // Fire up the addon.
    add_action( 'optin_monster_init', 'optin_monster_mobile_plugin_init' );

}

/**
 * Loads all of the addon hooks and filters.
 *
 * @since 2.0.0
 */
function optin_monster_mobile_plugin_init() {

    add_action( 'optin_monster_updater', 'optin_monster_mobile_updater' );
    add_filter( 'optin_monster_theme_types', 'optin_monster_mobile_filter_optin_type' );
    add_filter( 'optin_monster_themes', 'optin_monster_mobile_filter_optin_themes', 10, 2 );
    add_filter( 'optin_monster_theme_api', 'optin_monster_mobile_theme_api', 10, 4 );
    add_filter( 'optin_monster_optin_output', 'optin_monster_mobile_custom_overlay', 10, 2 );

}

/**
 * Initializes the addon updater.
 *
 * @since 2.0.0
 *
 * @param string $key The user license key.
 */
function optin_monster_mobile_updater( $key ) {

    $args = array(
        'plugin_name' => OPTIN_MONSTER_MOBILE_PLUGIN_NAME,
        'plugin_slug' => OPTIN_MONSTER_MOBILE_PLUGIN_SLUG,
        'plugin_path' => plugin_basename( __FILE__ ),
        'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . OPTIN_MONSTER_MOBILE_PLUGIN_SLUG,
        'remote_url'  => 'http://optinmonster.com/',
        'version'     => OPTIN_MONSTER_MOBILE_PLUGIN_VERSION,
        'key'         => $key
    );
    $optin_monster_slide_updater = new Optin_Monster_Updater( $args );

}

/**
 * Filters the optin types
 *
 * Use filter 'optin_monster_theme_types' in constructor and only
 * add new keys to the $types array.
 *
 * @since 2.0.0
 *
 * @param array $types
 *
 * @return array
 */
function optin_monster_mobile_filter_optin_type( $types ) {

    $types['mobile'] = __( 'Mobile', 'optin-monster-mobile' );
    return $types;

}

/**
 * Filters the optin themes
 *
 * Use filter 'optin_monster_themes', 10, 2 in constructor
 *
 * @param array  $themes Themes of the currently selected type
 * @param string $type   The selected type
 *
 * @since 2.0.0
 *
 * @return array The mobile themes
 */
function optin_monster_mobile_filter_optin_themes( $themes, $type ) {

    if ( 'mobile' !== $type ) {
        return $themes;
    }

    $themes = array(
        'agile'  => array(
            'name'  => __( 'Agile Theme', 'optin-monster-mobile' ),
            'image' => plugins_url( 'includes/themes/agile/images/icon.jpg', __FILE__ ),
            'file'  => __FILE__
        )
    );

    if ( defined( 'OPTIN_MONSTER_CANVAS_PLUGIN_VERSION' ) ) {
	    $themes['canvas'] = array(
		    'name'  => __( 'Canvas Theme', 'optin-monster-mobile' ),
            'image' => plugins_url( 'includes/themes/canvas/images/icon.jpg', __FILE__ ),
            'file'  => __FILE__
		);
    }

    return apply_filters( 'optin_monster_mobile_themes', $themes );

}

/**
 * Filters the current theme object
 *
 * @since 2.0.0
 *
 * @param object $api      The theme object to filter
 * @param string $theme    The currently selected theme slug
 * @param int    $optin_id The current optin ID
 * @param string $type     The current optin type
 *
 * @return mixed The correct theme object
 */
function optin_monster_mobile_theme_api( $api, $theme, $optin_id, $type ) {

	// Return early if this isn't a mobile optin.
	if ( 'mobile' != $type ) {
		return $api;
	}

    switch ( $theme ) {
        case 'agile' :
            if ( ! class_exists( 'Optin_Monster_Mobile_Theme_Agile' ) ) {
                require plugin_dir_path( __FILE__ ) . 'includes/themes/agile/agile.php';
            }
            $api = new Optin_Monster_Mobile_Theme_Agile( $optin_id );
            break;
        case 'canvas' :
            if ( ! class_exists( 'Optin_Monster_Mobile_Theme_Canvas' ) ) {
                require plugin_dir_path( __FILE__ ) . 'includes/themes/canvas/canvas.php';
            }
            $api = new Optin_Monster_Mobile_Theme_Canvas( $optin_id );
            break;
    }

    return $api;

}

/**
 * Adds a custom overlay to mobile optins.
 *
 * @since 2.0.0
 *
 * @param string $output The optin output.
 * @param int $id        The optin ID.
 * @return string        The custom mobile optin overlay.
 */
function optin_monster_mobile_custom_overlay( $output, $optin_id ) {

    $optin = Optin_Monster::get_instance()->get_optin( $optin_id );
    if ( ! $optin ) {
        return $output;
    }

    $meta = get_post_meta( $optin_id, '_om_meta', true );
    if ( isset( $meta['type'] ) && 'mobile' !== $meta['type'] ) {
        return $output;
    }

    return '<div id="om-' . $optin->post_name . '-overlay" class="optin-monster-mobile-overlay"></div>' . $output;

}