<?php 

	/**
	 * SEARCH OVERLAY
	 */

?>

	<section class="searchoverlay">
		<i class="fa fa-times closesearch"></i>
		<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url( '/' )); ?>">
			<input type="text" value="" name="s" class="query" placeholder="<?php esc_attr_e('Enter Search Query...', ECKO_THEME_ID); ?>">
			<i class="fa fa-search"></i>
		</form>
	</section>