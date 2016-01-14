<?php

	/*-----------------------------------------------------------------------------------*/
	/* TWITTER WIDGET
	/*-----------------------------------------------------------------------------------*/

	class ecko_widget_twitter extends WP_Widget {

		function __construct() {
			parent::__construct(
				'ecko_widget_twitter', 
				'Ecko Twitter', 
				array( 'description' => 'Display latest Tweets.' )
			);
		}

		public function widget( $args, $instance ) {
			?>
				<section class="widget twitter">
					<?php if($instance['title'] != '') { ?>
						<h3 class="widget-title"><?php echo esc_html($instance['title']); ?></h3>
						<hr>
					<?php } ?>
					<?php
						$tweets = $this->get_tweets($instance['apikey'], $instance['apisecret'], $instance['accesstoken'], $instance['accesssecret'], $instance['tweetcount']);
						if(is_array($tweets) && count($tweets) > 0 && !property_exists($tweets[0], 'errors')){
							foreach($tweets as $tweet){
					?>
					<div class="tweet">
						<p class="text">"<?php echo esc_html($tweet->text); ?>"</p>
						<a href="http://twitter.com/<?php echo esc_attr($tweet->user->screen_name); ?>" class="author"><i class="fa fa-twitter"></i> @<?php echo esc_html($tweet->user->screen_name); ?></a>
						<a href="http://twitter.com/<?php echo esc_attr($tweet->user->screen_name); ?>" class="date"><?php echo esc_html(ecko_time_ago($tweet->created_at)); ?></a>
					</div>
					<?php } 
						}
					?>
				</section>
			<?php
		}

		public function get_tweets($apikey, $apisecret, $accesstoken, $accesssecret, $tweetcount){
			$cacheKey = get_theme_mod('twitter_screenname') . '-cache';
			$cached = get_transient($cacheKey);
			if(false !== $cached){ return $cached; }
			include (ECKO_DIR . '/inc/twitteroauth/twitteroauth.php');
			$twitterOAuth = new TwitterOAuth($apikey, $apisecret, $accesstoken, $accesssecret);
			$tweets = $twitterOAuth->get('statuses/user_timeline', array('screen_name' => get_theme_mod('twitter_screenname'), 'count' => $tweetcount));
			set_transient($cacheKey, $tweets, 3600);
			return $tweets;
		}

		public function form( $instance ) { 
			$defaults = array( 
				'title' => '',
				'screenname' => '',
				'apikey' => '',
				'apisecret' => '',
				'accesstoken' => '',
				'accesssecret' => '',
				'tweetcount' => 2
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
				<p>
					<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'screenname' ); ?>">Screenname: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'screenname' ); ?>" name="<?php echo $this->get_field_name( 'screenname' ); ?>" type="text" value="<?php echo esc_attr( $instance['screenname'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'apikey' ); ?>">API Key: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'apikey' ); ?>" name="<?php echo $this->get_field_name( 'apikey' ); ?>" type="text" value="<?php echo esc_attr( $instance['apikey'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'apisecret' ); ?>">API Secret: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'apisecret' ); ?>" name="<?php echo $this->get_field_name( 'apisecret' ); ?>" type="text" value="<?php echo esc_attr( $instance['apisecret'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'accesstoken' ); ?>">Access Token: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'accesstoken' ); ?>" name="<?php echo $this->get_field_name( 'accesstoken' ); ?>" type="text" value="<?php echo esc_attr( $instance['accesstoken'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'accesssecret' ); ?>">Access Secret: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'accesssecret' ); ?>" name="<?php echo $this->get_field_name( 'accesssecret' ); ?>" type="text" value="<?php echo esc_attr( $instance['accesssecret'] ); ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'tweetcount' ); ?>">Number of Tweets to show: </label> 
					<input class="widefat" id="<?php echo $this->get_field_id( 'tweetcount' ); ?>" name="<?php echo $this->get_field_name( 'tweetcount' ); ?>" type="number" value="<?php echo esc_attr( $instance['tweetcount'] ); ?>" min="1" max="5" />
				</p>
			<?php
		}
			
		public function update( $new_instance, $old_instance ) { 
			$instance = array();
			foreach ($new_instance as $key => $value) {
				$instance[$key] = ( ! empty( $new_instance[$key] ) ) ? strip_tags( $new_instance[$key] ) : '';
			}
			return $instance;
		}

	}

?>