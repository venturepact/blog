<?php


class Optin_Monster_Post_Theme_Action extends Optin_Monster_Theme {

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
	public $theme = 'action';

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
		}
		html div#om-' . $this->optin->post_name . ' {
			background:none;
            border:0;
            border-radius:0;
            -webkit-border-radius:0;
            -moz-border-radius:0;
            float:none;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
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
			position: relative;
			padding: 20px;
			text-align: center;
			margin: 0 auto;
			max-width: 100%;
			width: 100%;
		}
		html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-title {
			font-size: 18px;
			color: #222;
			width: 100%;
			margin-bottom: 15px;
		}
        html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-tagline {
			font-size: 16px;
			line-height: 1.25;
			color: #484848;
			width: 100%;
			margin-bottom: 15px;
		}
		html div#om-' . $this->optin->post_name . ' input,
		html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-name,
		html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-email {
			background-color: #fff;
			width: 100%;
			border: 1px solid #ddd;
			font-size: 16px;
			line-height: 24px;
			padding: 4px 6px;
			overflow: hidden;
			outline: none;
			margin: 0 0 10px;
			vertical-align: middle;
			display: inline;
			color: #222;
			height: 34px;
		}
		html div#om-' . $this->optin->post_name . ' input[type=submit],
		html div#om-' . $this->optin->post_name . ' button,
		html div#om-' . $this->optin->post_name . ' #om-' . $this->type . '-' . $this->theme . '-optin-submit {
			background: #ff370f;
			border: 1px solid #ff370f;
			color: #fff;
			font-size: 16px;
			padding: 4px 6px;
			line-height: 24px;
			text-align: center;
			vertical-align: middle;
			cursor: pointer;
			display: inline;
			margin: 0;
			width: 100%;
		}
		html div#om-' . $this->optin->post_name . ' input[type=checkbox],
		html div#om-' . $this->optin->post_name . ' input[type=radio] {
		    -webkit-appearance: checkbox;
		    width: auto;
		    outline: invert none medium;
		    padding: 0;
		    margin: 0;
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
        $html = '<div id="om-' . $this->type . '-' . $this->theme . '-optin" class="om-' . $this->type . '-' . $this->theme . ' om-clearfix om-theme-' . $this->theme . ' ' . ( $provider && 'custom' == $provider ? 'om-custom-html-form' : '' ) . '" style="background-color:' . $this->get_background_setting( 'content', '#fff' ) . '">';
            $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-wrap" class="om-clearfix">';

                // Header area.
                $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-header" class="om-clearfix" data-om-action="selectable">';
                    $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-title" data-om-action="editable" data-om-field="title" style="' . $this->get_element_style( 'title', array( 'color' => '#222222', 'font' => 'Helvetica', 'size' => '18px' ) ) . '">' . $this->get_title_setting( 'text', __( 'OptinMonster is the #1 lead generation platform for WordPress.', 'optin-monster-post' ) ) . '</div>';
                $html .= '</div>';

                // Content area.
                $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-content" class="om-clearfix" data-om-action="selectable">';
					$html .= '<div id="om-' . $this->type . '-' . $this->theme . '-optin-tagline" data-om-action="editable" data-om-field="tagline" style="' . $this->get_element_style( 'tagline', array( 'color' => '#484848', 'font' => 'Helvetica', 'size' => '16px' ) ) . '">' . $this->get_tagline_setting( 'text', __( 'OptinMonster allows you to explode your email list by using our incredible exit intent technology.', 'optin-monster-post' ) ) . '</div>';
                $html .= '</div>';

                // Footer area.
                $show_name  = $this->get_name_setting( 'show' );
                $class_name = $show_name ? ' om-has-name-email' : ' om-has-email';
                $html .= '<div id="om-' . $this->type . '-' . $this->theme . '-footer" class="om-clearfix' . $class_name . '" data-om-action="selectable">';

                    // Show either the custom HTML form entered by the user or the custom fields in the Fields pane.
                    if ( isset( $this->meta['email']['provider'] ) && 'custom' == $this->meta['email']['provider'] ) {
                        $html .= do_shortcode( html_entity_decode( $this->meta['custom_html'] ) );
                    } else {
                        // Possibly show the name field.
                        if ( $show_name ) {
                            $html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-name" type="text" value="" data-om-action="selectable" data-om-target="#optin-monster-field-name_field" placeholder="' . $this->get_name_setting( 'placeholder', __( 'Enter your name here...', 'optin-monster-post' ) ) . '" style="' . $this->get_element_style( 'name', array( 'font' => 'Helvetica' ) ) . '" />';
                        }

                        $html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-email" type="email" value="" data-om-action="selectable" data-om-target="#optin-monster-field-email_field" placeholder="' . $this->get_email_setting( 'placeholder', __( 'Enter your email address here...', 'optin-monster-post' ) ) . '" style="' . $this->get_element_style( 'email', array( 'font' => 'Helvetica' ) ) . '" />';
                        $html .= '<input id="om-' . $this->type . '-' . $this->theme . '-optin-submit" type="submit" data-om-action="selectable" data-om-target="#optin-monster-field-submit_field" value="' . $this->get_submit_setting( 'placeholder', __( 'Sign Up', 'optin-monster-post' ) ) . '" style="' . $this->get_element_style( 'submit', array( 'font' => 'Helvetica' ) ) . '" />';
                    }

                $html .= '</div>';

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

		$fields['content_bg'] = $instance->get_color_field(
			'content_bg',
			$instance->get_background_setting( 'content', '#fff' ),
			__( 'Background Color', 'optin-monster-post' ),
			__( 'The background color of the optin.', 'optin-monster-post' ),
			'',
			array(
				'target' => '#om-' . $this->type . '-' . $this->theme . '-optin',
				'props' => 'background-color'
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
        $fields['name_header'] = $instance->get_field_header( __( 'Name Field', 'optin-monster-post' ), 'name', true );
        $fields['name_show'] = $instance->get_checkbox_field(
            'name_show',
            $instance->get_name_setting( 'show' ),
            __( 'Show optin name field?', 'optin-monster-post' ),
            __( 'Displays or hides the name field in the optin.', 'optin-monster-post' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-footer',
                'input'  => esc_attr( '<input id="om-' . $this->type . '-' . $this->theme . '-optin-name" type="text" value="" data-om-action="selectable" data-om-target="#optin-monster-field-name_field" placeholder="' . $this->get_name_setting( 'placeholder', __( 'Enter your name here...', 'optin-monster-post' ) ) . '" style="' . $this->get_element_style( 'name', array( 'font' => 'Helvetica' ) ) . '" />' ),
                'name'   => '#om-' . $this->type . '-' . $this->theme . '-optin-name'
            )
        );
        $fields['name_field'] = $instance->get_text_field(
            'name_field',
            $instance->get_name_setting( 'placeholder', __( 'Enter your name here...', 'optin-monster-post' ) ),
            __( 'Name Placeholder', 'optin-monster-post' ),
            __( 'The placeholder text for the email field.', 'optin-monster-post' ),
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
            __( 'Name Color', 'optin-monster-post' ),
            __( 'The text color for the name field.', 'optin-monster-post' ),
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
            __( 'Name Font', 'optin-monster-post' ),
            __( 'The font family for the name field.', 'optin-monster-post' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-name',
                'attr'   => 'font-family',
                'method' => 'css'
            ),
            array( 'om-live-preview' )
        );

        // Build the email field.
        $fields['email_header'] = $instance->get_field_header( __( 'Email Field', 'optin-monster-post' ), 'email' );
        $fields['email_field'] = $instance->get_text_field(
            'email_field',
            $instance->get_email_setting( 'placeholder', __( 'Enter your email address here...', 'optin-monster-post' ) ),
            __( 'Email Placeholder', 'optin-monster-post' ),
            __( 'The placeholder text for the email field.', 'optin-monster-post' ),
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
            __( 'Email Color', 'optin-monster-post' ),
            __( 'The text color for the email field.', 'optin-monster-post' ),
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
            __( 'Email Font', 'optin-monster-post' ),
            __( 'The font family for the email field.', 'optin-monster-post' ),
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-email',
                'attr'   => 'font-family',
                'method' => 'css'
            ),
            array( 'om-live-preview' )
        );

        // Build the submit field.
        $fields['submit_header'] = $instance->get_field_header( __( 'Submit Field', 'optin-monster-post' ), 'submit' );
        $fields['submit_field'] = $instance->get_text_field(
            'submit_field',
            $instance->get_submit_setting( 'placeholder', __( 'Sign Up', 'optin-monster-post' ) ),
            __( 'Submit Field', 'optin-monster-post' ),
            __( 'The value of the submit button field.', 'optin-monster-post' ),
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
            __( 'Submit Button Color', 'optin-monster-post' ),
            __( 'The text color for the submit button field.', 'optin-monster-post' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-submit',
                'props'  => 'color'
            )
        );
        $fields['submit_bg'] = $instance->get_color_field(
            'submit_bg',
            $instance->get_submit_setting( 'bg_color', '#ff370f' ),
            __( 'Submit Button Background', 'optin-monster-post' ),
            __( 'The background color of the submit button.', 'optin-monster-post' ),
            '',
            array(
                'target' => '#om-' . $this->type . '-' . $this->theme . '-optin-submit',
                'props'  => 'background-color, border-color'
            )
        );
        $fields['submit_font'] = $instance->get_font_field(
            'submit_font',
            $instance->get_submit_setting( 'font', 'Helvetica' ),
            Optin_Monster_Output::get_instance()->get_supported_fonts(),
            __( 'Submit Button Font', 'optin-monster-post' ),
            __( 'The font family for the submit button field.', 'optin-monster-post' ),
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

		$meta['background']['content'] = isset( $fields['content_bg'] ) ? esc_attr( $fields['content_bg'] ) : '';
		$meta['name']['show']          = isset( $fields['name_show'] ) ? 1 : 0;
		$meta['name']['placeholder']   = isset( $fields['name_field'] ) ? trim( strip_tags( $fields['name_field'] ) ) : '';
		$meta['name']['color']         = isset( $fields['name_color'] ) ? esc_attr( $fields['name_color'] ) : '';
		$meta['name']['font']          = isset( $fields['name_font'] ) ? trim( $fields['name_font'] ) : '';
		$meta['email']['placeholder']  = isset( $fields['email_field'] ) ? trim( strip_tags( $fields['email_field'] ) ) : '';
		$meta['email']['color']        = isset( $fields['email_color'] ) ? esc_attr( $fields['email_color'] ) : '';
		$meta['email']['font']         = isset( $fields['email_font'] ) ? trim( $fields['email_font'] ) : '';
		$meta['submit']['placeholder'] = isset( $fields['submit_field'] ) ? trim( strip_tags( $fields['submit_field'] ) ) : '';
		$meta['submit']['field_color'] = isset( $fields['submit_color'] ) ? esc_attr( $fields['submit_color'] ) : '';
		$meta['submit']['bg_color']    = isset( $fields['submit_bg'] ) ? esc_attr( $fields['submit_bg'] ) : '';
		$meta['submit']['font']        = isset( $fields['submit_font'] ) ? trim( $fields['submit_font'] ) : '';
		return $meta;

	}

}