<?php

/**
 * Advanced News Widget Class
 *
 * @since 1.0
 * @see   XT_Widget_Advanced_News
 * @todo  - Add advanced options
 */

class XT_Widget_Advanced_News extends XT_Advanced_Widget
{
	/**
	 * Widget Defaults
	 */

	protected $id = 'xt_news';
	protected $class = 'widget xt_news';
	protected $query;
	protected $instance;
	protected $count = 0;
	
	
    function shortcode( $atts ) {
   
		$atts = shortcode_atts( array(
    	  'title' => '',
    	  'number' => '',
    	  'query_type' => '',
    	  //'custom_query' => '',
    	  'must_have_comments' => '',
    	  'selection' => '',
    	  'include_posts' => '',
    	  'category' => '',
    	  'exclude_category' => '',
    	  'query_post_formats' => '',
    	  'format' => '',
    	  'view' => '',
    	  'slider_height' => '',
    	  'bordered' => '',
    	  'thumbnails_filter' => '',
    	  'embed_video' => '',
    	  'title_length' => '',
    	  'featured_title_length' => '',
    	  'show_excerpt' => '',
    	  'show_excerpt_only_featured' => 'yes',
    	  'excerpt_length' => '25',
    	  'featured_excerpt_length' => '55',
    	  'show_date' => '',
    	  'show_date_only_featured' => 'yes',  
    	  'show_author' => '',
    	  'show_author_only_featured' => 'yes',  
    	  'show_stats' => '',
    	  'show_stats_only_featured' => 'no',  
    	  'show_category' => '', 
    	  'show_category_only_featured' => 'no',     	
    	  'max_categories' => '',   
    	  'action_title' => '',
    	  'action_obj_id' => '',
    	  'action_ext_link' => '',
    	  'css_animation' => '',
    	), $atts );
  
    	$this->setInstance($atts);
    	

    	$output = $this->getCache();
    	$this->count++;
    	
    	if(!empty($output)) {
	    	return $output;
    	}

    	extract( $atts );
        
        ob_start();       	
        ?>
        <div class="vc_<?php echo esc_attr($this->class);?>  wpb_content_element">
        <div id="<?php echo esc_attr($this->instance_id); ?>" class="<?php echo esc_attr($this->class);?> <?php echo esc_attr($css_animation); ?>">
            <?php $this->widgetStart(); ?>
            <?php $this->widget(); ?>
            <?php $this->widgetEnd(); ?>
        </div>
        </div>
        <?php
        
        $output = ob_get_contents();
        ob_end_clean();

		$this->setCache($output);
        return $output;
    }
    
	public static function getLayouts() {
		
		return array(
			'grid-1' => __('Classic', XT_TEXT_DOMAIN),
			'list-small' => __('List - Small Thumbs', XT_TEXT_DOMAIN),
			'list' => __('List - Large Thumbs', XT_TEXT_DOMAIN),
			'grid-2' => __('Grid 2 - Columns', XT_TEXT_DOMAIN),
			'grid-3' => __('Grid 3 - Columns', XT_TEXT_DOMAIN),
			'grid-4' => __('Grid 4 - Columns', XT_TEXT_DOMAIN),
			'grid-5' => __('Grid 5 - Columns', XT_TEXT_DOMAIN)
		);
						
	}

	public static function getVcLayouts() {
		
		return array(
            _x("Classic", 'VC', XT_TEXT_DOMAIN) => 'grid|col:1',
            _x("List / Small Thumbs", 'VC', XT_TEXT_DOMAIN) => 'list|thumb:small',
            _x("List / Medium Thumbs", 'VC', XT_TEXT_DOMAIN) => 'list|thumb:medium',
            _x("List / Large Thumbs", 'VC', XT_TEXT_DOMAIN) => 'list|thumb:large',
            _x("Grid / 2 Columns", 'VC', XT_TEXT_DOMAIN) => 'grid|col:2',
            _x("Grid / 3 Columns", 'VC', XT_TEXT_DOMAIN) => 'grid|col:3',
            _x("Grid / 4 Columns", 'VC', XT_TEXT_DOMAIN) => 'grid|col:4',
            _x("Grid / 5 Columns", 'VC', XT_TEXT_DOMAIN) => 'grid|col:5',           
            _x("Featured Post + List / 1 Column", 'VC', XT_TEXT_DOMAIN) => 'featured|col:1',
            _x("Featured Post + List / 2 Columns - Style 1", 'VC', XT_TEXT_DOMAIN) => 'featured|col:2,style:1',
            _x("Featured Post + List / 2 Columns - Style 2", 'VC', XT_TEXT_DOMAIN) => 'featured|col:2,style:2',
            _x("Ranking List", 'VC', XT_TEXT_DOMAIN) => 'ranking',
            _x("Stack View", 'VC', XT_TEXT_DOMAIN) => 'stack',
            _x("Orbit Slider", 'VC', XT_TEXT_DOMAIN) => 'orbit'
        );
						
	}
	
