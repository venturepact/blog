<?php 

	/**
	 * FOOTER - MAIN
	 */

?>

	<footer class="main">
		<?php get_template_part('layouts/copyright'); ?>
		<ul class="social">
			<?php if(get_theme_mod('social_twitter') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" target="_blank" class="socialbutton twitter"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_dribbble') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_dribbble')); ?>" target="_blank" class="socialbutton dribbble"><i class="fa fa-dribbble"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_facebook') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" target="_blank" class="socialbutton facebook"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_google') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_google')); ?>" target="_blank" class="socialbutton google-plus"><i class="fa fa-google"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_tumblr') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_tumblr')); ?>" target="_blank" class="socialbutton tumblr"><i class="fa fa-tumblr"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_youtube') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_youtube')); ?>" target="_blank" class="socialbutton youtube"><i class="fa fa-youtube"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_instagram') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" target="_blank" class="socialbutton instagram"><i class="fa fa-instagram"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_linkedin') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" target="_blank" class="socialbutton linkedin"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_github') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_github')); ?>" target="_blank" class="socialbutton github"><i class="fa fa-github"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_pinterest') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_pinterest')); ?>" target="_blank" class="socialbutton pinterest"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_flickr') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_flickr')); ?>" target="_blank" class="socialbutton flickr"><i class="fa fa-flickr"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_reddit') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_reddit')); ?>" target="_blank" class="socialbutton reddit"><i class="fa fa-reddit"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_stackoverflow') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_stackoverflow')); ?>" target="_blank" class="socialbutton stackoverflow"><i class="fa fa-stack-overflow"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_twitch') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_twitch')); ?>" target="_blank" class="socialbutton twitch"><i class="fa fa-twitch"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_vine') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_vine')); ?>" target="_blank" class="socialbutton vine"><i class="fa fa-vine"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_vk') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_vk')); ?>" target="_blank" class="socialbutton vk"><i class="fa fa-vk"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_vimeo') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_vimeo')); ?>" target="_blank" class="socialbutton vimeo"><i class="fa fa-vimeo-square"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_weibo') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_weibo')); ?>" target="_blank" class="socialbutton weibo"><i class="fa fa-weibo"></i></a></li>
			<?php } ?>
			<?php if(get_theme_mod('social_soundcloud') != ""){ ?>
				<li><a href="<?php echo esc_url(get_theme_mod('social_soundcloud')); ?>" target="_blank" class="socialbutton soundcloud"><i class="fa fa-soundcloud"></i></a></li>
			<?php } ?>
		</ul>
	</footer>