jQuery(document).ready(function($) {

	$(window).on('load', function() {
		
		$('.redux-group-tab').each(function(i) {
		
			var cookie_name = 'redux-accordion-active-'+i;
			
			$(this).accordion({ 
				header: ".redux-section-field",
				animate: false,
				heightStyle: "content",
				activate: function(e, ui) {
					$('html, body').animate({scrollTop: ui.newHeader.offset().top - $('#wpadminbar').outerHeight(true)}, 400);
					
					var active = $(this).accordion( "option", "active" );
					$.cookie(cookie_name, active);

				},
		        create: function() {
		        
		        	var active = $.cookie(cookie_name) != null ? parseInt($.cookie(cookie_name)) : false;
					$(this).accordion( "option", "active", active );

		        }	
			});
		});	
				
	});

});