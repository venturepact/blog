<?php
/**
 * Coupon theme class.
 *
 * @since 2.1.3
 *
 * @package Optin_Monster
 * @author  Thomas Griffin
 */
class Optin_Monster_Lightbox_Theme_Coupon extends Optin_Monster_Theme {

    /**
     * Path to the file.
     *
     * @var string
     */
    public $file = __FILE__;

    /**
     * Slug of the theme.
     *
     * @var string
     */
    public $theme = 'coupon';

    /**
     * Primary class constructor.
     *
     * The constructor must invoke the parent constructor
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
        }';

        $css .= '
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin {
            background-color: #ffffcc;
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            min-height: 175px;
            width: 600px;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-wrap {
            position: relative;
            height: 100%;
            padding: 15px;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-container {
            border: 4px dashed #000;
        }';

	$css .= '
	html div#om-' . $this->optin->post_name . ' .om-close {
            position: absolute;
            top: -15px;
            right: -15px;
            display: block;
            font-family: "Verdana", Arial, sans-serif;
            font-size: 27px;
            font-weight: bold;
            color: #333333;
            color: rgba(0,0,0,0.3);
            text-decoration: none !important;
            background-color: #000;
            color: rgba(255,255,255,0.8);
            border-radius: 999em;
            height: 30px;
            width: 30px;
            text-align: center;
        }
        html div#om-' . $this->optin->post_name . ' .om-close:hover,
        html div#om-' . $this->optin->post_name . ' .om-close:focus,
        html div#om-' . $this->optin->post_name . ' .om-close:active {
            background-color: #222;
        }';

        $css .= '
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-header {
            min-height: 30px;
            margin: 0 auto;
            padding: 40px 32px;
            width: 100%;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-title {
            font-family: "Lato", Arial, sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #000;
            width: 100%;
            text-align: center;
        }';

        $css .= '
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-content {
            width: 100%;
            display: block;
            margin: 0 auto;
            padding: 0 7%;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-content-clear {
            min-height: 0;
        }
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-tagline {
            font-family: "Lato", Arial, sans-serif;
            font-size: 26px;
            text-align: center;
            line-height: 1.25;
            color: #666;
        }';

        $css .= '
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-footer {
            padding: 35px 10%;
        }
        html div#om-' . $this->optin->post_name . ' label {
            color: #333;
        }
        html div#om-' . $this->optin->post_name . ' input,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email {
            background-color: #fff;
            width: 100%;
            border: 1px solid rgba(0,0,0,0.5);
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
            border-radius: 0;
            font-size: 18px;
            line-height: 1.5em;
            margin: 0 auto 8px;
            padding: 4px 6px;
            overflow: hidden;
            outline: none;
            vertical-align: middle;
            display: block;
        }
        html div#om-' . $this->optin->post_name . ' input[type=submit],
        html div#om-' . $this->optin->post_name . ' button,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit {
            background: #ee3724;
            width: 100%;
            border: 1px solid rgba(0,0,0,0.3) !important;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            padding: 8px 10px;
            line-height: 1.5;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            height: auto;
            opacity: 1;
        }
        html div#om-' . $this->optin->post_name . ' input[type=submit]:hover,
        html div#om-' . $this->optin->post_name . ' input[type=submit]:focus,
        html div#om-' . $this->optin->post_name . ' input[type=submit]:active,
        html div#om-' . $this->optin->post_name . ' button:hover,
        html div#om-' . $this->optin->post_name . ' button:focus,
        html div#om-' . $this->optin->post_name . ' button:active,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit:hover,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit:focus,
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit:active {
            opacity: 0.8;
        }
        @media (max-width: 700px) {
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin[style] {
                width: 100%;
                position: relative;
            }
            html div#om-' . $this->optin->post_name . ' .om-close {
                right: 0;
            }
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-left,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-right,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit,
            html div#om-' . $this->optin->post_name . ' .om-has-email #om-' . $this->type . '-' . $this->theme . '-optin-email {
                float: none;
                width: 100%;
                max-width: 100%;
            }
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-left,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
            html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email {
                margin-bottom: 15px;
            }
        }';

        return $css;

    }

    /**
     * Retrieval method for getting the HTML output for a theme.
     *
     * @return string A string of HTML for the theme.
     */
    public function get_html() {

        $provider = $this->get_email_setting( 'provider', '', false );
		$html = '<div id="om-' . $this->type . '-' . $this->theme . '-optin" class="om-' . $this->type . '-' . $this->theme . ' om-clearfix om-theme-' . $this->theme . ' ' . ( $provider && 'custom' == $provider ? 'om-custom-html-form' : '' ) . '" style="background-color:' . $this->get_background_setting( 'content', '#ffffcc' ) . '">';
		$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-wrap" class="om-clearfix" data-om-action="selectable" data-om-target="#optin-monster-field-content_bg">';

			// Coupon border.
			$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-container" class="om-clearfix" style="border-color:' . $this->get_background_setting( 'border', '#000000' ) . '" data-om-action="selectable" data-om-target="#optin-monster-field-content_border">';

			// Close button.
			$html .= '<a href="#" class="om-close" title="' . esc_attr__( 'Close', 'optin-monster' ) . '">&times;</a>';

			// Header area.
			$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-header" class="om-clearfix">';
				$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-title" data-om-action="editable" data-om-field="title" style="' . $this->get_element_style( 'title', array( 'color' => '#000000', 'font' => 'Lato', 'size' => '44px', 'meta' => array( 'text-align' => 'center' ) ) ) . '">' . $this->get_title_setting( 'text', __( 'Get 25% Off Soliloquy', 'optin-monster' ) ) . '</div>';
			$html .= '</div>';

			// Content area.
			$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-content" class="om-clearfix">';
				$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-tagline" data-om-action="editable" data-om-field="tagline" style="' . $this->get_element_style( 'tagline', array( 'color' => '#666666', 'font' => 'Lato', 'size' => '22px', 'meta' => array( 'text-align' => 'center' ) ) ) . '">' . $this->get_tagline_setting( 'text', __( 'This week WPBeginner users get an exclusive discount on the best WordPress Slider.', 'optin-monster' ) ) . '</div>';
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
						$html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-name" type="text" value="" data-om-action="selectable" data-om-target="#optin-monster-field-name_field" placeholder="' . $this->get_name_setting( 'placeholder', __( 'Enter your name here...', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'name', array( 'font' => 'Open Sans' ) ) . '" />';
					}

