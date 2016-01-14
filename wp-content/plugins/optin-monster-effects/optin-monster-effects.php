<?php
/**
 * Plugin Name: OptinMonster - Effects Addon
 * Plugin URI:  http://optinmonster.com
 * Description: Enables custom CCS3 animation effects to lightbox displays in OptinMonster.
 * Author:      Thomas Griffin
 * Author URI:  http://thomasgriffinmedia.com
 * Version:     2.0.0
 * Text Domain: optin-monster-effects
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
define( 'OPTIN_MONSTER_EFFECTS_PLUGIN_NAME', 'OptinMonster - Effects Addon' );
define( 'OPTIN_MONSTER_EFFECTS_PLUGIN_VERSION', '2.0.0' );
define( 'OPTIN_MONSTER_EFFECTS_PLUGIN_SLUG', 'optin-monster-effects' );

add_action( 'plugins_loaded', 'optin_monster_effects_plugins_loaded' );
/**
 * Ensures the full OptinMonster plugin is active before proceeding.
 *
 * @since 2.0.0
 *
 * @return null Return early if OptinMonster is not active.
 */
function optin_monster_effects_plugins_loaded() {

    // Bail if the main class does not exist.
    if ( ! class_exists( 'Optin_Monster' ) ) {
        return;
    }

    // Fire up the addon.
    add_action( 'optin_monster_init', 'optin_monster_effects_plugin_init' );

}

/**
 * Loads all of the addon hooks and filters.
 *
 * @since 2.0.0
 */
function optin_monster_effects_plugin_init() {

    add_action( 'optin_monster_updater', 'optin_monster_effects_updater' );
    add_action( 'optin_monster_admin_scripts', 'optin_monster_effects_scripts' );
    add_filter( 'optin_monster_panels', 'optin_monster_effects_panel', 10, 2 );
    add_filter( 'optin_monster_panel_content', 'optin_monster_effects_panel_content', 10, 4 );
    add_action( 'wp_ajax_load_optin_effect', 'optin_monster_effects_load_effect' );
    add_filter( 'optin_monster_save_optin', 'optin_monster_effects_save', 10, 3 );
    add_filter( 'optin_monster_theme_html', 'optin_monster_effects_load', 10, 4 );

}

/**
 * Initializes the addon updater.
 *
 * @since 2.0.0
 *
 * @param string $key The user license key.
 */
function optin_monster_effects_updater( $key ) {

    $args = array(
        'plugin_name' => OPTIN_MONSTER_EFFECTS_PLUGIN_NAME,
        'plugin_slug' => OPTIN_MONSTER_EFFECTS_PLUGIN_SLUG,
        'plugin_path' => plugin_basename( __FILE__ ),
        'plugin_url'  => trailingslashit( WP_PLUGIN_URL ) . OPTIN_MONSTER_EFFECTS_PLUGIN_SLUG,
        'remote_url'  => 'http://optinmonster.com/',
        'version'     => OPTIN_MONSTER_EFFECTS_PLUGIN_VERSION,
        'key'         => $key
    );
    $optin_monster_effects_updater = new Optin_Monster_Updater( $args );

}

/**
 * Registers and enqueues effects scripts.
 *
 * @since 2.0.0
 *
 * @param string $view The current OptinMonster admin view.
 */
function optin_monster_effects_scripts( $view ) {

    // If not on the edit view, return early.
    if ( 'edit' !== $view ) {
        return;
    }

    // Register and enqueue scripts.
    wp_register_script( OPTIN_MONSTER_EFFECTS_PLUGIN_SLUG . '-script', plugins_url( 'js/effects.js', __FILE__ ), array( 'jquery' ), OPTIN_MONSTER_EFFECTS_PLUGIN_VERSION, true );
    wp_enqueue_script( OPTIN_MONSTER_EFFECTS_PLUGIN_SLUG . '-script' );

}

/**
 * Adds the Effects panel to the customizer.
 *
 * @since 2.0.0
 *
 * @param array $panels  Array of customizer panels.
 * @param int $optin_id  The current optin ID.
 * @return array $panels Amended array of customizer panels.
 */
function optin_monster_effects_panel( $panels, $optin_id ) {

    // Return early if not the proper optin type.
    $meta = get_post_meta( $optin_id, '_om_meta', true );
    if ( isset( $meta['type'] ) && ( 'lightbox' !== $meta['type'] && 'canvas' !== $meta['type'] ) ) {
        return $panels;
    }

    $panels['effects'] = array(
        'name'    => __( 'Effects', 'optin-monster-effects' ),
        'icon'    => 'fa-cubes',
        'padding' => '6'
    );
    return $panels;

}

