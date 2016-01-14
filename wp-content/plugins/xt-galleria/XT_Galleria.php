<?php

/**
 * The XT_Galleria WordPress Plugin class
 */
class XT_Galleria {

	protected $url;
	protected $theme;
	protected $version = '1.0.3';
	protected $galleriaVersion = '1.4.2';
	protected $textDomain = 'xt_galleria';
	protected $optionsName = 'xt_galleria_theme';
	public static $defaultTheme = 'native';
	public static $availableThemes = array(
		'classic' => 'Classic Slider',
		'advanced' => 'Advanced Slider',
		'native' => 'Native Wordpress Gallery'	
	);
	
	/**
	 * Constructor
	 *
	 * @param string $pluginUrl The full URL to this plugin's directory.
	 */
	public function __construct($pluginUrl) {
		$this->url   = $pluginUrl;
		$this->theme = get_option($this->optionsName, self::getDefaultTheme());
		$this->initialize();
	}

	/**
	 * Initializes this plugin
	 */
	public function initialize() {

		if (function_exists('vc_map')) {
			add_action('init', array(&$this, 'registerVcWidget'));
		}
		
		
		// replace the default [gallery] shortcode functionality
		add_shortcode('gallery', array(&$this, 'galleryShortcode'));

		// admin options page
		add_action('admin_menu', array(&$this, 'addOptionsPage'));
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		
	}

	public function enqueue_scripts() {
		
		// determine the theme and version for the files to load
		$galleria_js = sprintf("%s/galleria/galleria-%s.min.js", $this->url, $this->galleriaVersion);

		// add required scripts and styles to head
		wp_enqueue_script('jquery');
		wp_register_script('xt-galleria', $galleria_js, 'jquery', $this->galleriaVersion);
		wp_enqueue_script('xt-galleria');
		
		// Vendors
		wp_register_script( 'prettyphoto', sprintf("%s/vendors/prettyphoto/js/jquery.prettyPhoto.js", $this->url), 'jquery');
		wp_register_style( 'prettyphoto', sprintf("%s/vendors/prettyphoto/css/prettyPhoto.css", $this->url), '');

	}
	
