<?php

	/**
	 * FOOTER TEMPLATE
	 */

?>
	
	</main>

	<?php if(is_single()) get_template_part('layouts/footer_post'); ?>
	<?php if(is_page()) get_template_part('layouts/footer_main'); ?>
	<?php if(is_single() && get_theme_mod('footermain_show_post_Pages', false)) get_template_part('layouts/footer_main'); ?>
	 <img src="https://www.linkedin.com/profile/view?authToken=zRgB&amp;authType=name&amp;id=88478769">
	<?php wp_footer(); ?>
	<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 957807862;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/957807862/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
<script>
jQuery(document).ready(function() {
	if(!((location.pathname).toLowerCase().indexOf("/category/") >= 0) || !((location.pathname).toLowerCase().indexOf("/author/") >= 0))
	{
   	
	jQuery("video.vjs-tech").attr("src", "http://pivot.mediumra.re/video/video.mp4");
	
	}
	else
	{
		jQuery("video.vjs-tech").attr("src", "");
		console.log("start");
		jQuery("video.vjs-tech").remove();
		console.log("stop");
	}
});

</script>
</html>