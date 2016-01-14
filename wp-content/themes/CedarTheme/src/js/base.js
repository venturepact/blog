
jQuery(document).ready(function() {
	"use strict";


	// VIDEO HEADER
	if(jQuery('.cover.front .background').length > 0 && (ecko_theme_vars.videocover_mp4 != "" || ecko_theme_vars.videocover_webm != "")){
		if (!Modernizr.touch) {
			var BV = new jQuery.BigVideo( { useFlashForFirefox: false, container: jQuery('.cover.front .background') } );
			var videos = [];
			if(ecko_theme_vars.videocover_mp4 != "") videos.push( { type: "video/mp4",  src: ecko_theme_vars.videocover_mp4 } );
			if(ecko_theme_vars.videocover_webm != "") videos.push( { type: "video/webm", src: ecko_theme_vars.videocover_webm } );
			BV.init();
			BV.show(videos, { ambient: true } );
		}
	}


	// SERACH TOGGLE
	jQuery('.showsearch').click(function(){
		jQuery('.searchoverlay').fadeIn(500);
		jQuery('.searchoverlay .query').focus();
	});

	jQuery('.closesearch').click(function(){
		jQuery('.searchoverlay').fadeOut(500);
	});


	// FLOATING HEADER
	if(jQuery('.cover').length > 0){
		jQuery('.headroom').css('display', 'none');
		jQuery('footer.postinfo').css('display', 'none');
		jQuery('.cover').waypoint(function(direction) {
			if(direction == "down") jQuery('.headroom').css('display', 'block');
			if(direction == "up") jQuery('.headroom').fadeOut(200);
		}, {  offset: -Math.abs(jQuery('.cover').height()) });
		jQuery('.cover').waypoint(function(direction) {
			if(direction == "down") jQuery('footer.postinfo').css('display', 'block');
			if(direction == "up") jQuery('footer.postinfo').fadeOut(200);
		}, {  offset: -75 });
	}else{
		jQuery('.headroom').css('display', 'block');
	}

	if(jQuery(".headroom").length > 0){
		Headroom.options['offset'] = 50;
		Headroom.options['tolerance']['up'] = 20;
		Headroom.options['tolerance']['down'] = 10;
		Headroom.options['onUnpin'] = function(){
			jQuery('.sub-menu').slideUp();
		};
		var header = document.querySelector(".headroom");
		var headroom  = new Headroom(header);
		headroom.init();
	}


	// DRAWER
	function openDrawer(){
		jQuery('.drawer').addClass('show');
		jQuery('.pagewrapper').addClass('slide');	
		jQuery('.bloginfo').addClass('slide');
		jQuery('.searchoverlay').addClass('slide');
		jQuery('footer.postinfo').addClass('slide');
		jQuery('.showdrawer i').removeClass('fa-navicon');
		jQuery('.showdrawer i').addClass('fa-times');
		setTimeout(function(){ jQuery('.pagewrapper').addClass('slide-completed') }, 500);
	}

	function closeDrawer(){
		jQuery('.drawer').removeClass('show');
		jQuery('.pagewrapper').removeClass('slide');
		jQuery('.pagewrapper').removeClass('slide-completed');
		jQuery('.bloginfo').removeClass('slide');
		jQuery('.searchoverlay').removeClass('slide');
		jQuery('footer.postinfo').removeClass('slide');
		jQuery('.showdrawer i').addClass('fa-navicon');
		jQuery('.showdrawer i').removeClass('fa-times');
	}

	jQuery('.pagewrapper.slide-completed').live( "click", function() {
		closeDrawer();
	});

	jQuery('.showdrawer').click(function(){
		if(!jQuery('.drawer').hasClass('show')){
			openDrawer();
		}else{
			closeDrawer();
		}
	});

	jQuery('.closedrawer').click(function(){
		closeDrawer();
	});


	// FASTCLICK
	FastClick.attach(document.body);


	// NAVIGATION ARROWS
	jQuery('.widget.navigation > ul > li.menu-item-has-children > a, nav.main li.menu-item-has-children > a').each(function(){
		jQuery(this).html(jQuery(this).text() + '<i class="fa fa-chevron-down"></i>');
	});
	
	jQuery('.drawer li.menu-item-has-children > a').live( "click", function(){
		var parent = jQuery(this).parent();
		jQuery('a i', parent).toggleClass('fa-chevron-down');
		jQuery('a i', parent).toggleClass('fa-chevron-up');
		jQuery('.sub-menu', parent).slideToggle();
		return false;
	});

	jQuery('li.menu-item-has-children > a').live( "click", function(){
		if(jQuery(this).attr('href') == "#"){
			return false;
		}
	});


	// COVER SCROLL
	jQuery('.mouse').click(function(){
		jQuery('html, body').animate({
			scrollTop: jQuery(".cover").height()
		}, 1000);
	});


	// BACK TO TOP
	jQuery('.backtotop').click(function(){
		jQuery('html, body').animate({
			scrollTop: 0
		}, 600);
	});


	// SHOW COMMENTS
	if(ecko_theme_vars.general_hidecomments == "1" && window.location.hash == ""){
		jQuery('.commenttitle').html(window.ecko_theme_vars.localization_viewcomments);
		jQuery('.commentitems').hide();
	}

	jQuery('.commentheader, .showcomments').click(function(){
		jQuery('.commentitems').slideDown(500);
		jQuery('.commenttitle').html(window.ecko_theme_vars.localization_comments);
		jQuery('.commentheader').css('cursor', 'default');
		jQuery('html, body').animate({
			scrollTop: jQuery(".commentheader").offset().top
		}, 800);
	});


	// POST FOOTER CONTENT TRANSITION
	jQuery('.postbottom').waypoint(function(direction) {
		if(direction == "down"){
			jQuery('.default').fadeOut(200, function(){
				jQuery('.postinfo .relatedposts').fadeIn(200);
			});
		}
		if(direction == "up"){
			jQuery('.postinfo .relatedposts').fadeOut(200, function(){
				jQuery('.default').fadeIn(200);
			});
		}
	}, { offset:'100%' });


	// POST TITLE OPACITY FADE
	if(jQuery('body.single-post').length > 0 && jQuery( window ).width() > 880){
		if(jQuery('.cover').attr('data-opacity') == "0.2"){
			var header = jQuery('.cover');
			var range = jQuery('.cover').height();
			jQuery( window ).resize(function() {
				header = jQuery('.cover');
				range = jQuery('.cover').height();
			});
			jQuery(window).on('scroll', function () {
				var st = jQuery(this).scrollTop();
				header.each(function () {
					var offset = jQuery(this).offset().top;
					var height = jQuery(this).outerHeight();
					offset = offset + height / 1;
					jQuery('.cover .background').css({ 'opacity': 0.2 + (st - offset + range) / (range / 2) });
					jQuery('.cover .posttitle').css({ 'opacity': 1.0 - (st - offset + range) / (range / 4) });
				});
			});
		}
	}


	// SHOW FOOTER SOCIAL
	jQuery('.showsocial').click(function(){
		jQuery('footer.postinfo .socialoptions').fadeToggle(200);
	});
	jQuery('.closeshare').click(function(){
		jQuery('footer.postinfo .socialoptions').fadeOut(200);
	});

	if(ecko_theme_vars.general_disable_syntax_highlighter != "1"){
		Rainbow.color();
	}

	jQuery(".postcontents, .format-video, .format-audio").fitVids();


	// COVER RESIZE
	function fixIOSViewPort(){
		if(navigator.userAgent.match(/(iPad|iPhone);.*CPU.*OS 7_\d/i)){
			var height = Math.floor(jQuery(window).height() * (jQuery('.cover').attr('data-height') / 100));
			jQuery('.cover').css('height', height);	
		}
	}
	
	if(navigator.userAgent.match(/(iPad|iPhone);.*CPU.*OS 7_\d/i)){
		fixIOSViewPort();
		jQuery(window).resize(function() { fixIOSViewPort(); });
	}


	// SHORTCODE TOGGLE
	jQuery('.shorttoggle .toggleheader').live( "click", function(){
		jQuery(this).siblings( ".togglecontent" ).toggle();
	});


	// SHORTCODE TABS
	jQuery('.shorttabsheader').live( "click", function(){
		jQuery('.shorttabscontent', jQuery(this).parent()).hide();
		jQuery('.shorttabsheader.active', jQuery(this).parent()).removeClass('active');
		jQuery(this).addClass('active');
		jQuery( ".shorttabscontent[data-id='" + jQuery(this).attr('data-id') + "']" ).show();
	});

	jQuery('.shorttabs').each(function(){
		jQuery('.shorttabscontent', this).hide();
		jQuery('.shorttabscontent', this).first().show();
		jQuery('.shorttabsheader', this).first().addClass('active');
	});


});