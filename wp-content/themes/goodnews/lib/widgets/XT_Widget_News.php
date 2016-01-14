<?php

/**
 * News Widget Class
 *
 * @since 1.0
 * @see   XT_Widget_News
 * @todo  - Add advanced options
 */

class XT_Widget_News extends XT_Widget
{
	/**
	 * Widget Defaults
	 */
	protected $query;
	public static $widget_defaults;


	/**
	 * Register widget with WordPress.
	 */

	function __construct ()
	{
		$widget_ops = array(
			  'classname'   => 'xt_news'
			, 'description' => _x('The most recent news on your site.', 'Widget', XT_TEXT_DOMAIN)
		);

		self::$widget_defaults = array(
			  'title' => '',
			  'bold_title' => 0,
	    	  'number' => get_option('posts_per_page'),
	    	  'show_date' => 0,
	    	  'show_author' => 0,
	    	  'show_category' => 0,
	    	  'show_excerpt' => 0,
	    	  'show_stats' => 0,
	    	  'title_length' => 12,
	    	  'excerpt_length' => apply_filters( 'excerpt_length', 55 ),
	    	  'category' => '',
              'format' => '',	    	  
	    	  'view' => 'list',
	    	  'bordered' => 0,
	    	  'post_type' => 'post',
			  'action_title' => '',
			  'action_obj_id'  => '',
			  'action_ext_link'  => ''
		);

		parent::__construct('xt-news', XT_WIDGET_PREFIX . _x('News', 'Widget', XT_TEXT_DOMAIN), $widget_ops);
		
	}
	

	function widget ( $args, $instance )
	{
		global $show_date;

		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );
		$this->fix_args($args);

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$post_type  = apply_filters( 'widget_post_type', $instance['post_type'], $instance, $this->id_base );
		$number     = $instance['number'];
		$category   = $instance['category'];
		$format   = $instance['format'];
		$view     	= $instance['view'];
		$bordered   = (bool)$instance['bordered'];
		
		if($bordered) {
			$this->set_border($args);
		}
		
		$this->instance = $instance;
		
		
		extract($args);
		

		$query_args = array(
			  'post_type'           => $post_type
			, 'posts_per_page'      => $number
			, 'no_found_rows'       => true
			, 'post_status'         => 'publish'
			, 'ignore_sticky_posts' => true
		);

		if(!empty($category)) {

			if(is_array($category)) {
				$category = implode(",", $category);
			}
			$query_args["cat"] = $category;
		}