/**
 * Adds the Effects panel content to the customizer.
 *
 * @since 2.0.0
 *
 * @param string $content  The content of the panel.
 * @param string $panel_id The panel ID to target.
 * @param int $optin_id    The current optin ID.
 * @param object $instance The edit preview customizer object.
 * @return string $content Amended content for the custom panel.
 */
function optin_monster_effects_panel_content( $content, $panel_id, $optin_id, $instance ) {

    // Return early if not the proper panel ID.
    if ( 'effects' !== $panel_id ) {
        return $content;
    }

    // Return early if not the proper optin type.
    if ( isset( $instance->meta['type'] ) && ( 'lightbox' !== $instance->meta['type'] && 'canvas' !== $instance->meta['type'] ) ) {
        return $content;
    }

    $content = $instance->get_dropdown_field( 'effect', $instance->get_setting( 'effect', '', 'none' ), optin_monster_effects_list(), __( 'Optin Display Effect', 'optin-monster-effects' ), __( 'Shows the optin with a custom CSS3 animation.', 'optin-monster-effects' ) );
    return $content;

}

/**
 * Loads the requested effect from the ajax request.
 *
 * @since 2.0.0
 */
function optin_monster_effects_load_effect() {

    // Prepare variables.
    $effect = stripslashes( $_POST['effect'] );
    $id     = absint( $_POST['id'] );
    $meta   = get_post_meta( $id, '_om_meta', true );

    // Die and send back the theme and effect.
    die( json_encode( array( 'theme' => $meta['theme'], 'effect' => optin_monster_effects_get_effect( $effect, $meta['type'], $meta['theme'] ) ) ) );

}

/**
 * Saves the effect setting.
 *
 * @since 2.0.0
 *
 * @param array $meta   The meta for the optin in the "_om_meta" field.
 * @param int $optin_id The opton ID to target.
 * @param array $fields Array of $_POST fields with "optin-monster" key.
 * @return array $meta  Amended optin meta.
 */
function optin_monster_effects_save( $meta, $optin_id, $fields ) {

    // Return early if not the proper optin type.
    if ( isset( $meta['type'] ) && ( 'lightbox' !== $meta['type'] && 'canvas' !== $meta['type'] ) ) {
        return $meta;
    }

    $meta['effect'] = isset( $fields['effect'] ) ? esc_attr( $fields['effect'] ) : 'none';
    return $meta;

}

/**
 * Adds the effect output to the specified theme.
 *
 * @since 2.0.0
 *
 * @param string $html  The HTML output for the theme.
 * @param string $theme The OptinMonster theme slug.
 * @param int $optin_id The current optin ID.
 * @param object $api   The OptinMonster theme object.
 * @return string $html Amended HTML with the custom effect.
 */
function optin_monster_effects_load( $html, $theme, $optin_id, $api ) {

    // Return early if no effect has been requested.
    if ( empty( $api->meta['effect'] ) || isset( $api->meta['effect'] ) && 'none' == $api->meta['effect'] ) {
        return $html;
    }

    // Return early if not the proper optin type.
    if ( isset( $api->meta['type'] ) && ( 'lightbox' !== $api->meta['type'] && 'canvas' !== $api->meta['type'] ) ) {
        return $html;
    }

    // Prepend the effect to the theme output.
    $effect = optin_monster_effects_get_effect( $api->meta['effect'], $api->meta['type'], $theme );
    return $effect . $html;

}

/**
 * Retrieves all available effects for optin display.
 *
 * @since 2.0.0
 *
 * @return array $effects Array of display effects.
 */
