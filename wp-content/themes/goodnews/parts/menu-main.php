<?php
$mainmenu = (bool)xt_option('mainmenu');
$mainmenu_sticky = (bool)xt_option('mainmenu-sticky') ? ' sticky' : '';
$mainmenu_sticky_height = xt_value_format(xt_option('mainmenu-sticky-height'), 'px-int');
$mainmenu_sticky_distance = xt_option('mainmenu-sticky-distance');
$mainmenu_sticky_distance = str_replace("px", "", trim($mainmenu_sticky_distance));
$mainmenu_stretch_items = (bool)xt_option('mainmenu-stretch-items') ? ' stretch' : '';
$topbar_container = xt_option('mainmenu-container') == 'boxed' ? ' contain-to-grid' : '';

$mainmenu_show_logo = (bool)xt_option('mainmenu-show-logo', null, false);	

$mainmenu_search_bar_enabled = (bool)xt_option('mainmenu-search-bar-toggle-enabled');
$mainmenu_search_bar_toggle = xt_option('mainmenu-search-bar-toggle');
?>

<?php if($mainmenu): ?>
<!-- Main Menu Bar -->
<div class="main-menu hide-for-small-only<?php echo esc_attr($mainmenu_sticky);?><?php echo esc_attr($topbar_container);?>">

	<nav class="top-bar" data-topbar data-sticky_height="<?php echo esc_attr($mainmenu_sticky_height);?>" data-distance="<?php echo esc_attr($mainmenu_sticky_distance);?>" data-options="sticky_on: medium">

		<section class="top-bar-section search-toggle-<?php echo esc_attr($mainmenu_search_bar_toggle); ?>">
		
			<?php if($mainmenu_show_logo): ?>
			<ul class="title-area">
				<li class="name">
					<?php 
					$mainmenu_logo = xt_option('mainmenu-logo', 'url');
					$mainmenu_retina_logo = xt_option('mainmenu-retina-logo', 'url');
					
					if(!empty($mainmenu_logo) ) :
						
					?>
					<a href="<?php echo home_url('/');?>" class="site-logo">
					  	<img class="logo-desktop regular" src="<?php echo esc_url( $mainmenu_logo ); ?>" <?php echo (!empty($mainmenu_retina_logo) ? 'data-interchange="['.esc_url( $mainmenu_retina_logo ).', (retina)]"' : '');?> alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
					</a>
					
					<?php else: ?>
					
					<h1><a href="<?php echo home_url('/');?>"><?php echo esc_attr( get_bloginfo('name') ); ?></a></h1>
					
					<?php endif; ?>
				</li>
			</ul>
			<?php endif; ?>
					
			<?php if($mainmenu_search_bar_enabled): ?>
			<!-- Right Nav Section -->
			<ul class="right search">
				<li class="has-form">
					<?php get_template_part('parts/searchform'); ?>
				</li>
			</ul>
			<!-- Left Nav Section -->
			<?php endif; ?>
	
			<?php 
			xt_get_nav_menu('main-menu', array( 
				'menu_class' => 'menu'.$mainmenu_stretch_items.(($mainmenu_show_logo) ? ' has-logo right' : ' left'), 
				'container' => false,
			));	
			$menu_location = 'main-menu';
			?>

		</section>
	</nav>

</div>
<!-- End Main Menu Bar -->
<?php endif; ?>
<style>
.main-menu .top-bar-section ul.search a.search-close-button{ top:10px;}
.main-menu .top-bar-section ul.search input{ top:0px;}
.main-menu .top-bar .has-form .button{top:10px;}
</style>