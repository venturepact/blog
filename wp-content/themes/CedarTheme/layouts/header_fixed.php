<?php 

	/**
	 * HEADER - FIXED
	 */

?>

	<header class="bloginfo headroom">
		<div class="title">
			<?php if(get_theme_mod('blogheader_logo_dark') != ""){ ?>
				<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url(get_theme_mod('blogheader_logo_dark')); ?>" alt="<?php esc_attr(bloginfo('name')); ?>"></a>
			<?php }else{ ?>
				<a href="<?php echo esc_url(home_url()); ?>"><?php esc_html(bloginfo('name')); ?></a>-->
			<?php } ?>
		</div>
		<nav class="main">
			<?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'blogheader') ); ?>
			<ul>
				<li class="option searchnav"><span class="showsearch"><i class="fa fa-search"></i></span></li>
				<li class="option drawernav"><span class="showdrawer"><i class="fa fa-navicon"></i></span></li>
			</ul>
		</nav>
	</header>