		if(!empty($format)) {

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
		

		if(!empty($format)) {
		
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
	
	
		}else{
			
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
		
		if(is_single()) {
			$post_id = get_the_ID();
			$query_args["post__not_in"] = array($post_id);
		}
		
			
		$query = new WP_Query( $query_args );

		if ( $query->have_posts() ) :

            $this->query = $query;
            
			$action_title = $instance['action_title'];
			$action_obj_id = $instance['action_obj_id'];
			$action_ext_link = $instance['action_ext_link'];
	
			/***/
	
			$action = $this->action_link( $action_obj_id, $action_ext_link, $action_title);

			echo $before_widget;

			if ( ! empty( $title ) )
				echo $before_title . $title . $action . $after_title;

			?>
			<div class="recent-posts <?php echo esc_attr($view); ?>">
			<?php				
				$permalink_enabled = (bool) get_option('permalink_structure');
					
				if($view == 'grid-1col') {
		
					$this->renderNewsGrid(1);
				
				}else if($view == 'grid-2col') {
				
					$this->renderNewsGrid(2);
					
				}else if($view == 'grid-3col') {
				
					$this->renderNewsGrid(3);
					
				}else if($view == 'grid-4col') {
				
					$this->renderNewsGrid(4);

				}else if($view == 'grid-5col') {
				
					$this->renderNewsGrid(5);
							
				}else if($view == 'list') {

					$this->renderNewsList();
        
				}else if($view == 'ranking') {

					$this->renderNewsRankingList();
        
				}

			?>				
			</div>

			<?php

			echo $after_widget;

			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();

		endif;

	}

	
	function renderBegin($class = '') {
    	
    	?>
    	
    	<ul class="news-list <?php echo esc_attr($class); ?>">
    	
    	<?php
	}
	
	function renderEnd() {
	    ?>
    	</ul>
	    <?php
	}
	
		
	function renderNewsGrid($col) {
		

    	$this->renderBegin('posts-grid small-block-grid-1 small-grid-offset medium-block-grid-'.esc_attr(ceil($col/2)).' large-block-grid-'.$col.'');
		
		$thumb_size = 'th-medium';
			
		if($col < 3) {
			$thumb_size = 'th-large';
		}	
			
		while ( $this->query->have_posts() ) : $this->query->the_post();
		?>
			
    	<li <?php post_class(); ?> data-equalizer-watch  itemscope="" itemtype="http://schema.org/BlogPosting">
    	
    		<div class="row">
	    		
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
	
		$this->renderBegin('news-list posts-list-medium-thumbs list');

		while ( $this->query->have_posts() ) : $this->query->the_post();
		?>

         	<li <?php post_class(); ?>  itemscope="" itemtype="http://schema.org/BlogPosting">
				<div class="row collapse">
					<div class="small-12 medium-6 large-4 column first">
						<?php $this->renderThumb('th-medium'); ?>
					</div>
					<div class="small-12 medium-6 large-8 column last">
						<div class="meta">
							<?php $this->renderCategory(); ?>
							
							<?php if($this->instance["show_excerpt"]) : ?>
								<?php $this->renderTitle('h4', 'bold'); ?>
							<?php $this->renderExcerpt('p'); ?>
							<?php else: ?>
								<?php $this->renderTitle('h5'); ?>
							<?php endif; ?>
							
							<?php $this->renderAuthor(); ?>
							<?php $this->renderDate(); ?>
							<?php $this->renderStats(); ?>
						</div>
					</div>	
				</div>
			</li>  
			 
        <?php
		endwhile;
			
		$this->renderEnd();
	}

	function renderNewsRankingList() {
	
		$this->renderBegin('numeric-list list');

		while ( $this->query->have_posts() ) : $this->query->the_post();
		?>

         	<li itemscope="" itemtype="http://schema.org/BlogPosting">
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
	
	function update ( $new_instance, $old_instance )
	{
		$instance = wp_parse_args( (array) $old_instance, self::$widget_defaults );

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['title_length'] = (int) $new_instance['title_length'];
		$instance['excerpt_length'] = (int) $new_instance['excerpt_length'];
		
		$instance['view'] = $new_instance['view'];
		$instance['category'] = $new_instance['category'];
        $instance['format'] = $new_instance['format'];		
		$instance['show_date'] = !empty($new_instance['show_date']) ? 1 : 0;
		$instance['show_author'] = !empty($new_instance['show_author']) ? 1 : 0;
		$instance['bordered'] = !empty($new_instance['bordered']) ? 1 : 0;
		
		$instance["show_category"] = !empty($new_instance['show_category']) ? 1 : 0;
		$instance["show_excerpt"] = !empty($new_instance['show_excerpt']) ? 1 : 0;
		$instance["show_stats"] = !empty($new_instance['show_stats']) ? 1 : 0;
		$instance["bold_title"] = !empty($new_instance['bold_title']) ? 1 : 0;

		$instance['action_title']  = $new_instance['action_title'];
		$instance['action_obj_id']  = $new_instance['action_obj_id'];
		$instance['action_ext_link']  = $new_instance['action_ext_link'];
				

		return $instance;
	}

	function form ( $instance )
	{
		$instance = wp_parse_args( (array) $instance, self::$widget_defaults );

		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		
		$title_length    = isset( $instance['title_length'] ) ? absint( $instance['title_length'] ) : 12;
		$excerpt_length    = isset( $instance['excerpt_length'] ) ? absint( $instance['excerpt_length'] ) : apply_filters( 'excerpt_length', 55 );

		$show_date = !empty($instance['show_date']) ? 1 : 0;
		$show_author = !empty($instance['show_author']) ? 1 : 0;
		$show_category = !empty($instance['show_category']) ? 1 : 0;
		$show_excerpt = !empty($instance['show_excerpt']) ? 1 : 0;
		$show_stats = !empty($instance['show_stats']) ? 1 : 0;
		$bold_title = !empty($instance['bold_title']) ? 1 : 0;

		$view = $instance['view'];
		$category = $instance['category'];
        $format = $instance['format'];		
		$bordered = !empty($instance['bordered']) ? 1 : 0;
		
		$action_title = $instance['action_title'];
		$action_obj_id = $instance['action_obj_id'];
		$action_ext_link = $instance['action_ext_link'];
		?>
		
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , XT_TEXT_DOMAIN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder="<?php _e('Latest News', XT_TEXT_DOMAIN); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' , XT_TEXT_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>


		<p><label for="<?php echo $this->get_field_id( 'title_length' ); ?>"><?php _e( 'Title Length:' , XT_TEXT_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id( 'title_length' ); ?>" name="<?php echo $this->get_field_name( 'title_length' ); ?>" type="text" value="<?php echo esc_attr($title_length); ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'excerpt_length' ); ?>"><?php _e( 'Excerpt Length:' , XT_TEXT_DOMAIN); ?></label>
		<input id="<?php echo $this->get_field_id( 'excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_length' ); ?>" type="text" value="<?php echo esc_attr($excerpt_length); ?>" size="3" /></p>


		<p><input class="checkbox" type="checkbox" <?php checked( $bold_title ); ?> id="<?php echo $this->get_field_id( 'bold_title' ); ?>" name="<?php echo $this->get_field_name( 'bold_title' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'bold_title' ); ?>"><?php _e( 'Bold Title' , XT_TEXT_DOMAIN); ?></label></p>

		
		<p><input class="checkbox" type="checkbox" <?php checked( $show_excerpt ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Display Excerpt' , XT_TEXT_DOMAIN); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date' , XT_TEXT_DOMAIN); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_author ); ?> id="<?php echo $this->get_field_id( 'show_author' ); ?>" name="<?php echo $this->get_field_name( 'show_author' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_author' ); ?>"><?php _e( 'Display author' , XT_TEXT_DOMAIN); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_category ); ?> id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category' , XT_TEXT_DOMAIN); ?></label></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_stats ); ?> id="<?php echo $this->get_field_id( 'show_stats' ); ?>" name="<?php echo $this->get_field_name( 'show_stats' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_stats' ); ?>"><?php _e( 'Display Stats' , XT_TEXT_DOMAIN); ?></label></p>