	public function registerVcWidget() {
	
		$native_dependency =  array(
	        "element" => "theme",
	        "value" => array('native')
	    );
		$galleria_dependency =  array(
	        "element" => "theme",
	        "value" => array_diff(array_keys(self::getThemes()), array('native'))
	    );
			
		/* Gallery/Slideshow
		---------------------------------------------------------- */
		vc_map( array(
			'name' => __( 'Image Gallery', $this->textDomain ),
			'base' => 'gallery',
			"class" => "",
            "icon" => "xt_vc_icon_gallery",
            "category" => _x('XplodedThemes Widgets', 'VC', $this->textDomain),
			'description' => __( 'Responsive image gallery slider', $this->textDomain ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Widget title', $this->textDomain ),
                    'holder' => "div",
					'class' => 'xt_vc_title',
					'param_name' => 'title',
					'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', $this->textDomain )
				),
				array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => _x("Theme", 'VC', $this->textDomain),
                    "param_name" => "theme",
                    "value" => array_flip(self::getThemes()),
                    "description" => ''
                ),				
				array(
					'type' => 'attach_images',
					'heading' => __( 'Images', $this->textDomain ),
					'holder' => "div",
					'class' => 'xt_vc_images',  
					'param_name' => 'ids',
					'value' => '',
					'description' => __( 'Select images from media library.', $this->textDomain )
				),	
				array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => _x("Columns", 'VC', $this->textDomain),
                    "param_name" => "columns",
                    "value" => array(1,2,3,4,5,6,7,8,9),
                    "description" => '',
                    "dependency" => $native_dependency
                ),	
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => _x("Thumb Size", 'VC', $this->textDomain),
                    "param_name" => "size",
                    "value" => get_intermediate_image_sizes(),
                    "description" => '',
                    "dependency" => $native_dependency
                ),	
                array(
					'type' => 'textfield',
					'heading' => __( 'Max Height', $this->textDomain ),
					'holder' => "div",
					'param_name' => 'height',
					'description' => __( 'Max Image Height in Pixels. Leave empty for automatic height detection', $this->textDomain ),
				),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => _x("Link", 'VC', $this->textDomain),
                    "param_name" => "link",
                    "value" => array(
                    	__('No Link', $this->textDomain) => 'none',
                    	__('Link to attachment page', $this->textDomain) => 'file',
                    	__('Link to custom url', $this->textDomain) => 'link',
                    	__('Open in lightbox', $this->textDomain) => 'lightbox',
                    ),
                    "description" => '',
                    "dependency" => $native_dependency
                ),	
				array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => _x("Transition", 'VC', $this->textDomain),
                    "param_name" => "transition",
                    "value" => array(
                    	__('Fade', $this->textDomain) => 'fade',
                    	__('Flash', $this->textDomain) => 'flash',
                    	__('Pulse', $this->textDomain) => 'pulse',
                    	__('Slide', $this->textDomain) => 'slide',
                    	__('Fade / Slide', $this->textDomain) => 'fadeslide',
                    ),
                    "description" => '',
                    "dependency" => $galleria_dependency
                ),
                array(
					'type' => 'textfield',
					'heading' => __( 'Transition Speed', $this->textDomain ),
					'holder' => "div",
					'param_name' => 'transition_speed',
					'description' => __( 'The milliseconds used in the animation when applying the transition. The higher number, the slower transition.', $this->textDomain ),
					"value" => 400,
					"dependency" => $galleria_dependency
				),
				array(
                    'type' => 'checkbox',                                                     
                    'heading' => __('AutoPlay?', $this->textDomain),
					'holder' => "div",
                    'param_name' => 'autoplay',
                    'value' => array(
                        __('Yes', $this->textDomain) => 'AutoPlay'
                    ),
					"dependency" => $galleria_dependency
                ),	                
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', $this->textDomain ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', $this->textDomain )
				)
			)
		));

		
	}
	
	
	/**
	 * Displays a Galleria slideshow using images attached to the specified post/page.
	 * Overrides the default functionality of the [gallery] Shortcode.
	 *
	 * @param array $attr Attributes of the shortcode.
	 * @return string HTML content to display gallery.
	 */
	public function galleryShortcode($attr) {

		global $post, $content_width;

		// global content width set for this theme? (see theme functions.php)
		if (!isset($content_width)) $content_width = 'auto';

		// make sure each slideshow that is rendered for the current request has a unique ID
		static $instance = 0;
		$instance++;

		// yield to other plugins/themes attempting to override the default gallery shortcode
		$output = apply_filters('post_gallery', '', $attr);
		if ($output != '') {
			return $output;
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if (isset($attr['orderby'])) {
			$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
			if (!$attr['orderby']) {
				unset($attr['orderby']);
			}
		}

		// 3:2 display ratio of the stage, account for 60px thumbnail strip at the bottom
		$width  = 'auto';
		$height = '0.76'; // a fraction of the width


		// extract the shortcode attributes into the current variable space
		extract(shortcode_atts(array(
			// Custom Options
			
			'title' => '',  
    	  	'el_class' => '',
    	  	
			// standard WP [gallery] shortcode options
			'order'        => 'ASC',
			'orderby'      => 'menu_order ID',
			'id'           => $post->ID,
			'itemtag'      => 'dl',
			'icontag'      => 'dt',
			'captiontag'   => 'dd',
			'columns'      => 3,
			'size'         => 'large',
			'include'      => '',
			'exclude'      => '',
			'ids'          => '',
			'link' 		   => 'file',
			'titles' 	   => '',
			
			// galleria options
			'width'        		=> $width,
			'height'       		=> $height,
			'transition'   		=> 'fade',
			'transition_speed'  => 400,
			'autoplay'     		=> false,
			'theme' 	   		=> self::getDefaultTheme()

		), $attr));

		$lightbox = false;
		if($link == "lightbox") {
			wp_enqueue_script( 'prettyphoto' );
			wp_enqueue_style( 'prettyphoto' );
			$link = "file";
			$lightbox = true;
		}
		
		if($theme == 'native' && function_exists('gallery_shortcode')) {
						
			$output .= "<div id=\"xt-gallery-".esc_attr($instance)."\" class=\"widget xt_gallery native ".($lightbox ? "prettyPhoto" : "")."\">\n";

			if ( ! empty( $title ) ) {
				$output .= '<span class="heading-t3"></span>';
				$output .= '<h3 class="widgettitle">'.$title.'</h3>';
				$output .= '<span class="heading-b3"></span>';
			}	
		
			$output .= gallery_shortcode($attr);

			
			if($lightbox) {
				$output .= '
				<script type="text/javascript">
				jQuery(document).ready(function($){
						
					var gallery = "#xt-gallery-'.esc_js($instance).'.prettyPhoto";
						
					$(gallery).find("a").each(function() {
					
						var image_url = $(this).attr("href");
						console.log(image_url);
						var suffix = "";
						if(image_url.search(/\?/i) == -1) {
							suffix = "?format=raw&ext=jpg";
						}else{
							suffix = "&format=raw&ext=jpg";
						}
						$(this).attr("href", image_url + suffix);
						$(this).attr("rel", "prettyPhoto[xt-gallery-'.esc_js($instance).']");
						
					});
					
					setTimeout(function() {
						
						$(gallery).find("a[rel^=\'prettyPhoto[xt-gallery-'.esc_js($instance).']\']").prettyPhoto();
						
					},100);	
				});
				</script>
				';
			}	
			
			$output .= '
			<script type="text/javascript">
			jQuery(document).ready(function($){
			
				var gallery = "#xt-gallery-'.esc_js($instance).'.native";
				$(gallery).find(".gallery-icon img").each(function() {
					var thumb_url = $(this).attr("src");
					var thumb_alt= $(this).attr("alt");
					var thumb_wrap = $(this).parent();
					var gallery_item = thumb_wrap.closest(".gallery-item");
					thumb_wrap.addClass("gallery-thumb-bg");
					thumb_wrap.css({
						"background-image": "url("+thumb_url+")",
						"height": "'.esc_js($height).'px"
					});
					thumb_wrap.attr("title", thumb_alt);
					$(this).hide();
				});	
				
				setTimeout(function() {
					$(gallery).animate({"opacity": 1}, 300);
				},500);	

			});
			</script>
			';
			
			$output .= "</div>\n";
			return $output;
		}

		// the id of the current post, or a different post if specified in the shortcode
		$id = intval($id);

		// random MySQL ordering doesn't need two attributes
		if ($order == 'RAND') {
			$orderby = 'none';
		}

		// use the given IDs of images
		if (!empty($ids)) {
			$include = $ids;
		}

		// fetch the images
		if (!empty($include)) {
			// include only the given image IDs 
			$include = preg_replace('/[^0-9,]+/', '', $include);
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ($_attachments as $key => $val) {
				$attachments[$val->ID] = $_attachments[$key];
			}
			if (!empty($ids)) {
				$sortedAttachments = array();
				$ids = preg_replace('/[^0-9,]+/', '', $ids);
				$idsArray = explode(',', $ids);
				foreach ($idsArray as $aid) {
					if (array_key_exists($aid, $attachments)) {
						$sortedAttachments[$aid] = $attachments[$aid];
					}
				}
				$attachments = $sortedAttachments;
			}
		} elseif (!empty($exclude)) {
			// exclude certain image IDs
			$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			// default: all images attached to this post/page
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		// output nothing if we didn't find any images
		if (empty($attachments)) {
			return '';
		}
	
		// output the individual images when displaying as a news feed
		if (is_feed()) {
			$output = "\n";
			foreach ($attachments as $attachmentId => $attachment) {
				//$output .= wp_get_attachment_link($attachmentId, $size, true) . "\n";
				list($src, $w, $attachment) = wp_get_attachment_image_src($attachmentId, 'medium');
				$output .= '<img src="'.$src.'" width="'.$w.'" height="'.$h.'">' . "\n";
			}
			return $output;
		}

		/***************/
		// xt-galleria
		/***************/

		if(!empty($titles)) {
			$titles = explode("\r\n", $titles);	
		}
		
		// make an array of images with the proper data for Galleria
		$images = array();
		$i = 0;
		foreach ($attachments as $attachmentId => $attachment) {
			$thumb = wp_get_attachment_image_src($attachmentId, 'thumbnail');
			$big   = wp_get_attachment_image_src($attachmentId, 'large');
			$image = array(
				'image'       => $big[0],
				'big'         => $big[0],
				'thumb'       => $thumb[0],
				'title'       => !empty($titles[$i]) ? $titles[$i] : $attachment->post_title,
				//'link'        => $attachment->guid,
				'description' => wptexturize($attachment->post_excerpt),
			);
			$images[] = $image;
			$i++;
		}

		// encode the Galleria options as JSON
		$options = json_encode(array(
			'theme' 			=> $theme,
			'dataSource'        =>  $images,
			'width'             => 	(is_numeric($width)) ? (int) $width  : (string) $width,
			'height'            => 	(is_int($height))    ? (int) $height : (float)  $height,
			'autoplay'          => 	!empty($autoplay),
			'transition'        =>  $transition,
			'initialTransition' =>  $transition,
			'fullscreenTransition' => $transition,
			'transitionSpeed'   => 	$transition_speed
		));

		
		// unique ID for this slideshow
		$domId = "xt_galleria_slideshow_" . $instance;
		
        $output .= "<div id=\"xt-gallery-".$instance."\" class=\"widget xt_gallery\">\n";

		if ( ! empty( $title ) ) {
			$output .= '<span class="heading-t3"></span>';
			$output .= '<h3 class="widgettitle">'.$title.'</h3>';
			$output .= '<span class="heading-b3"></span>';
		}	

		$output .= "	<div id=\"" . $domId . "\" class=\"xt-galleria-slideshow\"></div>\n";

		$galleria_js = sprintf("%s/galleria/galleria-%s.min.js", $this->url, $this->galleriaVersion);
		
		$theme_js    = sprintf("%s/galleria/themes/%s/galleria.%s.js",  $this->url, $theme, $theme);
		$theme_css   = sprintf("%s/galleria/themes/%s/galleria.%s.css", $this->url, $theme, $theme);
		
		
		
		wp_register_script('xt-galleria', $galleria_js, 'jquery', $this->galleriaVersion);
		wp_enqueue_script('xt-galleria');
		
		wp_enqueue_script('xt-galleria-'.$theme.'-js', 	$theme_js,   'xt-galleria', $this->version);
		wp_enqueue_style( 'xt-galleria-'.$theme.'-css', $theme_css,   array(), 		$this->version);		
		
		$output .= '
		<script type="text/javascript">
			jQuery(document).ready(function(){ 
			
				Galleria.run("#' . $domId .'", ' . $options . ');
			
			});
		</script>';

		$output .= "</div>\n";
		
		return $output;

	}

	/**
	 * Adds the callback for the admin options page.
	 * @return void
	 */
	public function addOptionsPage() {
		add_options_page('Galleria', 'Galleria', 'manage_options', 'xt-galleria', array(&$this, 'showOptionsPage'));
	}

	/**
	 * Displays the admin settings page.
	 * If a POST request, saves the submitted plugin options.
	 * @return void
	 */
	public function showOptionsPage() {

		if (!current_user_can('manage_options'))  {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		if (isset($_POST[$this->optionsName])) {
			update_option($this->optionsName, $_POST[$this->optionsName]);
			echo '<div id="message" class="updated fade"><p><strong>Options saved.</strong></p></div>';
		}

		$theme = get_option($this->optionsName, self::getDefaultTheme());

		?>
		<div class="wrap">
			<h2>Galleria Settings</h2>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<table class="form-table">
					<tbody>
						<tr valign="top">
							<th scope="row">
								<label for="xt-theme-select">Theme</label>
							</th>
							<td>
								<select id="xt-theme-select" name="<?php echo $this->optionsName; ?>">
									<?php foreach (self::getThemes() as $k=>$v): ?>
									<option value="<?php echo $k; ?>"<?php if($theme==$k){ echo ' selected="selected"'; } ?>><?php echo $v; ?></option>
									<?php endforeach; ?>
								</select>
							</td>
					</tbody>
				</table>
				<p class="submit"><input type="submit" value="Save Changes" class="button button-primary"></p>
			</form>
		</div>
		<?php

	}
	
	public static function getThemes() {
	
		return self::$availableThemes;
	}
	public static function getDefaultTheme() {
	
		return self::$defaultTheme;
	}
}