	function vcMap() {

        vc_map(array(
            "name" => _x("News", 'VC', XT_TEXT_DOMAIN),
            "base" => "xt_news",
            "class" => "",
            "icon" => "xt_vc_icon_news",
            "category" => _x(XT_VC_GROUP, 'VC', XT_TEXT_DOMAIN),
	        "description" => _x("Advanced Multi layout news widget", 'VC', XT_TEXT_DOMAIN),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Title", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "title",
                    "value" => "",
                    "description" => '',
                    "group" => _x("General", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Call To Action Title", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "action_title",
                    "value" => '',
                    "description" => '',
                    "group" => _x("General", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "post_select",
                    "post_type" => "page",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Call To Action Page", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "action_obj_id",
                    "value" => '',
                    "description" => '',
                    "group" => _x("General", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Call To Action External Link", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "action_ext_link",
                    "value" => '',
                    "description" => '',
                    "group" => _x("General", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("CSS Animation", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "css_animation",
                    "value" => xt_get_css_animations(),
                    "description" => '',
                    "group" => _x("General", 'VC', XT_TEXT_DOMAIN)
                ),

                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Query Type", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "query_type",
                    "value" => array(
                        _x("Most Recent", 'VC', XT_TEXT_DOMAIN) => 'most-recent',
                        _x("Most Viewed", 'VC', XT_TEXT_DOMAIN) => 'most-viewed',
                        _x("Most Liked", 'VC', XT_TEXT_DOMAIN) => 'most-liked',
                        _x("Most Discussed", 'VC', XT_TEXT_DOMAIN) => 'most-discussed',
                        _x("Manual Selection", 'VC', XT_TEXT_DOMAIN) => 'selection',
                        //_x("Custom Query", 'VC', XT_TEXT_DOMAIN) => 'custom'
                    ),
                    "description" => '',
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),
/*
				array(
				    'type' => 'loop',
				    'heading' => __('Query', XT_TEXT_DOMAIN),
				    'param_name' => 'custom_query',
				    'value' => '',
				    "dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'custom'
                        )
                    ),
				    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
				),   
*/            
                array(
					'type' => 'autocomplete',
                    "heading" => _x("Manually select posts", 'VC', XT_TEXT_DOMAIN),
					'param_name' => 'include_posts',
					'settings' => array(
						'multiple' => true,
						'sortable' => true,
						'groups' => false,
					),
					"dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'selection'
                        )
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
				),
                array(
                    "type" => "taxonomy_multiselect",
                    "taxonomy" => "category",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Filter by one or multiple categories", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "category",
                    "description" => '',
                    "dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'most-recent',
                            'most-viewed',
                            'most-liked',
                            'most-discussed'
                        )
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "taxonomy_multiselect",
                    "taxonomy" => "category",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Exclude one or multiple categories", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "exclude_category",
                    "description" => '',
                    "dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'most-recent',
                            'most-viewed',
                            'most-liked',
                            'most-discussed'
                        )
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __('Query post formats', XT_TEXT_DOMAIN),
                    'param_name' => 'query_post_formats',
                    'value' => array(
                        __('Yes', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'most-recent',
                            'most-viewed',
                            'most-liked',
                            'most-discussed'
                        )
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => _x("Filter By Post Format", 'VC', XT_TEXT_DOMAIN),
					"param_name" => "format",
                    'value' => xt_get_post_formats(true),					
					"dependency" => array(
                        "element" => "query_post_formats",
                        "value" => 'yes',
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
				),  
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Embed Video instead of thumbnail", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "embed_video",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "dependency" => array(
                        "element" => "format",
                        "value" => 'post-format-video',
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),				               
                array(
                    'type' => 'checkbox',
                    'heading' => __('Must have at least 1 comment', XT_TEXT_DOMAIN),
                    'param_name' => 'must_have_comments',
                    'value' => array(
                        __('Yes', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'most-discussed'
                        )
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Number of posts to show", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "number",
                    "value" => '',
                    "description" => '',
                    "dependency" => array(
                        "element" => "query_type",
                        "value" => array(
                            'most-recent',
                            'most-viewed',
                            'most-liked',
                            'most-discussed'
                        )
                    ),
                    "group" => _x("Query", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Bordered Box", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "bordered",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "group" => _x("Design", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Layout", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "view",
                    "value" => $this->getVcLayouts(),
                    "description" => '',
                    "group" => _x("Design", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "panel hidden",
                    "heading" => _x("Slider Height", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "slider_height",
                    "value" => "",
                    "description" => '',
                    "dependency" => array(
                        "element" => "view",
                        "value" => array(
                            'orbit',
                        )
                    ),
                    "group" => _x("Design", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "panel hidden",
                    "heading" => _x("Slider Image Size", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "slider_image_size",
                    "value" => xt_get_custom_image_sizes(true),
                    "description" => '',
                    "dependency" => array(
                        "element" => "view",
                        "value" => array(
                            'orbit',
                        )
                    ),
                    "group" => _x("Design", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Thumbnails Filter", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "thumbnails_filter",
                    "value" => xt_get_css_filters(),
                    "description" => '',
                    "dependency" => array(
                        "element" => "view",
                        "value" => array(
                            'grid|col:1',
                            'grid|col:2',
                            'grid|col:3',
                            'grid|col:4',
                            'grid|col:5',
                            'list|thumb:small',
                            'list|thumb:medium',
                            'list|thumb:large',
                            'featured|col:1',
                            'featured|col:2,style:1',
                            'featured|col:2,style:2',
                        )
                    ),
                    "group" => _x("Design", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Max Title Length (words)", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "title_length",
                    "value" => '10',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Featured Post Max Title Length (words)", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "featured_title_length",
                    "value" => '15',
                    "description" => 'This only applies if the selected view has a featured post',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Excerpt", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_excerpt",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Excerpt only for Featured Post", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_excerpt_only_featured",
                    'value' => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => 'no',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "description" => 'This only applies if the selected view has a featured post',
                    "dependency" => array(
                        "element" => "show_excerpt",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),               
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Excerpt Length (words)", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "excerpt_length",
                    "value" => apply_filters( 'excerpt_length', 30 ),
                    "description" => '',
                    "dependency" => array(
                        "element" => "show_excerpt",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Featured Post Excerpt Length (words)", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "featured_excerpt_length",
                    "value" => apply_filters( 'featured_excerpt_length', 55 ),
                    "description" => 'This only applies if the selected view has a featured post',
                    "dependency" => array(
                        "element" => "show_excerpt",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Category", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_category",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Category only for Featured Post", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_category_only_featured",
                    'value' => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => 'no',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "description" => 'This only applies if the selected view has a featured post',
                    "dependency" => array(
                        "element" => "show_category",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),  
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Max number of categories to show", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "max_categories",
                    "value" => '1',
                    "description" => '',
                    "dependency" => array(
                        "element" => "show_category",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),                  
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Date", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_date",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),              
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Date only for Featured Post", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_date_only_featured",
                    'value' => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => 'no',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "description" => 'This only applies if the selected view has a featured post',
                    "dependency" => array(
                        "element" => "show_date",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),  
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Author", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_author",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Author only for Featured Post", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_author_only_featured",
                    'value' => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => 'no',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "description" => 'This only applies if the selected view has a featured post',
                    "dependency" => array(
                        "element" => "show_author",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),  
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Stats", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_stats",
                    "value" => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => '',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => '1'
                    ),
                    "description" => '',
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => _x("Show Stats only for Featured Post", 'VC', XT_TEXT_DOMAIN),
                    "param_name" => "show_stats_only_featured",
                    'value' => array(
                        _x("No", 'VC', XT_TEXT_DOMAIN) => 'no',
                        _x("Yes", 'VC', XT_TEXT_DOMAIN) => 'yes'
                    ),
                    "description" => 'This only applies if the selected view has a featured post',
                    "dependency" => array(
                        "element" => "show_stats",
                        "value" => array(
                            '1',
                        )
                    ),
                    "group" => _x("Show / Hide", 'VC', XT_TEXT_DOMAIN)
                ), 
            )
            
        ));
        
        
        add_filter('vc_autocomplete_xt_news_include_posts_callback', array($this, 'vc_include_posts_callback'), 10, 3);
        add_filter('vc_autocomplete_xt_news_include_posts_render', array($this, 'vc_include_posts_render'), 10, 1);
        
	}
	
	function vc_include_posts_callback($query, $tag, $param_name) {
		
		$search_query = new WP_Query();
		$search_query->query('post_type=post&s='.$query.'&nopaging=true');
		
		$results = array();
		if(!empty($search_query->posts)) {
			
			foreach($search_query->posts as $post) {
				
				$results[] = array(
					'label' => $post->post_title,
					'value' => $post->ID
				);
			}
		}
		
		return $results;
	}
	
	function vc_include_posts_render( $value ) {
		
		$post = get_post( $value['value'] );
		
		if(is_null($post))
			return false;
		
		return array(
			'label' => $post->post_title,
			'value' => $post->ID
		);
	}
	
	function widget ()
	{
		global $xt_global_where, $wpdb;


		$query_args = array(
			  'post_type'           => 'post'
			, 'posts_per_page'      => $this->instance['number']
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		);

		if(!empty($this->instance['query_type'])) {

            $query_type = $this->instance['query_type'];
            
			if($query_type == 'most-viewed') {
			
				$query_args['meta_key'] = 'xt_post_views_count';
				$query_args['orderby'] = 'meta_value_num';
				$query_args['order'] = 'DESC';
				
			}else if($query_type == 'most-liked') {
			
				$query_args['meta_key'] = '_votes_likes';
				$query_args['orderby'] = 'meta_value_num';
				$query_args['order'] = 'DESC';
				
			}else if($query_type == 'most-discussed') {
			
				$query_args['orderby'] = 'comment_count';
				$query_args['order'] = 'DESC';
				
				if(!empty($this->instance['must_have_comments'])) 
					$xt_global_where = "AND $wpdb->posts.comment_count > 0";
				
			}else if($query_type == 'selection' && !empty($this->instance['include_posts'])) {
			
				$selection = $this->instance['include_posts'];
				if(!is_array($selection)) {
					$selection = explode(",", $selection);
				}
				$query_args["post__in"] = $selection;
				$query_args['orderby'] = 'post__in';
				
				$this->instance['category'] = false;
				$this->instance['number'] = false;
				$this->instance['query_post_formats'] = false;
				$this->instance['format'] = false;
				$query_args["posts_per_page"] = -1;
				
			}else if($query_type == 'custom') {
			
				list( $query_args, $query ) = vc_build_loop_query($this->instance['custom_query'], get_the_ID());
			}
		}

		if($query_type != 'custom') {
			
			if(!empty($this->instance['query_post_formats'])) {
		
				if(!empty($this->instance['format'])) {
				
		            $format = $this->instance['format'];
		            
					if(!is_array($format)) {
						$format = explode(",", $format);
					}
					
					$query_args['tax_query'] = array(
						array(
							'taxonomy' => 'post_format',
							'field' => 'slug',
							'terms' => $format,
							'operator' => 'IN'
						)
					);
			
				} 
			
			}else if($query_type != 'selection') {
				
				$exclude_formats = xt_get_post_formats(true);
	
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $exclude_formats,
						'operator' => 'NOT IN'
					)
				);
					
			}
			
			if(!empty($this->instance['category']) || !empty($this->instance['exclude_category'])) {
	
				$categories = array();
				if(!empty($this->instance['category'])) {
					
		            $category = $this->instance['category'];
		            if(!is_array($category)) {
		            	$category = explode(",", $category);
		            }
		            $categories = array_merge($categories, $category);
	
				}
				
				if(!empty($this->instance['exclude_category'])) {	
				
					$category = $this->instance['exclude_category'];
					
					if(!is_array($category)) {
		            	$category = explode(",", $category);
		            }
		            foreach($category as $key => $cat){
						$category[$key] = -$cat;
					}
					$categories = array_merge($categories, $category);
				}
				
				if(!empty($categories)) {
					
					if(is_array($categories)) {
						$categories = implode(",", $categories);
					}
					$query_args["cat"] = $categories;
				}	
		
			}
		}
		
		if($query_type != 'custom') {
			$query = new WP_Query( apply_filters( 'xt_widget_news_args', $query_args ) );
		}
		
		if ( $query->have_posts() ) :

            $this->query = $query;
             
			$action_title = $this->instance['action_title'];
			$action_obj_id = $this->instance['action_obj_id'];
			$action_ext_link = $this->instance['action_ext_link'];
	
			/***/
	
			$action = $this->actionLink( $action_obj_id, $action_ext_link, $action_title);


			if ( ! empty( $this->instance['title'] ) ) {
				echo '<span class="heading-t3"></span>';
				echo '<h3 class="widgettitle">'.$this->instance['title'].' '.$action.'</h3>';
				echo '<span class="heading-b3"></span>';
			}	

            $this->render();

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	function render() {
    	
        $view = $this->getView();
        $settings = $this->getViewSettings();
 
		if($view == 'grid') {
    		
    		$this->renderNewsGrid();
    		
		}else if($view == 'list') {

            $this->renderNewsList();
    
		}else if($view == 'featured') {
		
		    $this->renderNewsFeaturedList();
		    
		}else if($view == 'ranking') {
		
		    $this->renderNewsRankingList();
		    
		}else if($view == 'stack') {
		
		    $this->renderNewsStack();
		    
		}else if($view == 'orbit') {
		
		    $this->renderNewsOrbitSlider();
		}
			
	}
	
	function renderBegin($attributes = array(), $tag = 'ul') {
	
		$attr_string = '';
		foreach($attributes as $key => $value) {
			$attr_string .= $key.'="'.esc_attr($value).'" ';
		}
    	?>
    	
    	<<?php echo esc_attr($tag); ?> <?php echo $attr_string; ?>>
    	<?php
	}
	
	function renderEnd($tag = 'ul') {
	    ?>
    	</<?php echo esc_attr($tag); ?>>
	    <?php
	}
	
	
	function renderNewsGrid() {
    	
    	$settings = $this->getViewSettings();
    	$col = $settings["col"];
    	$this->renderBegin(array('class'=>'news-list posts-grid small-block-grid-1 small-grid-offset medium-block-grid-'.esc_attr(ceil($col/2)).' large-block-grid-'.esc_attr($col).''));
		
		$thumb_size = 'th-medium';
			
		if($col < 3) {
			$thumb_size = 'th-large';
		}	
		
		while ( $this->query->have_posts() ) : $this->query->the_post();
		?>
			
    	<li <?php post_class();?> itemscope="" itemtype="http://schema.org/BlogPosting" data-equalizer-watch>
    	
    		<div class="row <?php echo esc_attr($this->getCssAnimation());?>">
		    		
	    		<?php if(has_post_thumbnail()): ?>
	        		<?php $this->renderThumb($thumb_size); ?>
	        	<?php endif; ?>
	        	
	        	<div class="meta">	
	        		
	        		<?php $this->renderCategory(); ?>
	        		
	        		<?php if($col < 2): ?>
	        		
	        			<?php $this->renderTitle('h3', 'bold'); ?>
						<?php $this->renderExcerpt('h4', 'spaced'); ?>
	        		
	        		<?php elseif($col >= 5): ?>
	        		
	        			<?php $this->renderTitle('h5', 'bold'); ?>
						<?php $this->renderExcerpt('h6', ''); ?>
						
	        		<?php else: ?>
	        		
	        			<?php $this->renderTitle('h4', 'bold'); ?>
						<?php $this->renderExcerpt('h5'); ?>
						
	        		<?php endif; ?>
	        		
	        		<?php $this->renderAuthor(); ?>
	                <?php $this->renderDate(); ?>
	                <?php $this->renderStats(); ?>
	        		
	        	</div>	
    		</div>
        </li>
        
        <?php
		endwhile;
			
        $this->renderEnd();
    	
	}
	
	function renderNewsList() {
    	
    	$settings = $this->getViewSettings();
    	$thumb = $settings["thumb"];
    	
    	if($thumb == 'small') {
        	$this->renderBegin(array('class'=>'news-list posts-list-small-thumbs list'));
    	}else if($thumb == 'medium') {
        	$this->renderBegin(array('class'=>'news-list posts-list-medium-thumbs list'));
    	}else{
        	$this->renderBegin(array('class'=>'news-list posts-list-large-thumbs list'));
    	}
    	
			
		while ( $this->query->have_posts() ) : $this->query->the_post();
		?>
		<li <?php post_class();?> itemscope="" itemtype="http://schema.org/BlogPosting">
			<div class="row collapse <?php echo esc_attr($this->getCssAnimation());?>">
			    
            <?php if($thumb == 'small') : ?>
			    
			    <?php if(has_post_thumbnail()): ?>
				<div class="small-12 large-4 column first">
				
					<?php $this->renderThumb('th-small'); ?>
					
				</div>
				<?php endif; ?>
				
				<div class="small-12 large-8 column left last">
					<div class="meta">
					
						<?php $this->renderCategory(); ?>
                		<?php if($this->instance["show_excerpt"]) : ?>
                			<?php $this->renderTitle('h4', 'bold'); ?>
                		<?php else: ?>
                			<?php $this->renderTitle('h5'); ?>	
                		<?php endif; ?>	
                		<?php $this->renderExcerpt('p', 'large'); ?>
                		<?php $this->renderAuthor(); ?>
                		<?php $this->renderDate(); ?>
                        <?php $this->renderStats(); ?>
                        
					</div>
				</div>
				
			 <?php elseif($thumb == 'medium') : ?>
			    
			    <?php if(has_post_thumbnail()): ?>
				<div class="small-12 large-5 column first">
				
					<?php $this->renderThumb('th-medium'); ?>
					
				</div>
				<?php endif; ?>
				
				<div class="small-12 large-7 column left last">
					<div class="meta">
					
						<?php $this->renderCategory(); ?>
                		<?php $this->renderTitle('h4', 'bold'); ?>
                		<?php $this->renderExcerpt('p', 'large'); ?>
                		<?php $this->renderAuthor(); ?>
                		<?php $this->renderDate(); ?>
                        <?php $this->renderStats(); ?>
                        
					</div>
				</div>
				
			<?php else: ?>
				
				<?php if(has_post_thumbnail()): ?>
				<div class="small-12 medium-6 large-6 column first">
				
					<?php $this->renderThumb('th-medium'); ?>
					
				</div>
				<?php endif; ?>
				
				<div class="small-12 medium-6 large-6 column left last">
					<div class="meta">
					
						<?php $this->renderCategory(); ?>
                		<?php $this->renderTitle('h3', 'bold'); ?>
                		<?php $this->renderExcerpt('h4', 'spaced'); ?>
                		<?php $this->renderAuthor(); ?>
                		<?php $this->renderDate(); ?>
                        <?php $this->renderStats(); ?>
                        
					</div>
				</div>
				
			<?php endif; ?>
				
					
			</div>
		</li>	
        <?php
		endwhile;
			
        $this->renderEnd();
    	
	}


	function renderNewsFeaturedList() {
    	
    	$settings = $this->getViewSettings();
    	$col = $settings["col"];
    	$style = false;
    	if(!empty($settings["style"])) {
    	    $style = $settings["style"];
    	}
    	
    	$show_category_only_featured = ($this->instance['show_category_only_featured'] == "yes") ? true : false;
    	$show_excerpt_only_featured = ($this->instance['show_excerpt_only_featured'] == "yes") ? true : false;
    	$show_author_only_featured = ($this->instance['show_author_only_featured'] == "yes") ? true : false;
    	$show_date_only_featured = ($this->instance['show_date_only_featured'] == "yes") ? true : false;
    	$show_stats_only_featured = ($this->instance['show_stats_only_featured'] == "yes") ? true : false;
                       
    	?>
    	<div class="row collapse">
 
    	<?php
    	
    	if($col == '1') {
    	
    	    echo '<div class="medium-12 column">';
    	    
        	$this->renderBegin(array('class'=>'news-list featured-posts-1-col list'));
            $i = 0;
    		while ( $this->query->have_posts() ) : $this->query->the_post();
    		?>
    		<li itemscope="" itemtype="http://schema.org/BlogPosting">
    			<div class="row collapse">
    			    <?php if($i == 0) : ?>
    			    <?php if(has_post_thumbnail()): ?>
    				<div class="medium-12 in_widget column">
    					<?php $this->renderThumb('th-medium'); ?>
    				</div>
    				<?php endif; ?>
    				<?php endif; ?>
    				<div class="medium-12 in_widget column">
    					<div class="meta">
                    		
                    		<?php if($i == 0) : ?>
                    		
                    			<?php $this->renderCategory(); ?>                 			
                            	<?php $this->renderTitle('h4', 'bold', true); ?>
                            	<?php $this->renderExcerpt('h6', 'subheader', true); ?>
                            	<?php $this->renderAuthor(); ?>
                            	<?php $this->renderDate(); ?>                               	
								<?php $this->renderStats(true, array('mini no-margin-bottom')); ?>
                            
                            <?php else: ?>
                            
                             	<?php if(!$show_category_only_featured):?>
	                    			<?php $this->renderCategory(); ?>
	                    		<?php endif; ?>
	                    		
                    			<?php $this->renderTitle('h4'); ?>
                    		
	            		        <?php if(!$show_excerpt_only_featured):?>
	                    			<?php $this->renderExcerpt('h6', 'subheader'); ?>
	                    		<?php endif; ?>

	                    		<?php if(!$show_author_only_featured):?>
	                    			<?php $this->renderAuthor(); ?>
	                    		<?php endif; ?>
	                    		
	                    		<?php if(!$show_date_only_featured):?>
	                    			<?php $this->renderDate(); ?>
	                    		<?php endif; ?>
	                    		
	                            <?php if(!$show_stats_only_featured):?>
	                    			<?php $this->renderStats(true, array('mini no-margin-bottom')); ?>
	                    		<?php endif; ?>                      	
                            
                            
                            <?php endif;?>		
                            
    					</div>
    				</div>
	
    			</div>
    		</li>	
            <?php
            $i++;
    		endwhile;
			
            $this->renderEnd();
            
            echo '</div>';
            
                	
    	}else if($col == '2' && $style == '1') {
    	    
        	$this->renderBegin(array('class'=>'news-list featured-posts-2-col-style-1 list'));
        	
        	$i = 0;
        	$counter = 0;
        	
      		while ( $this->query->have_posts() ) : $this->query->the_post();

          		if($i % 3 == 0): 
          		
          			$counter = 0;
          			
		  			if($i > 0) {
			  			$this->renderEnd();
          				$this->renderBegin(array('class'=>'news-list featured-posts-2-col-style-1 list t-padding-30'));
		  			}
          		?>
              		
              		<li class="medium-12 large-8 column first">
            			<div class="row collapse" itemscope="" itemtype="http://schema.org/BlogPosting">
            			    <?php if(has_post_thumbnail()): ?>
            				<div class="medium-12 column">
            				
            					<?php $this->renderThumb('th-large'); ?>
            					
            				</div>
            				<?php endif; ?>
            				<div class="medium-12 column">
            					<div class="meta">
            					
            						<?php $this->renderCategory(); ?>
                            		<?php $this->renderTitle('h1', '', true); ?>
                            		<?php $this->renderExcerpt('h4', 'subheader', true); ?>
                            		<?php $this->renderAuthor(); ?>
                            		<?php $this->renderDate(); ?>
                                    <?php $this->renderStats(); ?>
                                    
            					</div>
            				</div>
        	
            			</div>
            		</li>	
        		
          		<?php else: ?>
              		
					<?php
					$counter++;
					?>
					
					<?php if($counter == 1): ?>
            		<li class="medium-12 large-4 column last">
            		<?php endif; ?>
            		
            			<div class="row collapse<?php echo $this->getCssAnimation();?>" itemscope="" itemtype="http://schema.org/BlogPosting">
            			    
            				<div class="medium-12 column">
            				    <div class="row collapse">
	            				    <?php if(has_post_thumbnail()): ?>
        							<div class="small-7 large-12 column">
                                        <?php $this->renderThumb('th-medium'); ?>
        							</div>
        							<?php endif; ?>
            				    </div>
            				</div>
            				<div class="medium-12 column">
            					<div class="meta">
            					
            						<?php if(!$show_category_only_featured):?>
                            			<?php $this->renderCategory(); ?>
                            		<?php endif; ?>
                            		
                            		<?php $this->renderTitle('h4'); ?>
                            		
                            		<?php if(!$show_excerpt_only_featured):?>
                            			<?php $this->renderExcerpt('h6', 'subheader'); ?>
                            		<?php endif; ?>
                            		
                            		<?php if(!$show_author_only_featured):?>
                            			<?php $this->renderAuthor(); ?>
                            		<?php endif; ?>
                            		
                            		<?php if(!$show_date_only_featured):?>
                            			<?php $this->renderDate(); ?>
                            		<?php endif; ?>
                            		
                                    <?php if(!$show_stats_only_featured):?>
                            			<?php $this->renderStats(); ?>
                            		<?php endif; ?>
                                    
            					</div>
            				</div>
        	
            			</div>
            		
            		<?php if($counter == 3): ?>	
            		</li>
            		<?php endif; ?>
        		
        		<?php endif; ?>
    		
            <?php
            $i++;
    		endwhile;
			
            $this->renderEnd();
                  	
    	}else if($col == '2' && $style == '2') {
    	
    	    $this->renderBegin(array('class'=>'news-list featured-posts-2-col-style-2 list'));
    	    
    	    $i = 0;
        	$counter = 0;
        	
      		while ( $this->query->have_posts() ) : $this->query->the_post();

          		if($i % 7 == 0): 
          		
          			$counter = 0;
          			
          		if($i > 0) {
		  			$this->renderEnd();
      				$this->renderBegin(array('class'=>'news-list featured-posts-2-col-style-2 list t-padding-30'));
	  			}	
          		?>
              		
              		<li class="medium-6 column first">
            			<div class="row collapse" itemscope="" itemtype="http://schema.org/BlogPosting">
            			    <?php if(has_post_thumbnail()): ?>
            				<div class="medium-12 column">
            				
            					<?php $this->renderThumb('th-large'); ?>
            					
            				</div>
            				<?php endif; ?>
            				<div class="medium-12 column">
            					<div class="meta">
            					
            						<?php $this->renderCategory(); ?>
                            		<?php $this->renderTitle('h2', '', true); ?>
                            		<?php $this->renderExcerpt('h4', 'subheader', true); ?>
                            		<?php $this->renderAuthor(); ?>
                            		<?php $this->renderDate(); ?>
                                    <?php $this->renderStats(); ?>
                                    
            					</div>
            				</div>
        	
            			</div>
            		</li>	
            		
          		<?php else: ?>
          		
          			<?php
					$counter++;
					?>
					
          			<?php if($counter == 1): ?>
            		<li class="medium-6 column last no-border">
            		<?php endif; ?>
            		
            			<div class="row collapse<?php if($counter == 6): ?> no-border <?php endif; ?>" itemscope="" itemtype="http://schema.org/BlogPosting">
	            			<?php if(has_post_thumbnail()): ?>
            				<div class="small-4 column first">
                                 <?php $this->renderThumb('th-small'); ?>
            				</div>
            				<?php endif; ?>
            				<div class="small-8 column last">
            					<div class="meta">
            					
            						<?php if(!$show_category_only_featured):?>
                            			<?php $this->renderCategory(); ?>
                            		<?php endif; ?>
            						
                            		<?php $this->renderTitle('h5'); ?>
                            		
									<?php if(empty($this->instance["show_excerpt"])) : ?>
	
		                        		<?php if(!$show_author_only_featured):?>
		                        			<?php $this->renderAuthor(); ?>
		                        		<?php endif; ?>
		                        		
		                        		<?php if(!$show_date_only_featured):?>
		                        			<?php $this->renderDate(); ?>
		                        		<?php endif; ?>
		                        		
		                                <?php if(!$show_stats_only_featured):?>
		                        			<?php $this->renderStats(true, array('mini no-margin-bottom')); ?>
		                        		<?php endif; ?>
                        		
									<?php endif; ?>
									
            					</div>
            				</div>
        	
							<?php if(!empty($this->instance["show_excerpt"]) && empty($this->instance["show_excerpt_only_featured"])) : ?>
							<div class="small-12 column">
								<hr class="thin">
								<div class="meta">
								<?php if(!$show_excerpt_only_featured):?>
                        			<?php $this->renderExcerpt('h6', 'subheader', false, true); ?>
                        		<?php endif; ?>

                        		<?php if(!$show_author_only_featured):?>
                        			<?php $this->renderAuthor(); ?>
                        		<?php endif; ?>
                        		
                        		<?php if(!$show_date_only_featured):?>
                        			<?php $this->renderDate(); ?>
                        		<?php endif; ?>
                        		
                                <?php if(!$show_stats_only_featured):?>
                        			<?php $this->renderStats(true, array('mini no-margin-bottom')); ?>
                        		<?php endif; ?>
								</div>
							</div> 
							<?php endif; ?>
							
            			</div>
            			
            		<?php if($counter == 8): ?>	
            		</li>
            		<?php endif; ?>
        		
        		<?php endif; ?>
    		
            <?php
            $i++;
    		endwhile;
			
            $this->renderEnd();
            
    	}
       
        ?>
        
    	</div>
    	
    	<?php
            	
    }
 
	function renderNewsRankingList() {
    	
    	$settings = $this->getViewSettings();

        $this->renderBegin(array('class'=>'news-list numeric-list list'));

		while ( $this->query->have_posts() ) : $this->query->the_post();
		?>
		<li class="<?php echo esc_attr($this->getCssAnimation());?>"  itemscope="" itemtype="http://schema.org/BlogPosting">

			<div class="meta">
			
				<?php $this->renderCategory(); ?>
							
				<?php if($this->instance["show_excerpt"]) : ?>
					<?php $this->renderTitle('h5', 'bold'); ?>
					<?php $this->renderExcerpt('p'); ?>
					<?php else: ?>
						<?php $this->renderTitle('h5'); ?>
				<?php endif; ?>
							
				<?php $this->renderAuthor(); ?>
				<?php $this->renderDate(); ?>
				<?php $this->renderStats(true, array('mini')); ?>
                
			</div>
					
		</li>	
        <?php
		endwhile;
			
        $this->renderEnd();
    	
	}

 	function renderNewsOrbitSlider() {
    	
    	$settings = $this->getViewSettings();

		$slider_height = 'auto';
		if(!empty($this->instance['slider_height'])) {
			$slider_height = str_replace("px", "", $this->instance['slider_height']);
		}
		$slider_image_size = 'large';
		if(!empty($this->instance['slider_image_size'])) {
			$slider_image_size = $this->instance['slider_image_size'];
		}
		
		?>
		
		<div class="orbit-wrap <?php echo esc_attr($this->getCssAnimation());?>">
			
		<?php
	        echo $this->renderLoading();
		
	        $this->renderBegin(array(
	        	'class'=>'orbit-slider', 
	        	'data-orbit'=>'', 
	        	'data-options' => "
	        			animation:fade;
						pause_on_hover:true;
		                animation_speed:500;
		                navigation_arrows:true;
		                bullets:false;"
	        ));
	
			while ( $this->query->have_posts() ) : $this->query->the_post();
		        $image = xt_get_post_thumbnail_src($slider_image_size);   
		        ?>    
			  	<li style="height:<?php echo esc_attr($slider_height);?>px">
			  		<div class="bg" style="background-image: url(<?php echo esc_url($image);?>)"></div>
					<?php $this->renderTitle('div', 'orbit-caption'); ?>
				</li>
				<?php
			endwhile;
				
	        $this->renderEnd();
        
        ?>
        
		</div>
		
		<?php
    	
	}
	

 	function renderNewsPrimetime() {
    	
    	$settings = $this->getViewSettings();

        $this->renderBegin(array('class'=>'primetime'));

		while ( $this->query->have_posts() ) : $this->query->the_post();
	        $image = xt_get_post_thumbnail_src('large');   
	        ?>    
		  	<li>
		  		<div class="bg" style="background-image: url(<?php echo esc_url($image);?>)"></div>
				<?php $this->renderTitle('div'); ?>
			</li>
			<?php
		endwhile;
			
        $this->renderEnd();
    	
	}
	
		
	function renderNewsStack() {
		
		?>
		<div class="stack">
	
			<?php echo $this->renderLoading(); ?>
		
			<div class="stack_view">
	
				<div class="controls tr">
					<button class="button prev radius" disabled="disabled"><i class="fa fa-chevron-up"></i></button>		
					<button class="button next radius"><i class="fa fa-chevron-down"></i></button>
				</div>
				
				<?php
				$this->renderBegin(array('class'=>'news-list stack_wrap'));
				while ( $this->query->have_posts() ) : $this->query->the_post();
					
					?>
				 
					<li itemscope="" itemtype="http://schema.org/BlogPosting">
						<?php if(has_post_thumbnail()): ?>

							<?php $this->renderThumb('th-large'); ?>
							
						<?php endif; ?>
							
						<div class="meta">
							<?php $this->renderTitle('h1'); ?>
							<?php $this->renderExcerpt('h4', 'subheader'); ?>
							<?php $this->renderAuthor(); ?>
							<?php $this->renderDate(); ?>
							<?php $this->renderStats(); ?>
						</div>	
	
					</li>

					<?php
				endwhile;
				
				$this->renderEnd();
				?>
				
			</div>
		</div>
		<?php

	}
	
	function renderLoading() {
		?>
		<div class="wait">
		  <div class="double-bounce1"></div>
		  <div class="double-bounce2"></div>
		</div>
		<?php
	}
	      	
    function renderThumb($size = 'th-medium') {
    
    	$format = get_post_format();
		if($format == 'video' && !empty($this->instance["embed_video"])) {
	   
			xt_post_featured_media();
	    
	    }else{
	    
		    xt_post_thumbnail($size, true, $this->instance["thumbnails_filter"]);
	    }
	}
	
	function renderCategory() {
	
	    if(!empty($this->instance["show_category"])) {
	    
	    	$max = 1;
	    	if(!empty($this->instance["max_categories"])) {
	    		$max = intVal($this->instance["max_categories"]);
	    	}
	    	
    		xt_post_category(true, $max);
    		
    	}
	}
	
	function renderTitle($tag = 'h3', $class = '', $forFeatured = false) {
	
		$length = null;
		
		if(!$forFeatured && !empty($this->instance["title_length"])) {
			
			$length = $this->instance["title_length"];
			xt_post_title($tag, $class, true, $length);
		
		}else if(!$forFeatured && !empty($this->instance["title_length"])) {
			
			$length = $this->instance["featured_title_length"];
			xt_post_title($tag, $class, true, $length);
							
		}else{
			
			xt_post_title($tag, $class, true);
		}
	}
	
	function renderExcerpt($tag = 'h5', $class = '', $forFeatured = false, $showReadMore = false) {
	
		if(!empty($this->instance["show_excerpt"])) {
			
			if(!$forFeatured && !empty($this->instance["excerpt_length"])) {
				
				$length = $this->instance["excerpt_length"];
				xt_post_excerpt($tag, $class, $length,  "...", $showReadMore);
			
			}else if($forFeatured && !empty($this->instance["featured_excerpt_length"])) {
				
				$length = $this->instance["featured_excerpt_length"];
				xt_post_excerpt($tag, $class, $length,  "...", $showReadMore);
					
			}else{
				
				xt_post_excerpt($tag, $class, null, "...", $showReadMore);
			}	
	    }	
	    
	}
	
	function renderAuthor() {
	
    	if(!empty($this->instance["show_author"])) {
    		
    		xt_post_author();
        }
	}
	
	function renderDate() {
	
    	if(!empty($this->instance["show_date"])) {
    	
    		xt_post_date(); 
        }
	}
	
	function renderStats($linkComments = true, $classes=array()) {
	
    	if(!empty($this->instance["show_stats"])) {
    	
    		xt_post_stats($linkComments, $classes);
        }
	}


} // class XT_Widget_Advanced_News
new XT_Widget_Advanced_News();
