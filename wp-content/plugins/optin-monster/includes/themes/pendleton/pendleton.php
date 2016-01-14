<?php
/**
 * Clean Slate theme class.
 *
 * @since   2.0.0
 *
 * @package Optin_Monster
 * @author  Thomas Griffin
 */
class Optin_Monster_Theme_Pendleton extends Optin_Monster_Theme {

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
    public $theme = 'pendleton';

    /**
     * The width of the image for the optin.
     *
     * @since 2.0.0
     *
     * @var int
     */
    public $img_width = 230;

    /**
     * The height of the image for the optin.
     *
     * @since 2.0.0
     *
     * @var int
     */
    public $img_height = 195;

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
     *
     * @return string A string of concatenated CSS for the theme.
     */
    public function get_styles() {
        
        $css = '
        html div#om-' . $this->optin->post_name . ' * {
            box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -moz-box-sizing:border-box;
        }
        html div#om-' . $this->optin->post_name . ' {
            background:none;
            border:0;
            border-radius:0;
            -webkit-border-radius:0;
            -moz-border-radius:0;
            float:none;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing: grayscale;
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
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, .7);
            font-family: helvetica,arial,sans-serif;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            line-height: 1;
            width: 100%;
            height: 100%;
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
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            min-height: 175px;
            max-width: 700px;
            width: 100%;
            z-index: 734626274;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-wrap {
            position: relative;
            height: 100%;
            background-color: #2247cd;
            background-size: contain;
            padding: 30px;
        }
        html div#om-' . $this->optin->post_name . ' .om-close {
            color: #000000;
            font-weight: bold;
            position: absolute;
            top: 0;
            right: 0;
            font-size: 24px;
            line-height: 24px;
            text-decoration: none !important;
            font-family: Arial, sans-serif;
            display: block;
            padding: 2px 8px 1px 8px;
            z-index: 1500;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-header {
            min-height: 30px;
            padding: 0 0 15px;
            width: 100%;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-title {
            font-size: 24px;
            color: #ffffff;
            width: 100%;
            margin: 0;
            text-align: center;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-content {
            padding: 15px 0;
            display: table;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-left,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-right {
            display: table-cell;
            vertical-align: middle;
            float: none;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-left {
            width: 100%;
            position: relative;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-tagline {
            font-size: 16px;
            line-height: 1.25;
            color: #ffffff;
            width: 100%;
            margin: 0 0 20px;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-bullets ul {
            padding: 0;
            margin: 0;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-bullets ul li {
            margin-left: 30px;
            line-height: 1.25;
            list-style-type: none;
            position: relative;
            font-size: 16px;
            color: #ffffff;
            margin-bottom: 7px;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-bullets ul li .om-diamond {
            display: block;
            vertical-align: top;
            float: left;
            clear: both;
            margin-top: 5px;
            margin-right: 15px;
            margin-bottom: 15px;
            text-indent: -9999px;
            position: relative; 
            height: 7px; 
            width: 7px; 
            background-color: #FFFFFF; 
            -webkit-transform: rotate(45deg) skew(0deg); 
            transform: rotate(45deg) skew(0deg); 
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-right {
            max-width: 230px;
            max-height: 195px;
            width: 100%;
            position: relative;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-image-container {
            position: relative;
            max-width: 230px;
            max-height: 195px;
            margin: 0 auto;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-image-container img {
            display: block;
            margin: 0 0 0 6px;
            text-align: center;
            height: 195px;
            width: 230px;
            min-width: 230px;
            min-height: 195px;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-footer {
            padding: 15px 0 0;
        }
        html div#om-' . $this->optin->post_name . ' label {
            color: #fff;
        }
        html div#om-' . $this->optin->post_name . ' input,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email {
            background-color: #fff;
            max-width: 225px;
            width: 100%;
            border: 1px solid #ccc;
            font-size: 16px;
            line-height: 24px;
            padding: 6px;
            overflow: hidden;
            outline: none;
            margin: 0 10px 0 0;
            vertical-align: middle;
            display: inline;
        }
        html div#om-' . $this->optin->post_name . ' .om-has-email #om-' . $this->type . '-' . $this->theme . '-optin-email {
            max-width: 460px;
        }
        html div#om-' . $this->optin->post_name . ' input[type=submit],
        html div#om-' . $this->optin->post_name . ' button,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit {
            background: #9df98c;
            border: none;
            max-width: 170px;
            width: 100%;
            color: #000;
            font-size: 16px;
            font-weight: bold;
            padding: 6px;
            line-height: 30px;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            display: inline;
            margin: 0;
            height: 38px;
            opacity: 1;
        }
        html div#om-' . $this->optin->post_name . ' input[type=submit]:hover,
        html div#om-' . $this->optin->post_name . ' button:hover,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit:hover {
            opacity: 0.9;
        }
        html div#om-' . $this->optin->post_name . ' input[type=checkbox],
        html div#om-' . $this->optin->post_name . ' input[type=radio] {
            -webkit-appearance: checkbox;
            width: auto;
            outline: invert none medium;
            padding: 0;
            margin: 0;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form form :nth-child(2n) {
            margin-right: 0;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form input,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form select {
            height: 38px;
            width: 49%;
            max-width: none;
            margin-right: 1.44%;
            margin-left: 0;
            margin-bottom: 10px;
            vertical-align: middle;
            border-radius: 0;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form input[type=submit],
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form button {
            width: 100%;
        }
        
        @media (max-width: 700px) {
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-right,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-image-container {
                max-width: 100%;
                max-height: 100%;
            }
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-image-container img {
                width: 100%;
                height: auto;
                margin: 30px 0 0;
            }
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin[style] {
                width: 100%;
                position: relative;
            }
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-left,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-right,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit,
            html div#om-' . $this->optin->post_name . ' .om-has-email #om-' . $this->type . '-' . $this->theme . '-optin-email,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form input,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form select,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form input[type=submit],
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form button {
                float: none;
                display: block;
                width: 100%;
                max-width: 100%;
            }
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-left,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form input,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form select,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form input[type=submit],
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin.om-custom-html-form button {
                margin-bottom: 15px;
            }
        }
        ';
        return $css;

    }

    /**
     * Retrieval method for getting the HTML output for a theme.
     *
     * @since 2.0.0
     *
     * @return string A string of HTML for the theme.
     */
    public function get_html() {
        
        $background = plugins_url( 'images/bg.jpg', $this->file );

        $provider = $this->get_email_setting( 'provider', '', false );
        $html = '<div id="om-' . $this->type . '-' . $this->theme . '-optin" class="om-' . $this->type . '-' . $this->theme . ' om-clearfix om-theme-' . $this->theme . ' ' . ( $provider && 'custom' == $provider ? 'om-custom-html-form' : '' ) . '">';
            $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-wrap" data-om-action="selectable" data-om-target="#optin-monster-field-body_background" class="om-clearfix" style="background-image: url(\'' . $this->get_background_setting( 'background_image', $background ) . '\');">';
                $html .= '<a href="#" class="om-close" title="' . esc_attr__( 'Close', 'optin-monster' ) . '">&times;</a>';

                // Header area.
                $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-header" class="om-clearfix">';
                    $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-title" data-om-action="editable" data-om-field="title" style="' . $this->get_element_style( 'title', array( 'color' => '#ffffff', 'font' => 'Droid Serif', 'size' => '24px', 'meta' => array( 'text-align' => 'center' ) ) ) . '">' . $this->get_title_setting( 'text', __( 'Grow Your Blog Traffic by 200% with Our FREE Tool!', 'optin-monster' ) ) . '</div>';
                $html .= '</div>';

                // Content area.
                $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-content" class="om-clearfix">';

                    // Left content area.
                    $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-left">';
                        $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-tagline" data-om-action="editable" data-om-field="tagline" style="' . $this->get_element_style( 'tagline', array( 'color' => '#ffffff', 'font' => 'Helvetica', 'size' => '18px' ) ) . '">' . $this->get_tagline_setting( 'text', __( 'Get the inside details on how you can increase your traffic overnight by 200% or more!', 'optin-monster' ) ) . '</div>';

                        // Retrieve any bulleted text from v1.
                        $color   = $this->get_bullet_setting( 'diamond_color', '#ffffff' );
                        $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-bullets" data-om-action="editable" data-om-field="bullet">';
                        if ( isset( $this->meta['bullet']['text'] ) ) {
                            if ( is_array( $this->meta['bullet']['text'] ) ) {
                                $html .= '<ul id="om-' . $this->type . '-' . $this->theme . '-optin-bullet-list">';
                                foreach ( $this->meta['bullet']['text'] as $bullet ) {
                                    $html .= '<li><div class="om-diamond" style="background-color:' . $color . '">&nbsp;</div>' . $bullet . '</li>';
                                }
                                $html .= '</ul>';
                            } else {
                                $html .= $this->meta['bullet']['text'];
                            }
                        } else {
                            $html .= $this->get_default_bullets();
                        }
                        $html .= '</div>';
                    $html .= '</div>';

                    // Right content area.
                    $show_name = $this->get_name_setting( 'show' );
                    $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-right">';
                        $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-image-container" class="om-image-container om-clearfix">';
                             $html .= $this->get_image();
                        $html .= '</div>';
                    $html .= '</div>';

                $html .= '</div>';

                // Footer area.
                $show_name  = $this->get_name_setting( 'show' );
                $class_name = $show_name ? ' om-has-name-email' : ' om-has-email';
                $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-footer" class="om-clearfix' . $class_name . '">';

                    // Show either the custom HTML form entered by the user or the custom fields in the Fields pane.
                    if ( isset( $this->meta['email']['provider'] ) && 'custom' == $this->meta['email']['provider'] ) {
                        $html .= do_shortcode( html_entity_decode( $this->meta['custom_html'] ) );
                    } else {
                        // Possibly show the name field.
                        if ( $show_name ) {
                            $html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-name" type="text" value="" data-om-action="selectable" data-om-target="#optin-monster-field-name_field" placeholder="' . $this->get_name_setting( 'placeholder', __( 'Name', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'name', array( 'font' => 'Helvetica' ) ) . '" />';
                        }

                        $html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-email" type="email" value="" data-om-action="selectable" data-om-target="#optin-monster-field-email_field" placeholder="' . $this->get_email_setting( 'placeholder', __( 'Email Address', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'email', array( 'font' => 'Helvetica' ) ) . '" />';
                        $html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-submit" type="submit" data-om-action="selectable" data-om-target="#optin-monster-field-submit_field" value="' . $this->get_submit_setting( 'placeholder', __( 'Sign Up', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'submit', array( 'font' => 'Helvetica' ) ) . '" />';
                    }

                $html .= '</div>';

            $html .= '</div>';

            // If we have a powered by link, output it now.
            $html .= $this->get_powered_by_link();
        $html .= '</div>';
        return $html;

    }

    /**
     * Retrieval method for getting any custom JS for a theme.
     * This is done via output buffering so that it is easier
     * to read as JS during development.
     *
     * @since 2.0.0
     *
     * @return string A string of JS for the theme.
     */
    public function get_js() {

        ob_start();
        if ( $this->preview ) :
        ?>
        $(document).on('OptinMonsterPreviewInit', function(e, editors){
            $.each(editors, function(i, editor){
                if ( 'om-<?php echo $this->type; ?>-<?php echo $this->theme; ?>-optin-bullets' !== CKEDITOR.instances[editor].name ) {
                    return;
                }

                // Utility function to apply throttling to keyup/keydown checking for input fields.
                var omDelay = (function(){
                    var timer = 0;
                    return function(callback, ms){
                        clearTimeout(timer);
                        timer = setTimeout(callback, ms);
                    };
                })();

                // Target the change event and make sure that new list elements always have a bullet appended to them in the proper color.
                CKEDITOR.instances[editor].on('change', function(event){
                    omDelay(function(){
                        // Grab the HTML and parse it into loopable elements to find font-families.
                        $('#om-<?php echo $this->type; ?>-<?php echo $this->theme; ?>-optin-bullets').find('li').each(function(i){
                            var diamond = $(this).find('.om-diamond');
                            if ( 0 !== diamond.length ) {
                                return;
                            }

                            // We need a diamond - prepend it to the list item now.
                            var diamond_color = $('#optin-monster-field-diamond_color', window.parent.document).val(),
                                diamond_html  = '<div class="om-diamond" style="background-color:' + diamond_color + '">&nbsp;</div>';
                            $(this).prepend(diamond_html);
                        });
                    }, 250);
                });
            });
        });
        <?php
        endif;
        return ob_get_clean();

    }

    /**
     * Outputs the filters needed to register controls for the OptinMonster
     * preview customizer and save the fields registered.
     *
     * @since 2.0.0
     */
    public function controls() {

        add_filter( 'optin_monster_panel_design_fields', array( $this, 'design_fields' ), 10, 2 );
        add_filter( 'optin_monster_panel_input_fields', array( $this, 'input_fields' ), 10, 2 );
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
        $background = plugins_url( 'images/bg.jpg', $this->file );

        $fields['body_background'] = $instance->get_text_field(
            'body_background',
            $instance->get_background_setting( 'background_image', $background ),
            __( 'Optin Background Image', 'optin-monster' ),
            __( 'The background image url for the optin.', 'optin-monster' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-wrap',
                'props'  => 'background-image'
            )
        );
        $fields['diamond_color'] = $instance->get_color_field(
            'diamond_color',
            $instance->get_bullet_setting( 'diamond_color', '#ffffff' ),
            __( 'Optin Diamond Color', 'optin-monster' ),
            __( 'The color of the diamonds for the list items in the optin.', 'optin-monster' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-bullets li .om-diamond',
                'props'  => 'background-color'
            )
        );

        return $fields;

    }

    /**
     * Outputs the fields controls for the theme.
     *
     * @since 2.0.0
     *
     * @param array $fields    Array of input fields.
     * @param object $instance The Edit UI instance.
     * @return array $fields   Amended array of input fields.
     */
    public function input_fields( $fields, $instance ) {

        // Build the name field.
        $fields['name_header'] = $instance->get_field_header( __( 'Name Field', 'optin-monster' ), 'name', true );
        $fields['name_show'] = $instance->get_checkbox_field(
            'name_show',
            $instance->get_name_setting( 'show' ),
            __( 'Show optin name field?', 'optin-monster' ),
            __( 'Displays or hides the name field in the optin.', 'optin-monster' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-footer',
                'input'  => esc_attr( '<input id="om-' . $this->type . '-' . $this->theme . '-optin-name" type="text" value="" data-om-action="selectable" data-om-target="#optin-monster-field-name_field" placeholder="' . $this->get_name_setting( 'placeholder', __( 'Name', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'name', array( 'font' => 'Helvetica' ) ) . '" />' ),
                'name'   => '#om-' . $this->type . '-' . $this->theme . '-optin-name'
            )
        );
        $fields['name_field'] = $instance->get_text_field(
            'name_field',
            $instance->get_name_setting( 'placeholder', __( 'Name', 'optin-monster' ) ),
            __( 'Name Placeholder', 'optin-monster' ),
            __( 'The placeholder text for the email field.', 'optin-monster' ),
            false,
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-name',
                'method' => 'attr',
                'attr'   => 'placeholder'
            ),
            array( 'om-live-preview' )
        );
        $fields['name_color'] = $instance->get_color_field(
            'name_color',
            $instance->get_name_setting( 'color', '#484848' ),
            __( 'Name Color', 'optin-monster' ),
            __( 'The text color for the name field.', 'optin-monster' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-name',
                'props'  => 'color'
            )
        );
        $fields['name_font'] = $instance->get_font_field(
            'name_font',
            $instance->get_name_setting( 'font', 'Helvetica' ),
            Optin_Monster_Output::get_instance()->get_supported_fonts(),
            __( 'Name Font', 'optin-monster' ),
            __( 'The font family for the name field.', 'optin-monster' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-name',
                'attr'   => 'font-family',
                'method' => 'css'
            ),
            array( 'om-live-preview' )
        );

        // Build the email field.
        $fields['email_header'] = $instance->get_field_header( __( 'Email Field', 'optin-monster' ), 'email' );
        $fields['email_field'] = $instance->get_text_field(
            'email_field',
            $instance->get_email_setting( 'placeholder', __( 'Email Address', 'optin-monster' ) ),
            __( 'Email Placeholder', 'optin-monster' ),
            __( 'The placeholder text for the email field.', 'optin-monster' ),
            false,
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-email',
                'method' => 'attr',
                'attr'   => 'placeholder'
            ),
            array( 'om-live-preview' )
        );
        $fields['email_color'] = $instance->get_color_field(
            'email_color',
            $instance->get_email_setting( 'color', '#484848' ),
            __( 'Email Color', 'optin-monster' ),
            __( 'The text color for the email field.', 'optin-monster' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-email',
                'props'  => 'color'
            )
        );
        $fields['email_font'] = $instance->get_font_field(
            'email_font',
            $instance->get_email_setting( 'font', 'Helvetica' ),
            Optin_Monster_Output::get_instance()->get_supported_fonts(),
            __( 'Email Font', 'optin-monster' ),
            __( 'The font family for the email field.', 'optin-monster' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-email',
                'attr'   => 'font-family',
                'method' => 'css'
            ),
            array( 'om-live-preview' )
        );

        // Build the submit field.
        $fields['submit_header'] = $instance->get_field_header( __( 'Submit Field', 'optin-monster' ), 'submit' );
        $fields['submit_field'] = $instance->get_text_field(
            'submit_field',
            $instance->get_submit_setting( 'placeholder', __( 'Sign Up', 'optin-monster' ) ),
            __( 'Submit Field', 'optin-monster' ),
            __( 'The value of the submit button field.', 'optin-monster' ),
            false,
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-submit',
                'method' => 'val'
            ),
            array( 'om-live-preview' )
        );
        $fields['submit_color'] = $instance->get_color_field(
            'submit_color',
            $instance->get_submit_setting( 'field_color', '#000000' ),
            __( 'Submit Button Color', 'optin-monster' ),
            __( 'The text color for the submit button field.', 'optin-monster' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-submit',
                'props'  => 'color'
            )
        );
        $fields['submit_bg'] = $instance->get_color_field(
            'submit_bg',
            $instance->get_submit_setting( 'bg_color', '#9df98c' ),
            __( 'Submit Button Background', 'optin-monster' ),
            __( 'The background color of the submit button.', 'optin-monster' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-submit',
                'props'  => 'background-color'
            )
        );
        $fields['submit_font'] = $instance->get_font_field(
            'submit_font',
            $instance->get_submit_setting( 'font', 'Helvetica' ),
            Optin_Monster_Output::get_instance()->get_supported_fonts(),
            __( 'Submit Button Font', 'optin-monster' ),
            __( 'The font family for the submit button field.', 'optin-monster' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-submit',
                'attr'   => 'font-family',
                'method' => 'css'
            ),
            array( 'om-live-preview' )
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

        $meta['background']['background_image'] = isset( $fields['body_background'] ) ? esc_url( $fields['body_background'] ) : '';
        $meta['bullet']['diamond_color']     = isset( $fields['diamond_color'] ) ? esc_attr( $fields['diamond_color'] ) : '';
        $meta['name']['show']                = isset( $fields['name_show'] ) ? 1 : 0;
        $meta['name']['placeholder']         = isset( $fields['name_field'] ) ? trim( strip_tags( $fields['name_field'] ) ) : '';
        $meta['name']['color']               = isset( $fields['name_color'] ) ? esc_attr( $fields['name_color'] ) : '';
        $meta['name']['font']                = isset( $fields['name_font'] ) ? trim( $fields['name_font'] ) : '';
        $meta['email']['placeholder']        = isset( $fields['email_field'] ) ? trim( strip_tags( $fields['email_field'] ) ) : '';
        $meta['email']['color']              = isset( $fields['email_color'] ) ? esc_attr( $fields['email_color'] ) : '';
        $meta['email']['font']               = isset( $fields['email_font'] ) ? trim( $fields['email_font'] ) : '';
        $meta['submit']['placeholder']       = isset( $fields['submit_field'] ) ? trim( strip_tags( $fields['submit_field'] ) ) : '';
        $meta['submit']['field_color']       = isset( $fields['submit_color'] ) ? esc_attr( $fields['submit_color'] ) : '';
        $meta['submit']['bg_color']          = isset( $fields['submit_bg'] ) ? esc_attr( $fields['submit_bg'] ) : '';
        $meta['submit']['font']              = isset( $fields['submit_font'] ) ? trim( $fields['submit_font'] ) : '';
        return $meta;

    }

    /**
     * Gets the default bullet list for an optin.
     *
     * @since 2.0.0
     *
     * @return string The bullet list HTML.
     */
    public function get_default_bullets() {

        $color = $this->get_bullet_setting( 'diamond_color', '#ffffff' );
        $html  = '<ul>';
            $html .= '<li><div class="om-diamond" style="background-color:' . $color . '">&nbsp;</div>' . __( 'Grow your email list <span style="font-style:italic">exponentially</span>', 'optin-monster' ) . '</li>';
            $html .= '<li><div class="om-diamond" style="background-color:' . $color . '">&nbsp;</div>' . __( 'Dramatically <span style="background-color:#ffff00; color:#000000;">increase</span> your conversion rates', 'optin-monster' ) . '</li>';
            $html .= '<li><div class="om-diamond" style="background-color:' . $color . '">&nbsp;</div>' . __( 'Engage more with your audience', 'optin-monster' ) . '</li>';
            $html .= '<li><div class="om-diamond" style="background-color:' . $color . '">&nbsp;</div>' . __( '<span style="font-weight:bold">Boost your current and future profits</span>', 'optin-monster' ) . '</li>';
        $html .= '</ul>';

        return $html;

    }

}