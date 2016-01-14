<?php 
$menu = xt_get_menu_by_location('right-side-push-menu');
?>
<!-- Off canvas sticky menu -->	
<aside class="off-canvas-menu right-off-canvas-menu">	

	<?php if(!empty($menu)): ?>
	<label class="push-menu-label"><?php echo $menu->name; ?></label>
	<?php endif; ?>
	
	<?php 
	xt_get_nav_menu('right-side-push-menu', array( 
		'menu_class' => 'off-canvas-list', 
		'container' => false, 
		'dropdown_class' => 'f-dropdown drop-left',
		'dropdown_label' => true
	));	
	?>
	
</aside>
<!-- End Off canvas sticky menu -->	