					$html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-email" type="email" value="" data-om-action="selectable" data-om-target="#optin-monster-field-email_field" placeholder="' . $this->get_email_setting( 'placeholder', __( 'Enter your email address here...', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'email', array( 'font' => 'Open Sans' ) ) . '" />';
					$html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-submit" type="submit" data-om-action="selectable" data-om-target="#optin-monster-field-submit_field" value="' . $this->get_submit_setting( 'placeholder', __( 'Yes, I want this Exclusive Deal', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'submit', array( 'font' => 'Open Sans' ) ) . '" />';
				}

                        	$html .= '</div>';

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
     * @return string A string of JS for the theme.
     */
    public function get_js() {

    }

    /**
     * Outputs the filters needed to register controls for the OptinMonster
     * preview customizer and save the fields registered.
     */
    public function controls() {

        add_filter( 'optin_monster_panel_design_fields', array( $this, 'design_fields' ), 10, 2 );
        add_filter( 'optin_monster_panel_input_fields', array( $this, 'input_fields' ), 10, 2 );
        add_filter( 'optin_monster_save_optin', array( $this, 'save_controls' ), 10, 4 );

    }

    /**
     * Outputs the design controls for the theme.
     *
     * @param array $fields    Array of design fields.
     * @param object $instance The Edit UI instance.
     * @return array $fields   Amended array of design fields.
     */
    public function design_fields( $fields, $instance ) {

	    $fields['content_bg'] = $instance->get_color_field(
		    'content_bg',
		    $instance->get_background_setting( 'content', '#ffffcc' ),
		    __( 'Optin Content Background', 'optin-monster' ),
		    __( 'The background color of the optin.', 'optin-monster' ),
		    '-optin',
		    array(
			    'target' => '#om-' . $this->type . '-' . $this->theme . '-optin',
			    'props'  => 'background-color'
		    )
	    );

		$fields['content_border'] = $instance->get_color_field(
			'content_border',
			$instance->get_background_setting( 'border', '#000000' ),
			__( 'Optin Border', 'optin-monster' ),
			__( 'The border color of the optin.', 'optin-monster' ),
			'',
			array(
					'target' => '#om-' . $this->type . '-' . $this->theme . '-container',
					'props' => 'border-color'
			)
		);

        return $fields;

    }

    /**
     * Outputs the fields controls for the theme.
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
                'input'  => esc_attr( '<input id="om-' . $this->type . '-' . $this->theme . '-optin-name" type="text" value="" data-om-action="selectable" data-om-target="#optin-monster-field-name_field" placeholder="' . $this->get_name_setting( 'placeholder', __( 'Enter your name here...', 'optin-monster' ) ) . '" style="' . $this->get_element_style( 'name', array( 'font' => 'Open Sans' ) ) . '" />' ),
                'name'   => '#om-' . $this->type . '-' . $this->theme . '-optin-name'
            )
        );
        $fields['name_field'] = $instance->get_text_field(
            'name_field',
            $instance->get_name_setting( 'placeholder', __( 'Enter your name here...', 'optin-monster' ) ),
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
            $instance->get_name_setting( 'font', 'Open Sans' ),
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
            $instance->get_email_setting( 'placeholder', __( 'Enter your email address here...', 'optin-monster' ) ),
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
            $instance->get_email_setting( 'font', 'Open Sans' ),
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
            $instance->get_submit_setting( 'placeholder', __( 'Yes, I want this Exclusive Deal', 'optin-monster' ) ),
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
            $instance->get_submit_setting( 'field_color', '#fff' ),
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
            $instance->get_submit_setting( 'bg_color', '#ee3724' ),
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
            $instance->get_submit_setting( 'font', 'Open Sans' ),
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
     * @param array $meta      The meta key "_om_meta" with all of its data.
     * @param int $optin_id    The optin ID to target.
     * @param array $fields    The post fields under the key "optin_monster".
     * @param array $post_data All of the $_POST contents generated when saving.
     * @return array $meta     Amended array of meta to be saved.
     */
    public function save_controls( $meta, $optin_id, $fields, $post_data ) {

		$meta['background']['content']       = isset( $fields['content_bg'] ) ? esc_attr( $fields['content_bg'] ) : '';
        $meta['background']['border']        = isset( $fields['content_border'] ) ? esc_attr( $fields['content_border'] ) : '';
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

}