function optin_monster_effects_list() {

    $effects = array(
        array(
            'name'  => __( 'No Effect', 'optin-monster-effects' ),
            'value' => 'none'
        ),
        array(
            'name'  => __( 'Bounce', 'optin-monster-effects' ),
            'value' => 'bounce'
        ),
        array(
            'name'  => __( 'Flash', 'optin-monster-effects' ),
            'value' => 'flash'
        ),
        array(
            'name'  => __( 'Pulse', 'optin-monster-effects' ),
            'value' => 'pulse'
        ),
        array(
            'name'  => __( 'Rubber Band', 'optin-monster-effects' ),
            'value' => 'rubberBand'
        ),
        array(
            'name'  => __( 'Shake', 'optin-monster-effects' ),
            'value' => 'shake'
        ),
        array(
            'name'  => __( 'Swing', 'optin-monster-effects' ),
            'value' => 'swing'
        ),
        array(
            'name'  => __( 'Tada', 'optin-monster-effects' ),
            'value' => 'tada'
        ),
        array(
            'name'  => __( 'Wobble', 'optin-monster-effects' ),
            'value' => 'wobble'
        ),
        array(
            'name'  => __( 'Bounce In', 'optin-monster-effects' ),
            'value' => 'bounceIn'
        ),
        array(
            'name'  => __( 'Bounce In (Down)', 'optin-monster-effects' ),
            'value' => 'bounceInDown'
        ),
        array(
            'name'  => __( 'Bounce In (Left)', 'optin-monster-effects' ),
            'value' => 'bounceInLeft'
        ),
        array(
            'name'  => __( 'Bounce In (Right)', 'optin-monster-effects' ),
            'value' => 'bounceInRight'
        ),
        array(
            'name'  => __( 'Bounce In (Up)', 'optin-monster-effects' ),
            'value' => 'bounceInUp'
        ),
        array(
            'name'  => __( 'Flip', 'optin-monster-effects' ),
            'value' => 'flip'
        ),
        array(
            'name'  => __( 'Flip Down', 'optin-monster-effects' ),
            'value' => 'flipInX'
        ),
        array(
            'name'  => __( 'Flip Side', 'optin-monster-effects' ),
            'value' => 'flipInY'
        ),
        array(
            'name'  => __( 'Light Speed', 'optin-monster-effects' ),
            'value' => 'lightSpeedIn'
        ),
        array(
            'name'  => __( 'Rotate', 'optin-monster-effects' ),
            'value' => 'rotateIn'
        ),
        array(
            'name'  => __( 'Rotate (Down Left)', 'optin-monster-effects' ),
            'value' => 'rotateInDownLeft'
        ),
        array(
            'name'  => __( 'Rotate (Down Right)', 'optin-monster-effects' ),
            'value' => 'rotateInDownRight'
        ),
        array(
            'name'  => __( 'Rotate (Up Left)', 'optin-monster-effects' ),
            'value' => 'rotateInUpLeft'
        ),
        array(
            'name'  => __( 'Rotate (Up Right)', 'optin-monster-effects' ),
            'value' => 'rotateInUpRight'
        ),
        array(
            'name'  => __( 'Slide In (Down)', 'optin-monster-effects' ),
            'value' => 'slideInDown'
        ),
        array(
            'name'  => __( 'Slide In (Left)', 'optin-monster-effects' ),
            'value' => 'slideInLeft'
        ),
        array(
            'name'  => __( 'Slide In (Right)', 'optin-monster-effects' ),
            'value' => 'slideInRight'
        ),
        array(
            'name'  => __( 'Roll In', 'optin-monster-effects' ),
            'value' => 'rollIn'
        ),
    );

    return apply_filters( 'optin_monster_effects', $effects );

}

/**
 * Retrieves a specified effect.
 *
 * @since 2.0.0
 *
 * @param string $effect  The effect to retrieve.
 * @param string $type    The type of optin being targeted.
 * @param string $theme   The slug of the theme.
 * @return string $output The styles for the effect.
 */
