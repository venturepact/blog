<?php 

	/**
	 * FOOTER - POST
	 */

?>

	<footer class="postinfo">
		<div class="default">
			<section class="socialoptions" style="display:block">
				<ul class="sharebuttons">
					<li><a href="http://twitter.com/share?text=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;" class="socialdark twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;" class="socialdark facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;" class="socialdark google"><i class="fa fa-google-plus"></i></a></li>
					<li><a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=490,height=530');return false;" class="socialdark linkedin"><i class="fa fa-linkedin"></i></a></li>
					<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;description=<?php echo urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')); ?>" onclick="window.open(this.href, 'pinterest-share', 'width=490,height=530');return false;" class="socialdark pinterest"><i class="fa fa-pinterest"></i></a></li>
					<li><a href="mailto:?body=<?php the_permalink(); ?>" class="socialdark email"><i class="fa fa-envelope"></i></a></li>
					<li><span class="socialdark closeshare"><i class="fa fa-times"></i></span></li>
				</ul>
			</section>
			<section class="authorinfo"> 
				<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="authorname"><img src="//0.gravatar.com/avatar/<?php echo esc_attr(md5(get_the_author_meta('user_email'))); ?>?s=24" class="gravatar" alt="<?php the_author(); ?>"> <?php the_author(); ?></a><span class="authordate"><?php esc_html_e('Posted on', ECKO_THEME_ID); ?> <?php echo esc_html(ecko_date_format()); ?></span>
			</section>
			<section class="footer-subscribe">
				<!-- Begin MailChimp Signup Form -->
				<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
				<style type="text/css">
					#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
					/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
					   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
				</style>
				<div id="mc_embed_signup">
					<form action="//venturepact.us10.list-manage.com/subscribe/post?u=938a9e3a636d1bdbb3997cdb4&amp;id=1c4104bfac" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					    <div id="mc_embed_signup_scroll">
	
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Get Top Posts In Your Inbox" required>
						    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						    <div style="position: absolute; left: -5000px;"><input type="text" name="b_938a9e3a636d1bdbb3997cdb4_1c4104bfac" tabindex="-1" value=""></div>
						    <div class="clear"><input type="submit" value="Join" 	name="Subscribe" id="mc-embedded-subscribe" class="button"></div>
					    </div>
					</form>
				</div>

				<!--End mc_embed_signup-->
			</section>
			<ul class="postoptions">
				<?php if(comments_open()){ ?><li class="showcomments"><i class="fa fa-comments-o"></i><?php esc_html_e('Comments', ECKO_THEME_ID); ?></li><?php } ?>
				<li class="showsocial"><i class="fa fa-bookmark-o"></i><?php esc_html_e('Share', ECKO_THEME_ID); ?></li>
			</ul>
		</div>
		<div class="relatedposts">
			<?php
				$previous_post = get_previous_post();
				if(!empty( $previous_post )){
					$thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id( $previous_post->ID ), 'thumbnail_small');?>
			<a href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>" class="previouspost">
				<?php if(!empty($thumb_url[0])) { ?><img src="<?php echo esc_url($thumb_url[0]); ?>" alt="<?php echo esc_attr(get_the_title( $previous_post->ID )); ?>"><?php } ?>
				<div class="info">
					<span><?php esc_html_e('Previous Post', ECKO_THEME_ID); ?></span>
					<span class="title"><?php echo (strlen(get_the_title( $previous_post->ID )) > 13) ? substr(get_the_title( $previous_post->ID ), 0, 30) . '...' : get_the_title( $previous_post->ID ); ?></span>
				</div>
			</a>
			<?php } ?>
			<span class="backtotop"><i class="fa fa-chevron-up"></i></span>
			<?php
				$next_post = get_next_post();
				if(!empty( $next_post )){
					$thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id( $next_post->ID ), 'thumbnail_small');?>
			<a href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>" class="nextpost">
				<?php if(!empty($thumb_url[0])) { ?><img src="<?php echo esc_url($thumb_url[0]); ?>" alt="<?php echo esc_attr(get_the_title( $next_post->ID )); ?>"><?php } ?>
				<div class="info">
					<span><?php esc_html_e('Next Post', ECKO_THEME_ID); ?></span>
					<span class="title"><?php echo (strlen(get_the_title( $next_post->ID )) > 13) ? substr(get_the_title( $next_post->ID ), 0, 30) . '...' : get_the_title( $next_post->ID ); ?></span>
				</div>
			</a>
			<?php } ?>
		</div>
	</footer>