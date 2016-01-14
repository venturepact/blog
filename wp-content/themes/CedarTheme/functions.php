<?php

	/**
	 * 
	 * 	CEDAR THEME
	 *
	 * 	@author EckoThemes <support@ecko.me>
	 * 	@version 1.2.2
	 * 	@link http://ecko.me
	 * 
	 */


	/*-----------------------------------------------------------------------------------*/
	/* CONFIGURATION
	/*-----------------------------------------------------------------------------------*/

	define( 'ECKO_THEME_ID', 'cedarwp' );
	define( 'ECKO_THEME_NAME', 'Cedar' );
	define( 'ECKO_THEME_VERSION', '1.2.2' );
	define( 'ECKO_THEME_WIDTH', '700' );


	/*-----------------------------------------------------------------------------------*/
	/* FRAMEWORK
	/*-----------------------------------------------------------------------------------*/

	require_once get_template_directory() . '/inc/ecko-framework.php';


	/*-----------------------------------------------------------------------------------*/
	/* THEME SETUP
	/*-----------------------------------------------------------------------------------*/

	function cedar_theme_setup(){
		add_theme_support('post-formats', array('status', 'aside', 'image', 'quote', 'video', 'audio'));
	}
	add_action('after_setup_theme', 'cedar_theme_setup');

	register_nav_menus( 
		array(
			'primary'	=>	esc_attr__( 'Primary Menu', ECKO_THEME_ID),
			'blogheader'	=>	esc_attr__( 'Blog Header Menu', ECKO_THEME_ID),
		)
	);


	/*-----------------------------------------------------------------------------------*/
	/* ENQUE STYLES AND SCRIPTS
	/*-----------------------------------------------------------------------------------*/

	function cedar_load_scripts() {
		if(!is_admin()){
			// FONT ASSETS
			if(get_theme_mod('general_use_extended_char_set')){
				wp_register_style( 'cedar_fonts', '//fonts.googleapis.com/css?family=Noto+Serif:400,700|Montserrat|Varela+Round|Oxygen&subset=latin,latin-ext', array(), ECKO_THEME_ID );
			}else{
				wp_register_style( 'cedar_fonts', '//fonts.googleapis.com/css?family=Noto+Serif:400,700|Montserrat|Varela+Round|Oxygen', array(), ECKO_THEME_ID );
			}
			wp_enqueue_style( 'cedar_fonts' );
			// JAVASCRIPT VARS
			wp_localize_script( 'ecko_js', 'ecko_theme_vars', array(
				'general_hidecomments' => esc_js(get_theme_mod('general_hidecomments', 'false')),
				'general_disable_syntax_highlighter' => esc_js(get_theme_mod('general_disable_syntax_highlighter', 'false')),
				'videocover_mp4' => get_theme_mod('videocover_mp4', ''),
				'videocover_webm' => get_theme_mod('videocover_webm', ''),
				'localization_viewcomments' => esc_js(esc_html__('View Comments', ECKO_THEME_ID)),
				'localization_comments' => esc_js(esc_html__('Comments', ECKO_THEME_ID))
			));
		}
	}
	add_action( 'wp_enqueue_scripts', 'cedar_load_scripts' );


	/*-----------------------------------------------------------------------------------*/
	/* REGISTER THEME RECOMMENDED PLUGINS
	/*-----------------------------------------------------------------------------------*/

	function cedar_register_plugins() {
		$ecko_plugins = ecko_default_plugins();
		array_push($ecko_plugins, array(
			'name'      => 'Categories Images',
			'slug'      => 'categories-images',
			'required'  => false,
		));
		tgmpa( $ecko_plugins );
	}
	add_action( 'tgmpa_register', 'cedar_register_plugins' );


	/*-----------------------------------------------------------------------------------*/
	/* ADD GOOGLE FONT SUPPORT
	/*-----------------------------------------------------------------------------------*/

	function cedar_font_controls( $font_options ) {
		$font_options = array(
			'tt_body_normal' => array(
				'name'        => 'tt_body_normal',
				'title'       => "Body Font (Normal)",
				'description' => "Select a font for the theme's body font (Normal).",
				'properties'  => array( 'selector' => apply_filters( 'tt_body_normal', '.postcontents, .postcontents p, .postcontents ul, .postcontents ol, .postcontents .annotation .main p, .postlist article.format-status .content > p:first-child, .postitem .excerpt, .widget p' ) ),
			),
			'tt_body_bold' => array(
				'name'        => 'tt_body_bold',
				'title'       => "Body Font (Bold)",
				'description' => "Select a font for the theme's body font (Bold).",
				'properties'  => array( 'selector' => apply_filters( 'tt_body_bold', '' ) ),
			),
			'tt_body_alternative' => array(
				'name'        => 'tt_body_alternative',
				'title'       => "Alternative Body Font",
				'description' => "Select a font for the theme's alternative body font.",
				'properties'  => array( 'selector' => apply_filters( 'tt_body_alternative', 'li.comment .body p, .comment-respond textarea, footer.postinfo .authorinfo, body, textarea, .widget.twitter .text ' ) ),
			),
			'tt_header' => array(
				'name'        => 'tt_header',
				'title'       => "Header Font",
				'description' => "Select a font for the theme's header font.",
				'properties'  => array( 'selector' => apply_filters( 'tt_header', '.altpageheader, .authortitle h3, header.bloginfo .title, .blogtitle h1, .blogtitle .description, .categorytitle .name, .categorytitle p, .commentheader, li.comment h4, footer.main .copyright .main, footer.postinfo .relatedposts .title, .postcontents h1, .postcontents h2, .postcontents h3, .postcontents .annotation .main h5, .posttitle .excerpt, .searchoverlay form input, .widget.blog_info h1, .widget.latestposts h5, .widget.copyright .main, .drawer .widget.authorprofile .meta h3 a' ) ),
			),
			'tt_sub_header' => array(
				'name'        => 'tt_sub_header',
				'title'       => "Sub Header Font",
				'description' => "Select a font for the theme's sub header font.",
				'properties'  => array( 'selector' => apply_filters( 'tt_sub_header', '.altpageheader .postcount, .commentheader .commentcount, .commentitems .notification, li.comment .meta .info, li.comment .buttons a, li.comment .buttons span, .comment-respond, footer.main .copyright .alt, footer.postinfo .postoptions , footer.postinfo .relatedposts span , .tags a, .tagcloud a, nav.main ul a, nav.main ul span , nav.pagination .previous, nav.pagination .next, nav.pagination ul.page-numbers li, body.single-post .widget.authorprofile .meta .title, body.page .widget.authorprofile .meta .title, .authortitle .meta .title, body.single-post .widget.authorprofile .meta .twittertag, body.page .widget.authorprofile .meta .twittertag, .authortitle .meta .twittertag, body.single-post .widget.authorprofile .meta h3 a, body.page .widget.authorprofile .meta h3 a, .authortitle .meta .meta h3 a, body.single-post .widget.authorprofile p, body.page .widget.authorprofile p, .authortitle .meta p, .postbottom .category, .postbottom .permalink, .postbottom .sharebuttons .li:first-child, .postcontents h4, .postcontents h5, .postcontents h6, .wide blockquote, blockquote, .postlist article.format-quote .content > blockquote:first-child, .postlist article.format-quote .content > blockquote:first-child cite, .postitem .meta .category a, .postitem .meta .date a, .postitem .meta .readtime a, .postitem .meta .issticky a, .postitem h1, .postitem h2, .postitem .author, .alert, .shortbutton, .shorttabs .shorttabsheader, .shortprogress .percentage, .widget .widget-title, .widget li a, .widget.navigation, .widget.twitter .author, .widget.twitter .date, .widget .searchform input, .widget.latestposts .category, .widget.relatedposts .feature:after, .widget.relatedposts h4 , .widget.subscribe input[type="email"], .widget.subscribe input[type="submit"], .widget.copyright .alt, .drawer .widget.authorprofile .meta .title, .drawer .widget.authorprofile .meta .twittertag, #wp-calendar ' ) ),
			),
		);
		return $font_options;
	}
	add_filter( 'tt_font_get_option_parameters', 'cedar_font_controls' );


	/*-----------------------------------------------------------------------------------*/
	/* POST META BOX SETTINGS
	/*-----------------------------------------------------------------------------------*/

	function cedar_option_meta_box_setup() {
		add_action( 'add_meta_boxes', 'cedar_add_option_boxes' );
		add_action( 'save_post', 'cedar_save_option_meta', 10, 2 );
	}

	function cedar_add_option_boxes() {
		add_meta_box(
			'cedar-post-options',
			esc_html__( 'Theme Post Options', ECKO_THEME_ID ),
			'cedar_options_meta_box',
			'post',
			'side',
			'core'
		);
		add_meta_box(
			'cedar-post-options',
			esc_html__( 'Theme Post Options', ECKO_THEME_ID ),
			'cedar_options_meta_box',
			'page',
			'side',
			'core'
		);
	}

	function cedar_options_meta_box( $object, $box ) { 
		global $post;
		wp_nonce_field( basename( __FILE__ ), 'cedar_cover_enabled' );
		wp_nonce_field( basename( __FILE__ ), 'cedar_cover_height' );
		wp_nonce_field( basename( __FILE__ ), 'cedar_cover_color' );
		wp_nonce_field( basename( __FILE__ ), 'cedar_cover_opacity' );
		wp_nonce_field( basename( __FILE__ ), 'cedar_title_center' );
		wp_nonce_field( basename( __FILE__ ), 'cedar_subtitle' );
		wp_nonce_field( basename( __FILE__ ), 'cedar_postlist_image' );
		$cedar_cover_enabled_meta = get_post_meta($post->ID, 'cedar_cover_enabled', true);
		$cedar_cover_height_meta = get_post_meta($post->ID, 'cedar_cover_height', true);
		$cedar_cover_color_meta = get_post_meta($post->ID, 'cedar_cover_color', true);
		$cedar_cover_opacity_meta = get_post_meta($post->ID, 'cedar_cover_opacity', true);
		$cedar_title_center_meta = get_post_meta($post->ID, 'cedar_title_center', true);
		$cedar_subtitle_meta = get_post_meta($post->ID, 'cedar_subtitle', true);
		$cedar_postlist_image_meta = get_post_meta($post->ID, 'cedar_postlist_image', true);

	?>
		<p>
			<label>
				<input type="checkbox" name="cedar_cover_enabled" id="cedar_cover_enabled" value="yes" <?php checked( $cedar_cover_enabled_meta, 'yes' ); ?> />
				Enable Post Cover Title
			</label>
			<p class="howto">If enabled, will use the cover title style for this post. The post 'Featured Image' will be used as the background.</p>
		</p>
		<hr>
		<p>

			<label>
				Post Subtitle
				<textarea class="widefat" rows="3" name="cedar_subtitle" id="cedar_subtitle"><?php echo esc_html($cedar_subtitle_meta); ?></textarea>
			</label>
			<p class="howto">Set a subtitle which is shown below the post title on the post page.</p>
		</p>
		<hr>
		<p>
			<label>
				<input type="number" min="50" max="100" name="cedar_cover_height" id="cedar_cover_height" placeholder="100" value="<?php echo esc_attr($cedar_cover_height_meta); ?>" />
				Cover Height (%)
			</label>
			<p class="howto">Override the default (100%) height of the cover title. Leave empty for default value.</p>
		</p>
		<hr>
		<p>
			<label>
				<input type="text" class="widefat" name="cedar_cover_color" id="cedar_cover_color" colums="6" placeholder="101010" value="<?php echo esc_attr($cedar_cover_color_meta); ?>" />
				Cover Background Color (HEX)
			</label>
			<p class="howto">Override the default background color of the cover title. Leave empty for default value.</p>
		</p>
		<hr>
		<p>
			<label>
				<input type="number" min="0" max="100" name="cedar_cover_opacity" id="cedar_cover_opacity" placeholder="20" value="<?php echo esc_attr($cedar_cover_opacity_meta); ?>" />
				Cover Image Opacity (%)
			</label>
			<p class="howto">Override the default background image opacity of the cover title. Leave empty for default value (20%). Will disable title fade effect.</p>
		</p>
		<hr>
		<p>
			<label>
				<input type="checkbox" name="cedar_title_center" id="cedar_title_center" value="yes" <?php checked( $cedar_title_center_meta, 'yes' ); ?> />
				Center Post Title
			</label>
			<p class="howto">If enabled, will center the standard and cover post title styles.</p>
		</p>
		<hr>
		<p>
			<label>
				<input type="checkbox" name="cedar_postlist_image" id="cedar_postlist_image" value="yes" <?php checked( $cedar_postlist_image_meta, 'yes' ); ?> />
				Show Postlist Image
			</label>
			<p class="howto">If enabled, will show the 'Featued Image' image above the title in the post list (Standard format only).</p>
		</p>

	<?php }

	function cedar_save_option_meta( $post_id, $post ) {
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );

		$cedar_cover_enabled_meta  = ( isset( $_POST[ 'cedar_cover_enabled' ] ) && wp_verify_nonce( $_POST[ 'cedar_cover_enabled' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		$cedar_subtitle_meta  = ( isset( $_POST[ 'cedar_subtitle' ] ) && wp_verify_nonce( $_POST[ 'cedar_subtitle' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		$cedar_cover_height_meta  = ( isset( $_POST[ 'cedar_cover_height' ] ) && wp_verify_nonce( $_POST[ 'cedar_cover_height' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		$cedar_cover_color_meta  = ( isset( $_POST[ 'cedar_cover_color' ] ) && wp_verify_nonce( $_POST[ 'cedar_cover_color' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		$cedar_cover_opacity_meta  = ( isset( $_POST[ 'cedar_cover_opacity' ] ) && wp_verify_nonce( $_POST[ 'cedar_cover_opacity' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		$cedar_title_center_meta  = ( isset( $_POST[ 'cedar_title_center' ] ) && wp_verify_nonce( $_POST[ 'cedar_title_center' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
		$cedar_postlist_image_meta  = ( isset( $_POST[ 'cedar_postlist_image' ] ) && wp_verify_nonce( $_POST[ 'cedar_postlist_image' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		if ( $is_autosave || $is_revision && !$cedar_cover_enabled_meta && !$cedar_subtitle_meta && !$cedar_cover_height_meta  && !$cedar_cover_color_meta && !$cedar_title_center_meta && !$cedar_postlist_image_meta && !$cedar_cover_opacity_meta) {
			return;
		}
		if( isset( $_POST[ 'cedar_cover_enabled' ] ) ) {
			update_post_meta( $post_id, 'cedar_cover_enabled', sanitize_text_field( $_POST[ 'cedar_cover_enabled' ] ) );
		}
		if( isset( $_POST[ 'cedar_subtitle' ] ) ) {
			update_post_meta( $post_id, 'cedar_subtitle', sanitize_text_field( $_POST[ 'cedar_subtitle' ] ) );
		}
		if( isset( $_POST[ 'cedar_cover_height' ] ) ) {
			update_post_meta( $post_id, 'cedar_cover_height', sanitize_text_field( $_POST[ 'cedar_cover_height' ] ) );
		}
		if( isset( $_POST[ 'cedar_cover_color' ] ) ) {
			update_post_meta( $post_id, 'cedar_cover_color', sanitize_text_field( $_POST[ 'cedar_cover_color' ] ) );
		}
		if( isset( $_POST[ 'cedar_cover_opacity' ] ) ) {
			update_post_meta( $post_id, 'cedar_cover_opacity', sanitize_text_field( $_POST[ 'cedar_cover_opacity' ] ) );
		}
		if( isset( $_POST[ 'cedar_title_center' ] ) ) {
			update_post_meta( $post_id, 'cedar_title_center', sanitize_text_field( $_POST[ 'cedar_title_center' ] ) );
		}
		if( isset( $_POST[ 'cedar_postlist_image' ] ) ) {
			update_post_meta( $post_id, 'cedar_postlist_image', sanitize_text_field( $_POST[ 'cedar_postlist_image' ] ) );
		}
	}

	add_action( 'load-post.php', 'cedar_option_meta_box_setup' );
	add_action( 'load-post-new.php', 'cedar_option_meta_box_setup' );


	/*-----------------------------------------------------------------------------------*/
	/* POST OPTIONS
	/*-----------------------------------------------------------------------------------*/
	function cedar_header_post_options(){
		global $post;
		if(is_single() || is_page()){
			$cedar_cover_opacity_meta = get_post_meta($post->ID, 'cedar_cover_opacity', true);
			$cedar_cover_opacity_meta = (!empty($cedar_cover_opacity_meta) ? (get_post_meta($post->ID, 'cedar_cover_opacity', true) / 100) : '0.2' );
			if($cedar_cover_opacity_meta != '0.2'){
				echo "<style>body.page .cover .background, body.single .cover .background{ opacity: {$cedar_cover_opacity_meta}; animation: none; -webkit-animation: none;}</style>";
			}
		}
	}
	add_filter('wp_head', 'cedar_header_post_options');



	/*-----------------------------------------------------------------------------------*/
	/* PAGINATION
	/*-----------------------------------------------------------------------------------*/

	add_filter('next_posts_link_attributes', 'cedar_posts_link_left_attributes');
	add_filter('previous_posts_link_attributes', 'cedar_posts_link_right_attributes');

	function cedar_posts_link_left_attributes() {
		return 'class="button rounded light previous"';
	}

	function cedar_posts_link_right_attributes() {
		return 'class="button rounded light next"';
	}


	/*-----------------------------------------------------------------------------------*/
	/* DEFAULT WIDGETS
	/*-----------------------------------------------------------------------------------*/

	function cedar_get_default_widgets(){
		if( class_exists('ecko_widget_blog_info') ){ the_widget('ecko_widget_blog_info'); }
		if( class_exists('ecko_widget_navigation') ){ the_widget('ecko_widget_navigation', array( 'title' => '' )); }
		if( class_exists('ecko_widget_latest_posts') ){ the_widget('ecko_widget_latest_posts', array( 'title' => '', 'postcount' => 2 )); }
		the_widget('WP_Widget_Search', '', array(
			'before_widget' => '<section class="widget">',
			'after_widget'  => '</section>'
		));
		if( class_exists('ecko_widget_share') ){ 
			the_widget('ecko_widget_share', array( 'title' => '', 
				'facebook' => 'on', 
				'twitter' => 'on',
				'googleplus' => 'on',
				'reddit' => 'on',
				'pinterest' => 'on',
				'linkedin' => 'on'
			));
		}
		the_widget('WP_Widget_Calendar', '', array(
			'before_widget' => '<section class="widget">',
			'after_widget'  => '</section>'
		));
		the_widget('WP_Widget_Categories', '', array(
			'before_widget' => '<section class="widget">',
			'after_widget'  => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3><hr>'
		));
	}


	/*-----------------------------------------------------------------------------------*/
	/* BLOG COVER - STICKY POST OPTION
	/*-----------------------------------------------------------------------------------*/

	function cedar_sticky_post_loop($query){
		if(get_theme_mod('blogcover_use_sticky_post', false) && is_home()){
			$query->set('post__not_in',get_option( 'sticky_posts' ));
		}
		return $query;
	}
	add_filter('pre_get_posts', 'cedar_sticky_post_loop');


	/*-----------------------------------------------------------------------------------*/
	/* CATGEORY OPTIONS
	/*-----------------------------------------------------------------------------------*/

	function cedar_category_options( $tag ) {
		$category_meta_title = 'category_meta_' . $tag->term_id . '_color';
		$category_meta = get_option( $category_meta_title );
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="category-color"><?php esc_html_e("Category HEX Color Value"); ?></label></th>
			<td>
				<input id="category-color" name="<?php echo $category_meta_title; ?>" value="<?php if ( isset( $category_meta ) ) esc_attr_e( $category_meta ); ?>" />
				<p class="description">Enter a color to associate with this category. The color must be in HEX format (E.g. 009bbb )</p>
			</td>
		</tr>
		<?php
	}

	function cedar_save_category_options( $term_id ) {
		$category_meta_title = 'category_meta_' . $term_id. '_color';
		if ( isset( $_POST[$category_meta_title] ) && !update_option($category_meta_title, $_POST[$category_meta_title]) )
			add_option($category_meta_title, $_POST[$category_meta_title]);
	}

	add_action( 'edit_category_form_fields', 'cedar_category_options' );
	add_action( 'edit_category', 'cedar_save_category_options' );


	/*-----------------------------------------------------------------------------------*/
	/* COMMENT FORMATTING
	/*-----------------------------------------------------------------------------------*/

	function cedar_comment_format($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		?>
			<li <?php comment_class('comment'); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>">
				<div class="contents">
					<a target="_blank" href="<?php comment_author_url(); ?>" class="profile">
						<img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5($comment->comment_author_email)); ?>?s=96" class="gravatar" alt="<?php comment_author(); ?>">
					</a>
					<div class="main">
						<div class="commentinfo">
							<section class="meta">
								<div class="info"><?php esc_html_e('Posted', ECKO_THEME_ID) ; ?> <span class="date"><?php esc_html_e('on', ECKO_THEME_ID) ; ?> <i class="fa fa-clock-o"></i> <time datetime="<?php comment_date('Y-m-d'); ?>"><?php comment_date(get_option('date_format')); ?></time></span></div>
								<h4 class="author"><a href="<?php comment_author_url(); ?>"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5($comment->comment_author_email)); ?>?s=24" class="gravatarsmall" alt="<?php comment_author(); ?>"> <?php comment_author(); ?></a></h4>
							</section>
							<div class="buttons">
								<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
								<span class="button rounded solidgray smaller isauthor"><?php esc_html_e('Author', ECKO_THEME_ID); ?></span>
							</div>
						</div>
						<div class="body">
							<?php comment_text(); ?>
						</div>
						<hr>
					</div>
				</div>
		<?php
	}


	/*-----------------------------------------------------------------------------------*/
	/* THEME CUSTOMIZER SETTINGS
	/*-----------------------------------------------------------------------------------*/

	function cedar_customize_register( $wp_customize ) {


		/*
		 * LAYOUT SECTION
		 */
		$wp_customize->add_section( 'layout_section',
			array(
				'title' => 'Layout',
				'description' => 'This section contains layout options.',
				'priority' => 19,
			)
		);

		$wp_customize->add_setting( 'layout_width',
		array(
			'sanitize_callback' => 'ecko_sanitize_int',
			'default'     => 700,
		));
		$wp_customize->add_control( 'layout_width',
			array(
				'type'        => 'range',
				'section'     => 'layout_section',
				'label'       => 'Page Width (Default 700 > 1200px)',
				'input_attrs' => array(
					'min'   => 700,
					'max'   => 1200,
					'step'  => 10
				),
			)
		);


		/*
		 * BLOG COVER SECTION
		 */
		$wp_customize->add_section( 'blogcover_section',
			array(
				'title' => 'Blog Cover',
				'description' => 'This section contains blog cover options.',
				'priority' => 20,
			)
		);

		$wp_customize->add_setting( 'blogcover_disable',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogcover_disable',
			array(
				'type' => 'checkbox',
				'label' => 'Disable Blog Cover Image',
				'section' => 'blogcover_section',
			)
		);

		$wp_customize->add_setting( 'blogcover_use_sticky_post',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogcover_use_sticky_post',
			array(
				'type' => 'checkbox',
				'label' => 'Use Newest Sticky Post as Title',
				'section' => 'blogcover_section',
			)
		);	

		$wp_customize->add_setting( 'blogcover_background',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogcover_background',
				array(
					'label' => 'Blog Cover Background',
					'section' => 'blogcover_section',
					'settings' => 'blogcover_background'
				)
			)
		);

		$wp_customize->add_setting( 'blogcover_logo',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogcover_logo',
				array(
					'label' => 'Blog Cover Logo',
					'section' => 'blogcover_section',
					'settings' => 'blogcover_logo'
				)
			)
		);

		$wp_customize->add_setting( 'blogcover_logo_retina',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogcover_logo_retina',
				array(
					'label' => 'Blog Cover Logo (Retina - @2x file name)',
					'section' => 'blogcover_section',
					'settings' => 'blogcover_logo_retina'
				)
			)
		);

		$wp_customize->add_setting( 'blogcover_height',
		array(
			'sanitize_callback' => 'ecko_sanitize_int',
			'default' => 100
		));
		$wp_customize->add_control( 'blogcover_height', array(
			'type'        => 'range',
			'section'     => 'blogcover_section',
			'label'       => 'Blog Cover Height (50% > 100%)',
			'input_attrs' => array(
				'min'   => 50,
				'max'   => 100,
				'step'  => 1
			),
		));

		$wp_customize->add_setting( 'blogcover_opacity',
		array(
			'sanitize_callback' => 'ecko_sanitize_int',
			'default' => 20
		));
		$wp_customize->add_control( 'blogcover_opacity', array(
			'type'        => 'range',
			'section'     => 'blogcover_section',
			'label'       => 'Blog Cover Opacity (0% > 100%)',
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 100,
				'step'  => 1
			),
		));

		$wp_customize->add_setting( 'blogcover_center',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogcover_center',
			array(
				'type' => 'checkbox',
				'label' => 'Center Blog Cover Title',
				'section' => 'blogcover_section',
			)
		);	

		$wp_customize->add_setting( 'blogcover_hide_scroll_icon',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogcover_hide_scroll_icon',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Mouse Scroll Icon',
				'section' => 'blogcover_section',
			)
		);	

		$wp_customize->add_setting( 'blogcover_use_pattern_overlay',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogcover_use_pattern_overlay',
			array(
				'type' => 'checkbox',
				'label' => 'Use Pattern Overlay',
				'section' => 'blogcover_section',
			)
		);


		/*
		 * BLOG COVER SECTION - VIDEO
		 */
		$wp_customize->add_section( 'videocover_section',
			array(
				'title' => 'Video Blog Cover',
				'description' => 'This section contains blog cover options.',
				'priority' => 20,
			)
		);

		$wp_customize->add_setting( 'videocover_mp4',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( $wp_customize, 'videocover_mp4',
				array(
					'label' => 'Video (MP4)',
					'section' => 'videocover_section',
					'settings' => 'videocover_mp4'
				)
			)
		);

		$wp_customize->add_setting( 'videocover_webm',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Upload_Control( $wp_customize, 'videocover_webm',
				array(
					'label' => 'Video (WebM)',
					'section' => 'videocover_section',
					'settings' => 'videocover_webm'
				)
			)
		);
		

		/*
		 * BLOG HEADER SECTION
		 */
		$wp_customize->add_section( 'blogheader_section',
			array(
				'title' => 'Blog Header',
				'description' => 'This section contains blog header options.',
				'priority' => 21,
			)
		);

		$wp_customize->add_setting( 'blogheader_hide_navigation',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogheader_hide_navigation',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Navigation',
				'section' => 'blogheader_section',
			)
		);	

		$wp_customize->add_setting( 'blogheader_hide_search',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogheader_hide_search',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Search Option',
				'section' => 'blogheader_section',
			)
		);	

		$wp_customize->add_setting( 'blogheader_hide_drawer',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'blogheader_hide_drawer',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Drawer Option',
				'section' => 'blogheader_section',
			)
		);

		$wp_customize->add_setting( 'blogheader_logo_light',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogheader_logo_light',
				array(
					'label' => 'Blog Header Light Logo',
					'section' => 'blogheader_section',
					'settings' => 'blogheader_logo_light'
				)
			)
		);

		$wp_customize->add_setting( 'blogheader_logo_light_retina',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogheader_logo_light_retina',
				array(
					'label' => 'Blog Header Light Logo (Retina - @2x file name)',
					'section' => 'blogheader_section',
					'settings' => 'blogheader_logo_light_retina'
				)
			)
		);

		$wp_customize->add_setting( 'blogheader_logo_dark',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogheader_logo_dark',
				array(
					'label' => 'Blog Header Dark Logo',
					'section' => 'blogheader_section',
					'settings' => 'blogheader_logo_dark'
				)
			)
		);

		$wp_customize->add_setting( 'blogheader_logo_dark_retina',
		array(
			'sanitize_callback' => 'ecko_sanatize_file_upload'
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'blogheader_logo_dark_retina',
				array(
					'label' => 'Blog Header Dark Logo (Retina - @2x file name)',
					'section' => 'blogheader_section',
					'settings' => 'blogheader_logo_dark_retina'
				)
			)
		);


		/*
		 * DRAWER SECTION
		 */
		$wp_customize->add_section( 'drawer_section',
			array(
				'title' => 'Drawer',
				'description' => 'This section contains drawer options.',
				'priority' => 22,
			)
		);

		$wp_customize->add_setting( 'drawer_hide_copyright',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'drawer_hide_copyright',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Copyright',
				'section' => 'drawer_section',
			)
		);	


		/*
		 * POST LIST SECTION
		 */
		$wp_customize->add_section( 'postlist_section',
			array(
				'title' => 'Post List',
				'description' => 'This section contains post list options.',
				'priority' => 23,
			)
		);

		$wp_customize->add_setting( 'postlist_hide_authorinfo',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_authorinfo',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Author Info',
				'section' => 'postlist_section',
			)
		);	

		$wp_customize->add_setting( 'postlist_hide_dateinfo',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_dateinfo',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Date Info',
				'section' => 'postlist_section',
			)
		);	

		$wp_customize->add_setting( 'postlist_hide_metainfo',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_metainfo',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Meta Info',
				'section' => 'postlist_section',
			)
		);	

		$wp_customize->add_setting( 'postlist_hide_excerpt',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_excerpt',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Excerpt',
				'section' => 'postlist_section',
			)
		);	

		$wp_customize->add_setting( 'postlist_hide_category',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_category',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Category',
				'section' => 'postlist_section',
			)
		);

		$wp_customize->add_setting( 'postlist_hide_readtime',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_readtime',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Read Time',
				'section' => 'postlist_section',
			)
		);

		$wp_customize->add_setting( 'postlist_hide_pagiantion_numbers',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postlist_hide_pagiantion_numbers',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Pagination Numbers',
				'section' => 'postlist_section',
			)
		);


		/*
		 * POST PAGE SECTION
		 */
		$wp_customize->add_section( 'postpage_section',
			array(
				'title' => 'Post Page',
				'description' => 'This section contains post page options.',
				'priority' => 24,
			)
		);

		$wp_customize->add_setting( 'postpage_hide_subtitle',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_subtitle',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Subtitle',
				'section' => 'postpage_section',
			)
		);

		$wp_customize->add_setting( 'postpage_hide_social_share',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_social_share',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Social Share',
				'section' => 'postpage_section',
			)
		);	

		$wp_customize->add_setting( 'postpage_hide_tags',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_tags',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Tags',
				'section' => 'postpage_section',
			)
		);	

		$wp_customize->add_setting( 'postpage_hide_permalink',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_permalink',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Permalink',
				'section' => 'postpage_section',
			)
		);	

		$wp_customize->add_setting( 'postpage_hide_category',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_category',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Category',
				'section' => 'postpage_section',
			)
		);	

		$wp_customize->add_setting( 'postpage_hide_author_profile',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_author_profile',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Author Profile',
				'section' => 'postpage_section',
			)
		);	

		$wp_customize->add_setting( 'postpage_hide_comments',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'postpage_hide_comments',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Comments',
				'section' => 'postpage_section',
			)
		);


		/*
		 * CUSTOM PAGE SECTION
		 */
		$wp_customize->add_section( 'custompage_section',
			array(
				'title' => 'Custom Page',
				'description' => 'This section contains custom page options.',
				'priority' => 25,
			)
		);

		$wp_customize->add_setting( 'custompage_hide_subtitle',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_subtitle',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Subtitle',
				'section' => 'custompage_section',
			)
		);

		$wp_customize->add_setting( 'custompage_hide_social_share',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_social_share',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Social Share',
				'section' => 'custompage_section',
			)
		);	

		$wp_customize->add_setting( 'custompage_hide_tags',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_tags',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Tags',
				'section' => 'custompage_section',
			)
		);	

		$wp_customize->add_setting( 'custompage_hide_permalink',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_permalink',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Permalink',
				'section' => 'custompage_section',
			)
		);	

		$wp_customize->add_setting( 'custompage_hide_category',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_category',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Category',
				'section' => 'custompage_section',
			)
		);	

		$wp_customize->add_setting( 'custompage_hide_author_profile',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_author_profile',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Author Profile',
				'section' => 'custompage_section',
			)
		);	

		$wp_customize->add_setting( 'custompage_hide_comments',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'custompage_hide_comments',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Comments',
				'section' => 'custompage_section',
			)
		);


		/*
		 * FOOTER MAIN SECTION
		 */
		$wp_customize->add_section( 'footermain_section',
			array(
				'title' => 'Footer - Main',
				'description' => 'This section contains main footer options.',
				'priority' => 26,
			)
		);

		$wp_customize->add_setting( 'footermain_show_post_Pages',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footermain_show_post_Pages',
			array(
				'type' => 'checkbox',
				'label' => 'Show on Post Page',
				'section' => 'footermain_section',
			)
		);	

		$wp_customize->add_setting( 'footermain_hide_footer',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footermain_hide_footer',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Footer',
				'section' => 'footermain_section',
			)
		);	

		$wp_customize->add_setting( 'footermain_hide_copyright',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footermain_hide_copyright',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Copyright',
				'section' => 'footermain_section',
			)
		);	

		$wp_customize->add_setting( 'footermain_hide_social',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footermain_hide_social',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Social',
				'section' => 'footermain_section',
			)
		);	


		/*
		 * FOOTER POST SECTION
		 */
		$wp_customize->add_section( 'footerpost_section',
			array(
				'title' => 'Footer - Post (Fixed)',
				'description' => 'This section contains post footer options.',
				'priority' => 27,
			)
		);

		$wp_customize->add_setting( 'footerpost_hide_footer',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footerpost_hide_footer',
			array(
				'type' => 'checkbox',
				'label' => 'Hide (Fixed) Footer',
				'section' => 'footerpost_section',
			)
		);	

		$wp_customize->add_setting( 'footerpost_hide_author',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footerpost_hide_author',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Author Info',
				'section' => 'footerpost_section',
			)
		);	

		$wp_customize->add_setting( 'footerpost_hide_date',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footerpost_hide_date',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Post Date',
				'section' => 'footerpost_section',
			)
		);

		$wp_customize->add_setting( 'footerpost_hide_comments',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footerpost_hide_comments',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Comments Button',
				'section' => 'footerpost_section',
			)
		);

		$wp_customize->add_setting( 'footerpost_hide_share',
		array(
			'sanitize_callback' => 'ecko_sanitize_checkbox'
		));
		$wp_customize->add_control( 'footerpost_hide_share',
			array(
				'type' => 'checkbox',
				'label' => 'Hide Share Button',
				'section' => 'footerpost_section',
			)
		);


		/*
		 * COLORS
		 */
		$wp_customize->add_setting('color_cover_background',
			array(
				'default' => '#101010',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_cover_background',
				array(
					'label'      => 'Blog Cover Background',
					'section'    => 'colors',
					'settings'   => 'color_cover_background'
				)
			)
		);

	}
	add_action( 'customize_register', 'cedar_customize_register' );


	function cedar_customize_css(){
		?>
			<style type="text/css">

				<?php // LAYOUT ?>
				<?php if(get_theme_mod('layout_width')){ ?>
					.wrapper{ max-width:<?php echo esc_attr(get_theme_mod('layout_width')); ?>px !important; }
				<?php } ?>

				<?php // BLOGCOVER ?>
				<?php if(get_theme_mod('blogcover_height')){ ?>
					body.home .cover{ height: <?php echo esc_attr(get_theme_mod('blogcover_height')); ?>vh; }
				<?php } ?>
				<?php if(get_theme_mod('blogcover_opacity')){ ?>
					body.home .cover .background{ opacity: <?php echo esc_attr(get_theme_mod('blogcover_opacity')) / 100; ?>; }
				<?php } ?>
				<?php if(get_theme_mod('blogcover_center')){ ?>
					body.home .cover .blogtitle{ text-align:center; }
					body.home .cover hr{ margin:0 auto; }
				<?php } ?>
				<?php if(get_theme_mod('blogcover_hide_scroll_icon')){ ?>
					body.home .cover .mouse { visibility: hidden !important; }
				<?php } ?>
				<?php if(get_theme_mod('blogcover_use_pattern_overlay')){ ?>
					body.home .cover.front .patternbg{ display:block; }
				<?php } ?>

				<?php // BLOGHEADER ?>
				<?php if(get_theme_mod('blogheader_hide_navigation')){ ?>
					nav.main div{ display:none; }
					nav.main ul .option:first-child:before{ content:''; } 
				<?php } ?>
				<?php if(get_theme_mod('blogheader_hide_search')){ ?>
					nav.main ul li.searchnav{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('blogheader_hide_drawer')){ ?>
					nav.main ul li.drawernav{ display:none; }
				<?php } ?>

				<?php // DRAWER ?>
				<?php if(get_theme_mod('drawer_hide_copyright')){ ?>
					.drawer .copyright{ display:none; }
				<?php } ?>

				<?php // POSTLIST ?>
				<?php if(get_theme_mod('postlist_hide_authorinfo')){ ?>
					.postlist article .author{ display:none; }
					.postlist article .excerpt{ margin-bottom:0; }
				<?php } ?>
				<?php if(get_theme_mod('postlist_hide_dateinfo')){ ?>
					.postlist article .meta .date{ display:none; }
					.postitem .meta .readtime:before{ content:''; }
				<?php } ?>
				<?php if(get_theme_mod('postlist_hide_metainfo')){ ?>
					.postlist article .meta{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postlist_hide_readtime')){ ?>
					.postlist article .meta .readtime{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postlist_hide_excerpt')){ ?>
					.postlist article .excerpt{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postlist_hide_category')){ ?>
					.postlist article .category{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postlist_hide_pagiantion_numbers')){ ?>
					.pagination .page-numbers{ display:none; }
				<?php } ?>

				<?php // POSTPAGE ?>
				<?php if(get_theme_mod('postpage_hide_subtitle')){ ?>
					body.single .posttitle .excerpt{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postpage_hide_social_share')){ ?>
					body.single .postbottom .shareoptions .sharebuttons{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postpage_hide_tags')){ ?>
					body.single .postbottom .info .tags{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postpage_hide_permalink')){ ?>
					body.single .postbottom .shareoptions .permalink{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postpage_hide_category')){ ?>
					body.single .info .category{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postpage_hide_author_profile')){ ?>
					body.single .widget.authorprofile{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('postpage_hide_comments')){ ?>
					body.single .comments{ display:none; }
				<?php } ?>

				<?php // CUSTOM PAGE ?>
				<?php if(get_theme_mod('custompage_hide_subtitle')){ ?>
					body.page .posttitle .excerpt{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('custompage_hide_social_share')){ ?>
					body.page .postbottom .shareoptions .sharebuttons{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('custompage_hide_tags')){ ?>
					body.page .postbottom .info .tags{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('custompage_hide_permalink')){ ?>
					body.page .postbottom .shareoptions .permalink{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('custompage_hide_category')){ ?>
					body.page .info .category{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('custompage_hide_author_profile')){ ?>
					body.page .widget.authorprofile{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('custompage_hide_comments')){ ?>
					body.page .comments{ display:none; }
				<?php } ?>

				<?php // FOOTER MAIN ?>
				<?php if(get_theme_mod('footermain_show_post_Pages')){ ?>
					body.single .pagewrapper{ padding-bottom:0; }
					footer.main{ padding-bottom:100px; }
				<?php } ?>		
				<?php if(get_theme_mod('footermain_hide_footer')){ ?>
					footer.main{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('footermain_hide_copyright')){ ?>
					footer.main .copyright{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('footermain_hide_social')){ ?>
					footer.main .social{ display:none; }
				<?php } ?>

				<?php // FOOTER POST ?>
				<?php if(get_theme_mod('footerpost_hide_footer')){ ?>
					footer.postinfo{ display:none !important; }
					body.single .pagewrapper { padding-bottom: 0; }
				<?php } ?>
				<?php if(get_theme_mod('footerpost_hide_author')){ ?>
					footer.postinfo .authorinfo .authorname{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('footerpost_hide_date')){ ?>
					footer.postinfo .authordate{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('footerpost_hide_comments')){ ?>
					footer.postinfo .postoptions .showcomments{ display:none; }
				<?php } ?>
				<?php if(get_theme_mod('footerpost_hide_share')){ ?>
					footer.postinfo .postoptions .showsocial{ display:none; }
				<?php } ?>

				<?php // COPYRIGHT ?>
				<?php if(get_theme_mod('copyright_hide_disclaimer')){ ?>
					.copyright{ display:none !important; }
				<?php } ?>
				<?php if(get_theme_mod('copyright_hide_wordpress')){ ?>
					.copyright .wordpress{ display:none !important; }
				<?php } ?>
				<?php if(get_theme_mod('copyright_hide_ecko')){ ?>
					.copyright .ecko{ display:none !important; }
				<?php } ?>

				<?php // COLORS ?>
				<?php if(get_theme_mod('color_enable_custom')){ ?>
					.posttitle h1 { color: <?php echo esc_attr(get_theme_mod('color_accent')); ?>}
					.postitem h2 a:hover { color: <?php echo esc_attr(get_theme_mod('color_accent_dark')); ?>}
					.postitem h2 a { color: <?php echo esc_attr(get_theme_mod('color_accent')); ?>}
					body.home .cover{ background: <?php echo esc_attr(get_theme_mod('color_cover_background')); ?> }
				<?php } ?>

			 </style>
		<?php
	}
	add_action( 'wp_head', 'cedar_customize_css');