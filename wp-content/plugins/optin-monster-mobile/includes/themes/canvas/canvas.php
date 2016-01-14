<?php
/**
 * Agile theme class.
 *
 * @since   2.0.0
 *
 * @package Optin_Monster
 * @author  Thomas Griffin
 */
class Optin_Monster_Mobile_Theme_Canvas extends Optin_Monster_Theme {

    /**
     * Path to the file.
     *
     * @since 2.0.0
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Slug of the theme.
     *
     * @since 2.0.0
     *
     * @var string
     */
    public $theme = 'canvas';

    /**
     * Primary class constructor.
     *
     * @since 2.0.0
     *
     * @param int $optin_id The optin ID to target.
     */
    public function __construct( $optin_id ) {

        // Construct via the parent object.
        parent::__construct( $optin_id );

        // Set the optin type.
        $this->type = $this->meta['type'];

    }
    /**
     * Retrieval method for getting the styles for a theme.
     *
     * @since 2.0.0
     */
    public function get_styles() {

        $css = '
        html div#om-' . $this->optin->post_name . ' * {
            box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -moz-box-sizing:border-box;
            -webkit-text-size-adjust: 100%;
        }
        html div#om-' . $this->optin->post_name . '-overlay {
            box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -moz-box-sizing:border-box;
            -webkit-text-size-adjust: 100%;
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 4746365252535483;
            background: rgb(0, 0, 0);
            -webkit-overflow-scrolling: touch;
            display: none;
        }
        html div#om-' . $this->optin->post_name . ' {
            background:none;
            border:0;
            border-radius:0;
            -webkit-border-radius:0;
            -moz-border-radius:0;
            float:none;
            font:normal 100%/normal helvetica,arial,sans-serif;
            -webkit-font-smoothing:antialiased;
            height:auto;
            letter-spacing:normal;
            outline:none;
            position:static;
            text-decoration:none;
            text-indent:0;
            text-shadow:none;
            text-transform:none;
            width:auto;
            visibility:visible;
            overflow:visible;
            margin:0;
            padding:0;
            line-height:1;
            box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -moz-box-sizing:border-box;
            -webkit-box-shadow:none;
            -moz-box-shadow:none;
            -ms-box-shadow:none;
            -o-box-shadow:none;
            box-shadow:none;
            -webkit-appearance:none;
        }
        html div#om-' . $this->optin->post_name . ' {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            -webkit-overflow-scrolling: touch;
            z-index: 74746365252535483653;
            display: none;
        }
        html div#om-' . $this->optin->post_name . ' .om-clearfix {
            clear: both;
        }
        html div#om-' . $this->optin->post_name . ' .om-clearfix:after {
            clear: both;
            content: ".";
            display: block;
            height: 0;
            line-height: 0;
            overflow: auto;
            visibility: hidden;
            zoom: 1;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin {
            background: #fff;
            width: 100%;
            z-index: 74746365252535483111;
            -webkit-overflow-scrolling: touch;
            display: none;
            ' . ( $this->preview ? '
            position: relative;
            margin: 0 auto;
            max-width: 600px;
            ' : '
            position: absolute;
            top: 0;
            left: 0;
            ' ) . ';
        }
        html div#om-' . $this->optin->post_name . ' .om-close {
            color: #fff;
            display: block;
            font-size: 18px;
            line-height: 18px;
            font-weight: 600;
            text-decoration: none !important;
            font-family: Helvetica, Arial, sans-serif !important;
            position: absolute;
            top: 0;
            right: 0;
            background: #bbb;
            background: rgba(0, 0, 0, .4);
            padding: 4px 8px 6px 9px;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-body {
            padding: 10px;
        }
        ';

        return $css;

    }

    /**
     * Retrieval method for getting the HTML output for a theme.
     *
     * @since 2.0.0
     */
    public function get_html() {

        $provider = $this->get_email_setting( 'provider', '', false );

        $html = '<div id="om-' . $this->type . '-' . $this->theme . '-optin" class="om-' . $this->type . '-' . $this->theme . ' om-clearfix om-theme-' . $this->theme . ' ' . ( $provider && 'custom' == $provider ? 'om-custom-html-form' : '' ) . '" style="background-color: ' . $this->get_background_setting( 'body', '#fff' ) . ';width: ' . $this->get_setting( 'dimensions', 'width', '600' ) . 'px;height: ' . $this->get_setting( 'dimensions', 'height', '400' ) . 'px;" data-om-action="selectable" data-om-target="#optin-monster-field-body_bg">';
            // Close button.
            $html .= '<a href="#" class="om-close" title="' . esc_attr__( 'Close', 'optin-monster-mobile' ) . '">&times;</a>';

            $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-body" style="padding-top:' . $this->get_setting( 'dimensions', 'padding', '10' ) . 'px;">';

                // Canvas content.
                $content = html_entity_decode( $this->get_setting( 'custom_canvas_html', '', '' ), ENT_QUOTES );
                $content = str_replace( array( 'ajax="true"', 'ajax=true' ), '', $content );
                $html .= '<div id="om-canvas-' . $this->theme . '-optin-content"><div class="optin_custom_html_applied">' . do_shortcode( $content ) . '</div></div>';

            $html .= '</div>';

        $html .= '</div>';

        return $html;

    }

    /**
     * Retrieval method for getting any custom JS for a theme.
     *
     * @since 2.0.0
     */
    public function get_js() {
        // TODO: Implement get_js() method.
    }

    /**
     * Method for housing filters to allow for design and field controls.
     *
     * @since 2.0.0
     */
    public function controls() {

        add_filter( 'optin_monster_panel_design_fields', array( $this, 'design_fields' ), 10, 2 );
        add_filter( 'optin_monster_save_optin', array( $this, 'save_controls' ), 10, 4 );

    }

    /**
     * Outputs the design controls for the theme.
     *
     * @since 2.0.0
     *
     * @param array $fields    Array of design fields.
     * @param object $instance The Edit UI instance.
     * @return array $fields   Amended array of design fields.
     */
    public function design_fields( $fields, $instance ) {

        $fields['body_bg'] = $instance->get_color_field(
            'body_bg',
            $instance->get_background_setting( 'body', '#fff' ),
            __( 'Background Color', 'optin-monster-mobile' ),
            __( 'The background color of the optin.', 'optin-monster-mobile' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin',
                'props'  => 'background-color'
            )
        );
        $fields['width_field'] = $instance->get_text_field(
            'width_field',
            $this->get_setting( 'dimensions', 'width', '600' ),
            __( 'Canvas Width', 'optin-monster-canvas' ),
            __( 'The width of the lightbox (in pixels).', 'optin-monster-canvas' ),
            false,
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin',
                'method' => 'css',
                'attr'   => 'width'
            ),
            array( 'om-live-preview' )
        );
        $fields['height_field'] = $instance->get_text_field(
            'height_field',
            $this->get_setting( 'dimensions', 'height', '400' ),
            __( 'Canvas Height', 'optin-monster-canvas' ),
            __( 'The height of the lightbox (in pixels).', 'optin-monster-canvas' ),
            false,
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin',
                'method' => 'css',
                'attr'   => 'height'
            ),
            array( 'om-live-preview' )
        );
        $fields['mobile_padding'] = $instance->get_text_field(
            'mobile_padding',
            $this->get_setting( 'dimensions', 'padding', '10' ),
            __( 'Top Padding', 'optin-monster-canvas' ),
            __( 'The top padding of the optin (in pixels). Setting this can help push content down if it is sitting underneath the close button.', 'optin-monster-canvas' ),
            false,
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-body',
                'method' => 'css',
                'attr'   => 'paddingTop',
                'pixels' => true
            ),
            array( 'om-live-preview' )
        );
        $fields['custom_html'] = $instance->get_textarea_field(
            'custom_html',
            $instance->get_setting( 'custom_canvas_html', '', '' ),
            __( 'Custom HTML', 'optin-monster-canvas' ),
            '',
            false,
            array(
                'target' => '#om-canvas-' . $this->theme . '-optin-content.optin_custom_html_applied',
                'theme' => $this->meta['theme']
            ),
            array( 'om-custom-html-editor' )
        );

        return $fields;

    }


    /**
     * Saves the meta fields for the optin controls.
     *
     * @since 2.0.0
     *
     * @param array $meta      The meta key "_om_meta" with all of its data.
     * @param int $optin_id    The optin ID to target.
     * @param array $fields    The post fields under the key "optin_monster".
     * @param array $post_data All of the $_POST contents generated when saving.
     * @return array $meta     Amended array of meta to be saved.
     */
    public function save_controls( $meta, $optin_id, $fields, $post_data ) {

        $meta['background']['body']    = isset( $fields['body_bg'] ) ? esc_attr( $fields['body_bg'] ) : '';
        $meta['dimensions']['width']   = isset( $fields['width_field'] ) ? esc_attr( $fields['width_field'] ) : '';
        $meta['dimensions']['height']  = isset( $fields['height_field'] ) ? esc_attr( $fields['height_field'] ) : '';
        $meta['dimensions']['padding'] = isset( $fields['mobile_padding'] ) ? esc_attr( $fields['mobile_padding'] ) : '';

        $html                       = isset( $fields['custom_html'] ) ? esc_attr( $fields['custom_html'] ) : '';
        $meta['custom_canvas_html'] = str_replace( array( 'ajax="true"', 'ajax=true' ), '', $html );
        return $meta;

    }

}