		<p><input class="checkbox" type="checkbox" <?php checked( $bordered ); ?> id="<?php echo $this->get_field_id( 'bordered' ); ?>" name="<?php echo $this->get_field_name( 'bordered' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'bordered' ); ?>"><?php _e( 'Bordered Box' , XT_TEXT_DOMAIN); ?></label></p>
				
		<p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php _ex('Filter by category:', 'Widget', XT_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>[]" multiple="mutiple">
				<?php echo $this->get_taxonomy_options($category); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'format' ); ?>"><?php _e( 'Filter by post format:', XT_TEXT_DOMAIN ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>[]" multiple="mutiple">
				<?php echo $this->get_post_format_options($format); ?>
			</select>
		<p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'view' ); ?>"><?php _e( 'View As:' , XT_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('view'); ?>" name="<?php echo $this->get_field_name('view'); ?>">
				<option <?php echo ($view == 'grid-1col' ? 'selected' : ''); ?> value="grid-1col"><?php _ex('Classic', 'Widget', XT_TEXT_DOMAIN); ?></option>
				<option <?php echo ($view == 'list' ? 'selected' : ''); ?> value="list"><?php _ex('List', 'Widget', XT_TEXT_DOMAIN); ?></option>
				<option <?php echo ($view == 'grid-2col' ? 'selected' : ''); ?> value="grid-2col"><?php _ex('Grid 2 Columns' , 'Widget', XT_TEXT_DOMAIN); ?></option>			
				<option <?php echo ($view == 'grid-3col' ? 'selected' : ''); ?> value="grid-3col"><?php _ex('Grid 3 Columns' , 'Widget', XT_TEXT_DOMAIN); ?></option>			
				<option <?php echo ($view == 'grid-4col' ? 'selected' : ''); ?> value="grid-4col"><?php _ex('Grid 4 Columns' , 'Widget', XT_TEXT_DOMAIN); ?></option>
				<option <?php echo ($view == 'grid-5col' ? 'selected' : ''); ?> value="grid-4col"><?php _ex('Grid 5 Columns' , 'Widget', XT_TEXT_DOMAIN); ?></option>			
				<option <?php echo ($view == 'ranking' ? 'selected' : ''); ?> value="ranking"><?php _ex('Ranking List' , 'Widget', XT_TEXT_DOMAIN); ?></option>

			</select>						
		<p>

		<p>
			<label for="<?php echo $this->get_field_id('action_title'); ?>"><?php _ex('Call To Action Title:', 'Widget', XT_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('action_title'); ?>" name="<?php echo $this->get_field_name('action_title'); ?>" value="<?php echo esc_attr($action_title); ?>" placeholder="<?php _e('View More', XT_TEXT_DOMAIN); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('action_obj_id'); ?>"><?php _ex('Call To Call To Action Page:', 'Widget', XT_TEXT_DOMAIN); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('action_obj_id'); ?>" name="<?php echo $this->get_field_name('action_obj_id'); ?>">
				<?php echo $this->get_object_options($action_obj_id); ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('action_ext_link'); ?>"><?php _ex('Call To Action External Link:', 'Widget', XT_TEXT_DOMAIN); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('action_ext_link'); ?>" name="<?php echo $this->get_field_name('action_ext_link'); ?>" value="<?php echo esc_attr($action_ext_link); ?>" />
		</p>
		
		<?php
	}


    function renderThumb($size = 'th-medium') {
    
	    xt_post_thumbnail($size, true);
	}

	function renderCategory() {
	
	    if($this->instance["show_category"]) {
	    
    		xt_post_category();
    		
    	}
	}


	function renderTitle($tag = 'h3', $class = '') {
	
		$length = null;
		
		if(!empty($this->instance["title_length"])) {
			
			$length = $this->instance["title_length"];
			xt_post_title($tag, $class, true, $length);
			
		}else{
			
			xt_post_title($tag, $class, true);
		}
	}

	function renderExcerpt($tag = 'h5', $class = '') {
	
		if(!empty($this->instance["show_excerpt"])) {
			
			if(!empty($this->instance["excerpt_length"])) {
				
				$length = $this->instance["excerpt_length"];
				xt_post_excerpt($tag, $class, $length);
				
			}else{
				
				xt_post_excerpt($tag, $class);
			}	
	    }	
	    
	}
			
	function renderAuthor() {
	
    	if($this->instance["show_author"]) {
    		
    		xt_post_author();
        }
	}
	
	function renderDate() {
	
    	if($this->instance["show_date"]) {
    	
    		xt_post_date(); 
        }
	}

	function renderStats($linkComments = true, $classes=array()) {
	
    	if($this->instance["show_stats"]) {
    	
    		xt_post_stats($linkComments, $classes);
        }
	}

} 