<?php
$topbar = (bool)xt_option('topbar');
$topbar_sticky = (bool)xt_option('topbar-sticky') ? ' sticky' : '';
$topbar_sticky_height = xt_value_format(xt_option('topbar-sticky-height'), 'px-int');
$topbar_sticky_distance = xt_option('topbar-sticky-distance');
$topbar_sticky_distance = str_replace("px", "", trim($topbar_sticky_distance));

$topbar_show_logo = (bool)xt_option('topbar-show-logo', null, true);	

$topbar_container = xt_option('topbar-container') == 'boxed' ? ' contain-to-grid' : '';
$visibility = $topbar ? '' : ' show-for-small-only';
?>


<!-- Top Menu Bar -->

<div class="top-menu<?php echo esc_attr($topbar_sticky);?><?php echo esc_attr($topbar_container);?><?php echo esc_attr($visibility);?>">

	<nav class="top-bar" data-topbar data-sticky_height="<?php echo esc_attr($topbar_sticky_height);?>" data-distance="<?php echo esc_attr($topbar_sticky_distance);?>" data-options="sticky_on: small">

		<?php 
		$push_menu = xt_option('push-menu-position');
		$toggle_visibility = xt_option('push-menu-toggle');
		
		if($push_menu != "disabled") {
		?>
			<ul class="sticky-menu <?php echo esc_attr($push_menu); ?> <?php echo esc_attr($toggle_visibility);?>">
				<li class="toggle-sidebar menu-icon"><a href="#" class="<?php echo esc_attr($push_menu); ?>-off-canvas-toggle off-canvas-toggle"><i class="fa fa-bars"></i></a></li>
			</ul>
		<?php
		}
		?>
		
		<?php 
		$search_toggle = xt_option('search-bar-toggle-position');
		$toggle_visibility = xt_option('search-bar-toggle');
		
		if($search_toggle != "disabled") {
		?>
			<ul class="sticky-menu <?php echo esc_attr($search_toggle); ?> <?php echo esc_attr($toggle_visibility);?>">
				
<li class="toggle-search menu-search">
<a  class="right" href="http://venturepact.com/index.php?r=site/newProject">
			<span style="color:#FFFFFF; background-color:#1abb9c; valign:center;padding:10px; border-radius:5px;font-size:12px; margin:15px;">
							Start Your Project
					</span>
				<a/>
</li>
<li class="toggle-search menu-search"><a href="#" class="search-toggle right"><i class="fa fa-search"></i></a></li>
			</ul>
		<?php
		}
		?>

		<ul class="title-area">
			
			<li class="name<?php echo (!$topbar_show_logo) ? ' show-for-small-only' : ''; ?>">
				<?php 
				$topbar_logo = xt_option('header_logo', 'url');
				$topbar_retina_logo = xt_option('retina_header_logo', 'url');
				
				if(!empty($topbar_logo) ) :
					
				?>
				<a href="<?php echo home_url('/');?>" class="site-logo">
				  	<img class="logo-desktop regular" src="<?php echo esc_url( $topbar_logo ); ?>" <?php echo (!empty($topbar_retina_logo) ? 'data-interchange="['.esc_url( $topbar_retina_logo ).', (retina)]"' : '');?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				</a>
				
				<?php else: ?>
				
				<h1><a href="<?php echo home_url('/');?>"><?php echo esc_attr( get_bloginfo('name') ); ?></a></h1>
				
				<?php endif; ?>
			</li>
			<li class="toggle-topbar menu-icon"><a href="#"></a></li>
		</ul>
		
		
			
		<section class="top-bar-section">
			<!-- Right Nav Section -->
			
			<h2 class="hide-for-small-up">--</h2>
			<?php get_template_part('parts/menu', 'account'); ?>
			
			<?php 
			$social_networks = xt_option('social_icons');
			$social_networks_enabled = (bool)xt_option('topbar-followus');
			?>
			<?php if($social_networks_enabled && !empty($social_networks) && !empty($social_networks[0]["name"])): ?>

			<!-- Left Nav Section -->
			<ul class="left follow-us show-for-medium-up">
				<li class="has-dropdown">
					<a href="#"><span><span class="show-for-large-up"><?php echo __("Follow us", XT_TEXT_DOMAIN); ?></span></span> <i class="fa fa-caret-down"></i></a>
					<ul class="dropdown f-dropdown">
						<?php foreach($social_networks as $network): ?>
						<?php 
							if(empty($network["name"])) 
								continue;
						?>
						<li>
							<a style="color:<?php echo esc_attr($network["color"]); ?>" target="_blank" href="<?php echo esc_url($network["url"]); ?>">
								<?php if(!empty($network["thumb"])): ?>
								<img src="<?php echo esc_url($network["thumb"]); ?>" style="max-height:18px;">
								<?php else: ?>
								<i class="fa fa-<?php echo esc_attr($network["icon"]); ?>" title="<?php echo esc_attr($network["name"]); ?>"></i> <?php echo __("Follow us on", XT_TEXT_DOMAIN); ?> <?php echo esc_html($network["name"]); ?>
								<?php endif; ?>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
			</ul>
			<!-- Left Nav Section -->
			
			
			<?php endif; ?>

			<?php 
			global $current_page_title;
			$topbar_page_title = (bool)xt_option('topbar-sticky-page-title', null, 1);
			if($topbar_page_title && !is_front_page() && !empty($current_page_title)): ?>
			<ul class="left page-title show-for-large-up">
				<li><?php echo xt_trim_text($current_page_title, 25); ?></li>
			</ul>
			<?php endif; ?>

			<?php 
			xt_get_nav_menu('main-mobile-menu', array( 
				'menu_class' => 'left menu show-for-small-only clearfix', 
				'container' => false,
			));	
			?>
			
			<?php
			$social_networks_mobile_enabled = (bool)xt_option('topbar-mobile-menu-search');
			if(!empty($social_networks_mobile_enabled)):
			?>
			<!-- Search Section -->
			<ul class="search show-for-small-only clearfix">
			    <li class="has-form">
			    	<?php get_template_part('parts/searchform'); ?>
				</li>
		    </ul>
			<?php endif; ?>
			<?php
			$social_networks_mobile_enabled = (bool)xt_option('topbar-mobile-menu-followus');
			if(!empty($social_networks_mobile_enabled)):
			?>
			<!-- Social Networks Section -->
			<div class="show-for-small-only clearfix">
				<?php get_template_part('parts/networks'); ?>
			</div>
			<?php endif; ?>
			<a  class="right" href="http://venturepact.com/index.php?r=site/newProject">
			<span style="color:#FFFFFF; background-color:#1abb9c; valign:center;padding:10px; border-radius:5px;font-size:12px; margin:15px;">
							Start Your Project
					</span>
				<a/>
		</section>
		
	</nav>

</div>
<!-- End Top Menu Bar -->
<style>
.top-menu.fixed .top-bar .top-bar-section .right{ display:none;}
</style>