function optin_monster_effects_get_effect( $effect, $type, $theme ) {

    $output  = '<style type="text/css" id="om-effects-' . $type . '-' . $theme . '" class="om-effect-output">';

    switch ( $effect ) {
        case 'none' :
            $output .= '';
            break;
        case 'bounce' :
            $output .= '@-webkit-keyframes bounce{0%,100%,20%,50%,80%{-webkit-transform:translateY(0);transform:translateY(0)}40%{-webkit-transform:translateY(-30px);transform:translateY(-30px)}60%{-webkit-transform:translateY(-15px);transform:translateY(-15px)}}@keyframes bounce{0%,100%,20%,50%,80%{-webkit-transform:translateY(0);-ms-transform:translateY(0);transform:translateY(0)}40%{-webkit-transform:translateY(-30px);-ms-transform:translateY(-30px);transform:translateY(-30px)}60%{-webkit-transform:translateY(-15px);-ms-transform:translateY(-15px);transform:translateY(-15px)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-name: bounce;animation-name: bounce;}';
            break;
        case 'flash' :
            $output .= '@-webkit-keyframes flash{0%,100%,50%{opacity:1}25%,75%{opacity:0}}@keyframes flash{0%,100%,50%{opacity:1}25%,75%{opacity:0}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-name: flash;animation-name: flash;}';
            break;
        case 'pulse' :
            $output .= '@-webkit-keyframes pulse{0%{-webkit-transform:scale(1);transform:scale(1)}50%{-webkit-transform:scale(1.1);transform:scale(1.1)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes pulse{0%{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}50%{-webkit-transform:scale(1.1);-ms-transform:scale(1.1);transform:scale(1.1)}100%{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-name: pulse;animation-name: pulse;}';
            break;
        case 'rubberBand' :
            $output .= '@-webkit-keyframes rubberBand{0%{-webkit-transform:scale(1);transform:scale(1)}30%{-webkit-transform:scaleX(1.25) scaleY(0.75);transform:scaleX(1.25) scaleY(0.75)}40%{-webkit-transform:scaleX(0.75) scaleY(1.25);transform:scaleX(0.75) scaleY(1.25)}60%{-webkit-transform:scaleX(1.15) scaleY(0.85);transform:scaleX(1.15) scaleY(0.85)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes rubberBand{0%{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}30%{-webkit-transform:scaleX(1.25) scaleY(0.75);-ms-transform:scaleX(1.25) scaleY(0.75);transform:scaleX(1.25) scaleY(0.75)}40%{-webkit-transform:scaleX(0.75) scaleY(1.25);-ms-transform:scaleX(0.75) scaleY(1.25);transform:scaleX(0.75) scaleY(1.25)}60%{-webkit-transform:scaleX(1.15) scaleY(0.85);-ms-transform:scaleX(1.15) scaleY(0.85);transform:scaleX(1.15) scaleY(0.85)}100%{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-name: rubberBand;animation-name: rubberBand;}';
            break;
        case 'shake' :
            $output .= '@-webkit-keyframes shake{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}10%,30%,50%,70%,90%{-webkit-transform:translateX(-10px);transform:translateX(-10px)}20%,40%,60%,80%{-webkit-transform:translateX(10px);transform:translateX(10px)}}@keyframes shake{0%,100%{-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0)}10%,30%,50%,70%,90%{-webkit-transform:translateX(-10px);-ms-transform:translateX(-10px);transform:translateX(-10px)}20%,40%,60%,80%{-webkit-transform:translateX(10px);-ms-transform:translateX(10px);transform:translateX(10px)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:both;animation-fill-mode:both;-webkit-animation-name: shake;animation-name: shake;}';
            break;
        case 'swing' :
            $output .= '@-webkit-keyframes swing{20%{-webkit-transform:rotate(15deg);transform:rotate(15deg)}40%{-webkit-transform:rotate(-10deg);transform:rotate(-10deg)}60%{-webkit-transform:rotate(5deg);transform:rotate(5deg)}80%{-webkit-transform:rotate(-5deg);transform:rotate(-5deg)}100%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}}@keyframes swing{20%{-webkit-transform:rotate(15deg);-ms-transform:rotate(15deg);transform:rotate(15deg)}40%{-webkit-transform:rotate(-10deg);-ms-transform:rotate(-10deg);transform:rotate(-10deg)}60%{-webkit-transform:rotate(5deg);-ms-transform:rotate(5deg);transform:rotate(5deg)}80%{-webkit-transform:rotate(-5deg);-ms-transform:rotate(-5deg);transform:rotate(-5deg)}100%{-webkit-transform:rotate(0deg);-ms-transform:rotate(0deg);transform:rotate(0deg)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-transform-origin:top center;-ms-transform-origin:top center;transform-origin:top center;-webkit-animation-name:swing;animation-name:swing}';
            break;
        case 'tada' :
            $output .= '@-webkit-keyframes tada{0%{-webkit-transform:scale(1);transform:scale(1)}10%,20%{-webkit-transform:scale(0.9) rotate(-3deg);transform:scale(0.9) rotate(-3deg)}30%,50%,70%,90%{-webkit-transform:scale(1.1) rotate(3deg);transform:scale(1.1) rotate(3deg)}40%,60%,80%{-webkit-transform:scale(1.1) rotate(-3deg);transform:scale(1.1) rotate(-3deg)}100%{-webkit-transform:scale(1) rotate(0);transform:scale(1) rotate(0)}}@keyframes tada{0%{-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}10%,20%{-webkit-transform:scale(0.9) rotate(-3deg);-ms-transform:scale(0.9) rotate(-3deg);transform:scale(0.9) rotate(-3deg)}30%,50%,70%,90%{-webkit-transform:scale(1.1) rotate(3deg);-ms-transform:scale(1.1) rotate(3deg);transform:scale(1.1) rotate(3deg)}40%,60%,80%{-webkit-transform:scale(1.1) rotate(-3deg);-ms-transform:scale(1.1) rotate(-3deg);transform:scale(1.1) rotate(-3deg)}100%{-webkit-transform:scale(1) rotate(0);-ms-transform:scale(1) rotate(0);transform:scale(1) rotate(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:tada;animation-name:tada;}';
            break;
        case 'wobble' :
            $output .= '@-webkit-keyframes wobble{0%{-webkit-transform:translateX(0%);transform:translateX(0%)}15%{-webkit-transform:translateX(-25%) rotate(-5deg);transform:translateX(-25%) rotate(-5deg)}30%{-webkit-transform:translateX(20%) rotate(3deg);transform:translateX(20%) rotate(3deg)}45%{-webkit-transform:translateX(-15%) rotate(-3deg);transform:translateX(-15%) rotate(-3deg)}60%{-webkit-transform:translateX(10%) rotate(2deg);transform:translateX(10%) rotate(2deg)}75%{-webkit-transform:translateX(-5%) rotate(-1deg);transform:translateX(-5%) rotate(-1deg)}100%{-webkit-transform:translateX(0%);transform:translateX(0%)}}@keyframes wobble{0%{-webkit-transform:translateX(0%);-ms-transform:translateX(0%);transform:translateX(0%)}15%{-webkit-transform:translateX(-25%) rotate(-5deg);-ms-transform:translateX(-25%) rotate(-5deg);transform:translateX(-25%) rotate(-5deg)}30%{-webkit-transform:translateX(20%) rotate(3deg);-ms-transform:translateX(20%) rotate(3deg);transform:translateX(20%) rotate(3deg)}45%{-webkit-transform:translateX(-15%) rotate(-3deg);-ms-transform:translateX(-15%) rotate(-3deg);transform:translateX(-15%) rotate(-3deg)}60%{-webkit-transform:translateX(10%) rotate(2deg);-ms-transform:translateX(10%) rotate(2deg);transform:translateX(10%) rotate(2deg)}75%{-webkit-transform:translateX(-5%) rotate(-1deg);-ms-transform:translateX(-5%) rotate(-1deg);transform:translateX(-5%) rotate(-1deg)}100%{-webkit-transform:translateX(0%);-ms-transform:translateX(0%);transform:translateX(0%)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:wobble;animation-name:wobble;}';
            break;
        case 'bounceIn' :
            $output .= '@-webkit-keyframes bounceIn{0%{opacity:0;-webkit-transform:scale(.3);transform:scale(.3)}50%{opacity:1;-webkit-transform:scale(1.05);transform:scale(1.05)}70%{-webkit-transform:scale(.9);transform:scale(.9)}100%{opacity:1;-webkit-transform:scale(1);transform:scale(1)}}@keyframes bounceIn{0%{opacity:0;-webkit-transform:scale(.3);-ms-transform:scale(.3);transform:scale(.3)}50%{opacity:1;-webkit-transform:scale(1.05);-ms-transform:scale(1.05);transform:scale(1.05)}70%{-webkit-transform:scale(.9);-ms-transform:scale(.9);transform:scale(.9)}100%{opacity:1;-webkit-transform:scale(1);-ms-transform:scale(1);transform:scale(1)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:bounceIn;animation-name:bounceIn;}';
            break;
        case 'bounceInDown' :
            $output .= '@-webkit-keyframes bounceInDown{0%{opacity:0;-webkit-transform:translateY(-2000px);transform:translateY(-2000px)}60%{opacity:1;-webkit-transform:translateY(30px);transform:translateY(30px)}80%{-webkit-transform:translateY(-10px);transform:translateY(-10px)}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes bounceInDown{0%{opacity:0;-webkit-transform:translateY(-2000px);-ms-transform:translateY(-2000px);transform:translateY(-2000px)}60%{opacity:1;-webkit-transform:translateY(30px);-ms-transform:translateY(30px);transform:translateY(30px)}80%{-webkit-transform:translateY(-10px);-ms-transform:translateY(-10px);transform:translateY(-10px)}100%{-webkit-transform:translateY(0);-ms-transform:translateY(0);transform:translateY(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:bounceInDown;animation-name:bounceInDown;}';
            break;
        case 'bounceInLeft' :
            $output .= '@-webkit-keyframes bounceInLeft{0%{opacity:0;-webkit-transform:translateX(-2000px);transform:translateX(-2000px)}60%{opacity:1;-webkit-transform:translateX(30px);transform:translateX(30px)}80%{-webkit-transform:translateX(-10px);transform:translateX(-10px)}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes bounceInLeft{0%{opacity:0;-webkit-transform:translateX(-2000px);-ms-transform:translateX(-2000px);transform:translateX(-2000px)}60%{opacity:1;-webkit-transform:translateX(30px);-ms-transform:translateX(30px);transform:translateX(30px)}80%{-webkit-transform:translateX(-10px);-ms-transform:translateX(-10px);transform:translateX(-10px)}100%{-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:bounceInLeft;animation-name:bounceInLeft;}';
            break;
        case 'bounceInRight' :
            $output .= '@-webkit-keyframes bounceInRight{0%{opacity:0;-webkit-transform:translateX(2000px);transform:translateX(2000px)}60%{opacity:1;-webkit-transform:translateX(-30px);transform:translateX(-30px)}80%{-webkit-transform:translateX(10px);transform:translateX(10px)}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes bounceInRight{0%{opacity:0;-webkit-transform:translateX(2000px);-ms-transform:translateX(2000px);transform:translateX(2000px)}60%{opacity:1;-webkit-transform:translateX(-30px);-ms-transform:translateX(-30px);transform:translateX(-30px)}80%{-webkit-transform:translateX(10px);-ms-transform:translateX(10px);transform:translateX(10px)}100%{-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:bounceInRight;animation-name:bounceInRight;}';
            break;
        case 'bounceInUp' :
            $output .= '@-webkit-keyframes bounceInUp{0%{opacity:0;-webkit-transform:translateY(2000px);transform:translateY(2000px)}60%{opacity:1;-webkit-transform:translateY(-30px);transform:translateY(-30px)}80%{-webkit-transform:translateY(10px);transform:translateY(10px)}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes bounceInUp{0%{opacity:0;-webkit-transform:translateY(2000px);-ms-transform:translateY(2000px);transform:translateY(2000px)}60%{opacity:1;-webkit-transform:translateY(-30px);-ms-transform:translateY(-30px);transform:translateY(-30px)}80%{-webkit-transform:translateY(10px);-ms-transform:translateY(10px);transform:translateY(10px)}100%{-webkit-transform:translateY(0);-ms-transform:translateY(0);transform:translateY(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:bounceInUp;animation-name:bounceInUp;}';
            break;
        case 'flip' :
            $output .= '@-webkit-keyframes flip{0%{-webkit-transform:perspective(800px) translateZ(0) rotateY(0) scale(1);transform:perspective(800px) translateZ(0) rotateY(0) scale(1);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}40%{-webkit-transform:perspective(800px) translateZ(150px) rotateY(170deg) scale(1);transform:perspective(800px) translateZ(150px) rotateY(170deg) scale(1);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}50%{-webkit-transform:perspective(800px) translateZ(150px) rotateY(190deg) scale(1);transform:perspective(800px) translateZ(150px) rotateY(190deg) scale(1);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}80%{-webkit-transform:perspective(800px) translateZ(0) rotateY(360deg) scale(.95);transform:perspective(800px) translateZ(0) rotateY(360deg) scale(.95);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}100%{-webkit-transform:perspective(800px) translateZ(0) rotateY(360deg) scale(1);transform:perspective(800px) translateZ(0) rotateY(360deg) scale(1);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}}@keyframes flip{0%{-webkit-transform:perspective(800px) translateZ(0) rotateY(0) scale(1);-ms-transform:perspective(800px) translateZ(0) rotateY(0) scale(1);transform:perspective(800px) translateZ(0) rotateY(0) scale(1);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}40%{-webkit-transform:perspective(800px) translateZ(150px) rotateY(170deg) scale(1);-ms-transform:perspective(800px) translateZ(150px) rotateY(170deg) scale(1);transform:perspective(800px) translateZ(150px) rotateY(170deg) scale(1);-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}50%{-webkit-transform:perspective(800px) translateZ(150px) rotateY(190deg) scale(1);-ms-transform:perspective(800px) translateZ(150px) rotateY(190deg) scale(1);transform:perspective(800px) translateZ(150px) rotateY(190deg) scale(1);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}80%{-webkit-transform:perspective(800px) translateZ(0) rotateY(360deg) scale(.95);-ms-transform:perspective(800px) translateZ(0) rotateY(360deg) scale(.95);transform:perspective(800px) translateZ(0) rotateY(360deg) scale(.95);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}100%{-webkit-transform:perspective(800px) translateZ(0) rotateY(360deg) scale(1);-ms-transform:perspective(800px) translateZ(0) rotateY(360deg) scale(1);transform:perspective(800px) translateZ(0) rotateY(360deg) scale(1);-webkit-animation-timing-function:ease-in;animation-timing-function:ease-in}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-backface-visibility: visible;-ms-backface-visibility: visible;backface-visibility: visible;-webkit-animation-name:flip;animation-name:flip;}';
            break;
        case 'flipInX' :
            $output .= '@-webkit-keyframes flipInX{0%{-webkit-transform:perspective(800px) rotateX(90deg);transform:perspective(800px) rotateX(90deg);opacity:0}40%{-webkit-transform:perspective(800px) rotateX(-10deg);transform:perspective(800px) rotateX(-10deg)}70%{-webkit-transform:perspective(800px) rotateX(10deg);transform:perspective(800px) rotateX(10deg)}100%{-webkit-transform:perspective(800px) rotateX(0deg);transform:perspective(800px) rotateX(0deg);opacity:1}}@keyframes flipInX{0%{-webkit-transform:perspective(800px) rotateX(90deg);-ms-transform:perspective(800px) rotateX(90deg);transform:perspective(800px) rotateX(90deg);opacity:0}40%{-webkit-transform:perspective(800px) rotateX(-10deg);-ms-transform:perspective(800px) rotateX(-10deg);transform:perspective(800px) rotateX(-10deg)}70%{-webkit-transform:perspective(800px) rotateX(10deg);-ms-transform:perspective(800px) rotateX(10deg);transform:perspective(800px) rotateX(10deg)}100%{-webkit-transform:perspective(800px) rotateX(0deg);-ms-transform:perspective(800px) rotateX(0deg);transform:perspective(800px) rotateX(0deg);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-backface-visibility: visible;-ms-backface-visibility: visible;backface-visibility: visible;-webkit-animation-name:flipInX;animation-name:flipInX;}';
            break;
        case 'flipInY' :
            $output .= '@-webkit-keyframes flipInY{0%{-webkit-transform:perspective(800px) rotateY(90deg);transform:perspective(800px) rotateY(90deg);opacity:0}40%{-webkit-transform:perspective(800px) rotateY(-10deg);transform:perspective(800px) rotateY(-10deg)}70%{-webkit-transform:perspective(800px) rotateY(10deg);transform:perspective(800px) rotateY(10deg)}100%{-webkit-transform:perspective(800px) rotateY(0deg);transform:perspective(800px) rotateY(0deg);opacity:1}}@keyframes flipInY{0%{-webkit-transform:perspective(800px) rotateY(90deg);-ms-transform:perspective(800px) rotateY(90deg);transform:perspective(800px) rotateY(90deg);opacity:0}40%{-webkit-transform:perspective(800px) rotateY(-10deg);-ms-transform:perspective(800px) rotateY(-10deg);transform:perspective(800px) rotateY(-10deg)}70%{-webkit-transform:perspective(800px) rotateY(10deg);-ms-transform:perspective(800px) rotateY(10deg);transform:perspective(800px) rotateY(10deg)}100%{-webkit-transform:perspective(800px) rotateY(0deg);-ms-transform:perspective(800px) rotateY(0deg);transform:perspective(800px) rotateY(0deg);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-backface-visibility: visible;-ms-backface-visibility: visible;backface-visibility: visible;-webkit-animation-name:flipInY;animation-name:flipInY;}';
            break;
        case 'lightSpeedIn' :
            $output .= '@-webkit-keyframes lightSpeedIn{0%{-webkit-transform:translateX(100%) skewX(-30deg);transform:translateX(100%) skewX(-30deg);opacity:0}60%{-webkit-transform:translateX(-20%) skewX(30deg);transform:translateX(-20%) skewX(30deg);opacity:1}80%{-webkit-transform:translateX(0%) skewX(-15deg);transform:translateX(0%) skewX(-15deg);opacity:1}100%{-webkit-transform:translateX(0%) skewX(0deg);transform:translateX(0%) skewX(0deg);opacity:1}}@keyframes lightSpeedIn{0%{-webkit-transform:translateX(100%) skewX(-30deg);-ms-transform:translateX(100%) skewX(-30deg);transform:translateX(100%) skewX(-30deg);opacity:0}60%{-webkit-transform:translateX(-20%) skewX(30deg);-ms-transform:translateX(-20%) skewX(30deg);transform:translateX(-20%) skewX(30deg);opacity:1}80%{-webkit-transform:translateX(0%) skewX(-15deg);-ms-transform:translateX(0%) skewX(-15deg);transform:translateX(0%) skewX(-15deg);opacity:1}100%{-webkit-transform:translateX(0%) skewX(0deg);-ms-transform:translateX(0%) skewX(0deg);transform:translateX(0%) skewX(0deg);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:lightSpeedIn;animation-name:lightSpeedIn;-webkit-animation-timing-function:ease-out;animation-timing-function:ease-out}';
            break;
        case 'rotateIn' :
            $output .= '@-webkit-keyframes rotateIn{0%{-webkit-transform-origin:center center;transform-origin:center center;-webkit-transform:rotate(-200deg);transform:rotate(-200deg);opacity:0}100%{-webkit-transform-origin:center center;transform-origin:center center;-webkit-transform:rotate(0);transform:rotate(0);opacity:1}}@keyframes rotateIn{0%{-webkit-transform-origin:center center;-ms-transform-origin:center center;transform-origin:center center;-webkit-transform:rotate(-200deg);-ms-transform:rotate(-200deg);transform:rotate(-200deg);opacity:0}100%{-webkit-transform-origin:center center;-ms-transform-origin:center center;transform-origin:center center;-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:rotateIn;animation-name:rotateIn;}';
            break;
        case 'rotateInDownLeft' :
            $output .= '@-webkit-keyframes rotateInDownLeft{0%{-webkit-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(-90deg);transform:rotate(-90deg);opacity:0}100%{-webkit-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(0);transform:rotate(0);opacity:1}}@keyframes rotateInDownLeft{0%{-webkit-transform-origin:left bottom;-ms-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(-90deg);-ms-transform:rotate(-90deg);transform:rotate(-90deg);opacity:0}100%{-webkit-transform-origin:left bottom;-ms-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:rotateInDownLeft;animation-name:rotateInDownLeft;}';
            break;
        case 'rotateInDownRight' :
            $output .= '@-webkit-keyframes rotateInDownRight{0%{-webkit-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(90deg);transform:rotate(90deg);opacity:0}100%{-webkit-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(0);transform:rotate(0);opacity:1}}@keyframes rotateInDownRight{0%{-webkit-transform-origin:right bottom;-ms-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg);opacity:0}100%{-webkit-transform-origin:right bottom;-ms-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:rotateInDownRight;animation-name:rotateInDownRight;}';
            break;
        case 'rotateInUpLeft' :
            $output .= '@-webkit-keyframes rotateInUpLeft{0%{-webkit-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(90deg);transform:rotate(90deg);opacity:0}100%{-webkit-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(0);transform:rotate(0);opacity:1}}@keyframes rotateInUpLeft{0%{-webkit-transform-origin:left bottom;-ms-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg);opacity:0}100%{-webkit-transform-origin:left bottom;-ms-transform-origin:left bottom;transform-origin:left bottom;-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:rotateInUpLeft;animation-name:rotateInUpLeft;}';
            break;
        case 'rotateInUpRight' :
            $output .= '@-webkit-keyframes rotateInUpRight{0%{-webkit-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(-90deg);transform:rotate(-90deg);opacity:0}100%{-webkit-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(0);transform:rotate(0);opacity:1}}@keyframes rotateInUpRight{0%{-webkit-transform-origin:right bottom;-ms-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(-90deg);-ms-transform:rotate(-90deg);transform:rotate(-90deg);opacity:0}100%{-webkit-transform-origin:right bottom;-ms-transform-origin:right bottom;transform-origin:right bottom;-webkit-transform:rotate(0);-ms-transform:rotate(0);transform:rotate(0);opacity:1}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:rotateInUpRight;animation-name:rotateInUpRight;}';
            break;
        case 'slideInDown' :
            $output .= '@-webkit-keyframes slideInDown{0%{opacity:0;-webkit-transform:translateY(-2000px);transform:translateY(-2000px)}100%{-webkit-transform:translateY(0);transform:translateY(0)}}@keyframes slideInDown{0%{opacity:0;-webkit-transform:translateY(-2000px);-ms-transform:translateY(-2000px);transform:translateY(-2000px)}100%{-webkit-transform:translateY(0);-ms-transform:translateY(0);transform:translateY(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:slideInDown;animation-name:slideInDown;}';
            break;
        case 'slideInLeft' :
            $output .= '@-webkit-keyframes slideInLeft{0%{opacity:0;-webkit-transform:translateX(-2000px);transform:translateX(-2000px)}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes slideInLeft{0%{opacity:0;-webkit-transform:translateX(-2000px);-ms-transform:translateX(-2000px);transform:translateX(-2000px)}100%{-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:slideInLeft;animation-name:slideInLeft;}';
            break;
        case 'slideInRight' :
            $output .= '@-webkit-keyframes slideInRight{0%{opacity:0;-webkit-transform:translateX(2000px);transform:translateX(2000px)}100%{-webkit-transform:translateX(0);transform:translateX(0)}}@keyframes slideInRight{0%{opacity:0;-webkit-transform:translateX(2000px);-ms-transform:translateX(2000px);transform:translateX(2000px)}100%{-webkit-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:slideInRight;animation-name:slideInRight;}';
            break;
        case 'rollIn' :
            $output .= '@-webkit-keyframes rollIn{0%{opacity:0;-webkit-transform:translateX(-100%) rotate(-120deg);transform:translateX(-100%) rotate(-120deg)}100%{opacity:1;-webkit-transform:translateX(0px) rotate(0deg);transform:translateX(0px) rotate(0deg)}}@keyframes rollIn{0%{opacity:0;-webkit-transform:translateX(-100%) rotate(-120deg);-ms-transform:translateX(-100%) rotate(-120deg);transform:translateX(-100%) rotate(-120deg)}100%{opacity:1;-webkit-transform:translateX(0px) rotate(0deg);-ms-transform:translateX(0px) rotate(0deg);transform:translateX(0px) rotate(0deg)}}';
            $output .= '#om-' . $type . '-' . $theme . '-optin {-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-name:rollIn;animation-name:rollIn;}';
            break;
    }

    $output .= '</style>';

    return apply_filters( 'optin_monster_effect', $output, $effect, $type, $theme );

}