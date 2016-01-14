<?php 

	/**
	 * DRAWER
	 */

?>

	<section class="drawer">
		<i class="fa fa-times closedrawer"></i>
		<?php
			if(is_single()){
				if(is_active_sidebar('sidebar-post')){
					dynamic_sidebar('sidebar-post');
				}else{
					cedar_get_default_widgets();
				}
			}else{
				if(is_active_sidebar('sidebar-page')){
					dynamic_sidebar('sidebar-page');
				}else{
					cedar_get_default_widgets();
				}
			}
		?>
		<?php get_template_part('layouts/copyright'); ?>
	</section>