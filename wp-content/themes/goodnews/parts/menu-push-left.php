<?php 
$menu = xt_get_menu_by_location('left-side-push-menu');
?>
<!-- Off canvas sticky menu -->	
<aside class="off-canvas-menu left-off-canvas-menu">	
	
	<?php if(!empty($menu)): ?>
	<label class="push-menu-label"><?php echo $menu->name; ?></label>
	<?php endif; ?>
	
	<?php 
	xt_get_nav_menu('left-side-push-menu', array( 
		'menu_class' => 'off-canvas-list', 
		'container' => false, 
		'dropdown_class' => 'f-dropdown drop-right',
		'dropdown_label' => true
	));
	?>
	
</aside>
<!-- End Off canvas sticky menu -->	