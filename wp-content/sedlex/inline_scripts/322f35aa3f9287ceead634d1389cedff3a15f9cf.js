		jQuery(document).ready(function () {	
		
			jQuery(window).resize(function () { 
				jQuery('a.gallery_colorbox').colorbox({
									maxWidth: Math.min(1200, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(1200, Math.floor(0.95*jQuery(window).height())-80)
				
				}) ; 
			});
				
			jQuery('a.gallery_colorbox').colorbox({ 
				slideshow: true,
								title: false,
								slideshowAuto:false,
								slideshowSpeed: 5000 ,
				slideshowStart: '',
				slideshowStop :  '',
				current : '', 
				scalePhotos : true , 
				previous: '',	
				next:'',
				close:'',
													maxWidth: Math.min(1200, Math.floor(0.95*jQuery(window).width())-80), 
					maxHeight: Math.min(1200, Math.floor(0.95*jQuery(window).height())-80),
												
				
				opacity:0.8 , 
				onComplete : function(){ 
					jQuery("#cboxLoadedContent").css({overflow:'hidden'});
					jQuery("#colorbox").css({overflow:'visible'});
				    				jQuery('.cboxPhoto').unbind().click(jQuery('a.gallery_colorbox').colorbox.close); 
									jQuery("#cboxSlideshow").hide();
								},
				rel:'group1' 
			});
		});	
						
		