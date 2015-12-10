var snpshpwp_pratio;
var snpshpwp_tratio;
var snpshpwp_sratio;

var navActive = true;

(function($){
"use strict";
	
	/*loader*/
	var imgLoad = imagesLoaded('#snpshpwp_content');
	var curr_step = Math.round(100/imgLoad.images.length);
	var curr_img = 1;

	var c_width = $('#snpshpwp_loader_bar').width();
	var c_parent = $('#snpshpwp_loader_bar').offsetParent().width();
	var c_percent = 100*c_width/c_parent;

	imgLoad.on( 'progress', function( instance, image ) {
		var progress = c_percent + ( ( 100 - c_percent ) * curr_img * curr_step ) / 100;
		$('#snpshpwp_loader_bar').css({ width: ( progress <= 100 ? progress : '100' ) + '%' });
		curr_img++;
	});

	var currentLoad = $('#snpshpwp_loader');
	imgLoad.on( 'always', function() {
		if ( snpshpwp.loader == '0' ) {
			TweenLite.to(currentLoad, 0.33, {height:0, delay: 1, onComplete: function(){
					currentLoad.hide();
				}
			});
		}
		else {
			currentLoad.hide();
		}
	});



	/*newsletter*/

	$(document).on('click', 'a#snpshpwp_newsletter_close', function(){

		var curr = $(this).parent().parent();

		TweenLite.to(curr, 0.33, {scale:0, onComplete: function(){
				curr.remove();
			}
		});

		return false;
	});


	/*search categories*/
	$(document).on('click', 'a#snpshpwp_srch_slct_trggr', function(){

		var curr = $(this);
		var par = curr.next();

		if( curr.hasClass('snpshpwp_active') ) {
			par.stop(true,true).fadeOut(200);
			curr.removeClass('snpshpwp_active');
		}
		else{
			curr.addClass('snpshpwp_active')
			par.stop(true,true).fadeIn(200);
		}

		return false;
	});

	$(document).on('click', '.snpshpwp_product_cats a', function(){
		
		var curr = $(this);
		var par = curr.parents().eq(1);

		par.find('a').removeClass('snpshpwp_active');

		curr.addClass('snpshpwp_active');

		var curr_attr = curr.attr('data-cat');

		par.prev().text(curr.text()).removeClass('snpshpwp_active');
		par.next().val(curr_attr);
		par.fadeOut(200);

		return false;
	});




	$(document).on('mouseenter', 'ul.products li.product .button', function() {
		if ( !$(this).hasClass('snpshpwp_active') ) {
			$(this).addClass('snpshpwp_active');
		}
	});
	$(document).on('mouseout', 'ul.products li.product .button', function() {
		if ( $(this).hasClass('snpshpwp_active') ) {
			$(this).removeClass('snpshpwp_active');
		}
	});


	/* Menu Backgrounds */
	
	$('#snpshpwp_header .snpshpwp_menu img').each( function() {

		var curr_bg_src = $(this).attr('src');
		var curr_bg_pos = $(this).attr('data-position');
		curr_bg_pos = curr_bg_pos.split('-');

		var curr_bg_prnt = $(this).parent();
		var curr_bg = $(this).next().next();
		var curr_bg_cnt = curr_bg.children('li').length;

		curr_bg_prnt.addClass('snpshpwp_menu_bg_active');

		curr_bg.css({
			'width':220*(curr_bg_cnt),
			'background-image':'url('+curr_bg_src+')'
		});
		if ( curr_bg_pos[0] == 'left' ) {
			curr_bg.css({
				'padding-left':128,
				'background-position':'left center',
			});
		}
		else if ( curr_bg_pos[0] == 'right' ) {
			curr_bg.css({
				'padding-right':128,
				'background-position':'right center',
			});
		}
		else if ( curr_bg_pos[0] == 'pattern' ) {
			curr_bg.css({
				'background-position':'center center',
			});
		}
		if ( curr_bg_pos[1] == 'portraid' ) {
			curr_bg.css({
				'background-size':'auto 100%'
			});
		}
		else if ( curr_bg_pos[1] == 'landscape' ) {
			curr_bg.css({
				'background-size':'100% auto'
			});
		}
		else if ( curr_bg_pos[1] == 'repeat' ) {
			curr_bg.css({
				'background-repeat':'repeat'
			});
		}
		else if ( curr_bg_pos[1] == 'full' ) {
			curr_bg.css({
				'background-size':'100% 100%'
			});
		}
		$(this).remove();

	});

	/* Scrolling Sidebars */
	var wooImages = false;

	function scrollingSidbars() {
		var curr_s = $('#snpshpwp_content .snpshpwp_sidebar_wrapper, #snpshpwp_content .summary');

		var curr_one_in = $('#snpshpwp_content .summary').height();
		var curr_two_in = $('#snpshpwp_content .snpshpwp_sidebar_wrapper').height();

		var curr_h_in = ( curr_one_in >= curr_two_in ? curr_one_in : curr_two_in ) + hHeight + hHeight + adminbar;

		if ( curr_h_in > wHeight ) {
			curr_s.each(function() {
				$(this).css('padding-top', 0);
			});
			return;
		}

		if ( wooImages === false ) {
			wooImages = $('#snpshpwp_inner_content .images.fbuilder_column').height();
		}
		
		var curr_one = $('#snpshpwp_content .summary').outerHeight();
		var curr_two = $('#snpshpwp_content .snpshpwp_sidebar_wrapper').outerHeight();

		var curr_h = ( curr_one >= curr_two ? curr_one : curr_two );


		if ( ( curr_h > wooImages && currentDirection == 'down' ) ) {
			return;
		}

		var curr_t = $(window).scrollTop();

		curr_s.each(function() {

			var curr_e = $('#snpshpwp_content .snpshpwp_sidebar_wrapper').offset().top;
			var curr_p = parseInt($(this).css('padding-top'),10);


			if ( curr_e < curr_t+hHeight+adminbar && currentDirection == 'down' ) {
				$(this).css('padding-top', curr_t+hHeight+adminbar-curr_e);
			}
			else if ( currentDirection == 'up' && ( curr_e+curr_p ) > curr_t ) {
				$(this).css('padding-top', curr_t+hHeight+adminbar-curr_e);
			}

		})
	}

	$(window).scroll(function(){
		if ( $('body').hasClass('single-product') ) {
			scrollingSidbars();
		}
	});

	/*Pjax*/
	$(document).pjax('a[href^="'+snpshpwp.siteurl+'"]:not([href*="#"]):not([href*="/?"]):not(.snpshpwp_responsive #snpshpwp_header .snpshpwp_nav li.menu-item-has-children a):not(.snpshpwp_element_login-link > a):not(#wpadminbar a)', '#snpshpwp_wrapper');

	$(document).on('pjax:send', function() {
		var currentBar = $('#snpshpwp_loader_bar');
		currentBar.css({ 'width':'1px' });

		var currentLoad = $('#snpshpwp_loader');
		currentLoad.show();
		if ( snpshpwp.loader == '0' ) {
			TweenLite.to(currentLoad, 0.33, {height:'100%', onComplete: function(){
				currentBar.css({ 'width':'10%' });
				}
			});
		}
		else {
			currentBar.css({ 'width':'10%' });
		}

	})
	$(document).on('pjax:complete', function() {
		$('#snpshpwp_loader_bar').css({ 'width':'12.5%' });
	})


	/*Smooth Scroll Anchor*/
	$(document).on('click', 'a.snpshpwp_scroll_to, .snpshpwp_scroll_to > a', function() {
		var target = $(this).attr('href');
		var current = $($(this).attr('href'));

			var offset = current.offset().top-adminbar;
			var top = $(document).scrollTop();
			var offseted = Math.abs(top-offset)/100;
			var speed = ((1/offseted*100)*(1.25*offseted))/100;
			TweenLite.to(window, speed, {scrollTo:{y: offset, x:0}, ease:Quint.easeInOut});

		return false;
	});


	/* Language Bar */
	$(document).on('click', 'a.language_selected', function(){

		var curr_lang = $(this).html();
		var curr = $(this).closest('.snpshpwp_element_language-bar');
		var sel_lang = curr.find('a.language_selected').html();
		var curr_ul = curr.find('ul');

		if(!curr.hasClass('snpshpwp_active')){
			curr.addClass('snpshpwp_active');
			curr_ul.stop(true).fadeIn(100);
		}
		else{
			curr.removeClass('snpshpwp_active');
			curr_ul.stop(true).fadeOut(100);
		}

		return false;
	});

	$(document).on('click', '.snpshpwp_element_language-bar ul li a', function(){

		var curr = $(this).closest('.snpshpwp_element_language-bar');
		var curr_lang = curr.find('a.language_selected').html();
		var sel_lang = $(this).html();

		if( curr_lang !== sel_lang ) {
			curr.find('a.language_selected span').html(sel_lang);
		}

	});

	/* Element Quick View */
	var ajaxLoading = false;
	$(document).on('click', 'a.snpshpwp_quick_view', function(){
		"use strict";

		if ( $('#snpshpwp_woo_quickview').length == 1 ) {
			$('#snpshpwp_woo_quickview').remove();
		}

		if ( ajaxLoading ) {
			return false;
		}

		ajaxLoading = true;

		var currId = $(this).attr('data-product');

		var data = {
			action: 'snpshpwp_woo_quickview',
			product_id: currId
		};

		jQuery.post(snpshpwp.ajaxurl, data, function(snpshpwp_response) {
			if (snpshpwp_response) {
				$('body').addClass('snpshpwp_qv_active').append(snpshpwp_response);
				var curr_wrap = $('#snpshpwp_woo_quickview');

				curr_wrap.find('.snpshpwp_quickview_slide img').each(function(){

					var curr_w = $(this).attr('width');
					var curr_h = $(this).attr('height');
					
					if ( curr_w >= curr_h ) {
						var curr_margin = -(400*curr_w/curr_h-300)/2;
						$(this).css({height:'400px', width:'auto', marginLeft:curr_margin});
					}
					else {
						$(this).css({height:'auto', width:'300px', marginTop:curr_margin});
					}

				});


				var curr_swiper = curr_wrap.find('.snpshpwp_quickview_slider_wrap').swiper({
					mode:"horizontal",
					loop: true,
					slidesPerView: 1,
					resizeReInit : true,
					wrapperClass : "snpshpwp_quickview_slider",
					slideClass: "snpshpwp_quickview_slide",
					preventLinks : true,
					preventLinksPropagation : true
				});

				ajaxLoading = false;
			} else { 
				alert('fail');
				ajaxLoading = false;
			}
		});
		return false;
	});

	$(document).on('click', 'a.snpshpwp_quickview_close', function(){
		$('body').removeClass('snpshpwp_qv_active');
		$('#snpshpwp_woo_quickview').remove();
		return false;
	});

	var wHeight = $(window).height();
	var wWidth = $(window).width();
	var hHeight = $('#snpshpwp_header').outerHeight();



	$(document).on('click', '#snpshpwp_sdnv_right, #snpshpwp_sdnv_left', function(){
		var curr_nav = $(this).attr('data-navigation');
		var curr_pos = $(this).attr('data-position');
		var curr = $(this).parent();

		var curr_el = $('#snpshpwp_header .snpshpwp_responsive_trigger.snpshpwp_active');

		if ( curr_el.length ) {
			curr_el.removeClass('snpshpwp_active');
			if ( curr_el.parents().eq(1).hasClass('snpshpwp_top_left') ) {
				TweenLite.to(curr_el.prev(), 0.2, {left:'-320px', ease:Linear.easeNone});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, right:0, ease:Linear.easeNone});
			}
			else {
				TweenLite.to(curr_el.prev(), 0.2, {right:'-320px', ease:Linear.easeNone});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, right:0, ease:Linear.easeNone});
			}
		}


		if ( !curr.hasClass('snpshpwp_active') ) {
			curr.addClass('snpshpwp_active');
			$('#'+curr_nav).show();
			if ( curr_pos == 'left') {
				TweenLite.to($('#'+curr_nav), 0.2, {opacity: 1, left:0});
				TweenLite.to($('#snpshpwp_content'), 0.2, { right:'-320px', ease:Linear.easeNone});
			}
			else {
				TweenLite.to($('#'+curr_nav), 0.2, {opacity: 1, right:0});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:'-320px', ease:Linear.easeNone});
			}
		}
		else {
			curr.removeClass('snpshpwp_active');
			if ( curr_pos == 'left') {
				TweenLite.to($('#'+curr_nav), 0.2, {left:'-320px'});
				TweenLite.to($('#snpshpwp_content'), 0.2, { right:0, ease:Linear.easeNone});
			}
			else {
				TweenLite.to($('#'+curr_nav), 0.2, {right:'-320px'});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, ease:Linear.easeNone});

			}
		}

		return false;

	});







	var nav = $('#snpshpwp_header ul.snpshpwp_menu');


	function is_touch_device() {
		return !!('ontouchstart' in window);
	}

	function over( elem ) {
		if ( $(elem).parents().is('.snpshpwp_menu_bg_active.snpshpwp_active') ) {
			return false;
		}

		var parent = $(elem).closest( 'li' );
		var liHeight = $(elem).outerHeight();

		if ( parent.find('ul:hidden').length ) {
			var curr_offset = parent.offset().left+parent.outerWidth()+parent.children( 'ul:hidden' ).outerWidth();
			if ( curr_offset > wWidth ) {
				parent.addClass('snpshpwp_menu_offset');
			}
			console.log(curr_offset);
		}


		out( parent );
		parent.addClass( 'snpshpwp_active' );
		parent.children( 'ul:hidden' ).css({top : '100%'}).fadeIn( 100 );
	};

	function out( elem ) {
		if ( $(elem).parents().is('.snpshpwp_menu_bg_active.snpshpwp_active') ) {
			return false;
		}

		var parents = elem ? $(elem).closest( 'li' ).siblings() : nav.children();

		parents.removeClass( 'snpshpwp_active' );
		if ( parents.hasClass('snpshpwp_menu_offset') ) {
			parents.removeClass('snpshpwp_menu_offset')
		}
		parents.find('li.menu-item.snpshpwp_active').removeClass( 'snpshpwp_active' );
		parents.find('ul.sub-menu').fadeOut( 100 );

	};



		if ( is_touch_device() === false ) {
			nav.on('mouseover', function(e){
				if ( navActive === false ) return;
				nav.doTimeout( 'menu-item', 100, over, e.target );
				return false;

			}).on('mouseout', function(){
				if ( navActive === false ) return;
				nav.doTimeout( 'menu-item', 300, out );
				return false;
			});
		}
		else {
			nav.on('touchstart', function(e){
				if ( navActive === false ) return;
				var curr = $(e.target).closest('li');
				if ( !curr.hasClass('snpshpwp_nav_activated') ) {
					curr.addClass('div_nav_activated');
					nav.doTimeout( 'menu-item', 100, over, e.target );
					return false;
				}

			});
		}


	$(document).on('click', '.snpshpwp_responsive #snpshpwp_header .snpshpwp_nav li.menu-item-has-children a', function(e){
		if ( e.pageX - $(this).offset().left > $(this).parent().width() - 32 ) {
			if ( !$(this).parent().hasClass('snpshpwp_active') ) {
				$(this).parent().addClass('snpshpwp_active');
				$(this).next().slideToggle(200);
				return false;
			}
			else {
				$(this).parent().removeClass('snpshpwp_active');
				$(this).next().slideToggle(200);
				return false;
			}
		}
		else {
			if ( $(this).is('[href*="#"]') ) {
				$(this).next().slideToggle(200);
				return false;
			}
			$.pjax.click(e, '#snpshpwp_wrapper');
			return false;
		}
	});






	/* document ready */
	var adminbar = 0;
	$(document).ready(function(){
		if($('#wpadminbar').length > 0) { adminbar = $('#wpadminbar').outerHeight(); }
		$('#snpshpwp_sdnv_left_bar, #snpshpwp_sdnv_right_bar').children(':first').outerHeight(wHeight-hHeight-36-adminbar);

		snpshpwp_set_responsive();

	});


	var headerLeftW = $('#snpshpwp_header .snpshpwp_top_left').width();
	var headerRightW = $('#snpshpwp_header .snpshpwp_top_right').width();
	var headerW = headerLeftW + headerLeftW;

	/* window resize */
	$(window).resize( function(){

		headerLeftW = $('#snpshpwp_header .snpshpwp_top_left').width();
		headerRightW = $('#snpshpwp_header .snpshpwp_top_right').width();
		headerW = headerLeftW + headerLeftW;
		wHeight = $(window).height();
		wWidth = $(window).width();

		if( $('#wpadminbar').length > 0 ) { adminbar = $('#wpadminbar').outerHeight(); }

		$('#snpshpwp_sdnv_left_bar, #snpshpwp_sdnv_right_bar').children(':first').outerHeight(wHeight-hHeight-adminbar);

		snpshpwp_set_responsive();

	});


	$(document).on('click', '#snpshpwp_header a.snpshpwp_responsive_trigger', function(){

		var curr_pos = $(this).attr('data-position');
		var curr_nav = $(this).prev();


		if ( !$(this).hasClass('snpshpwp_active') ) {
			$(this).addClass('snpshpwp_active');

			if ( $('#snpshpwp_sdnv_left').parent().hasClass('snpshpwp_active') ) {
				$('#snpshpwp_sdnv_left').parent().removeClass('snpshpwp_active');

				TweenLite.to($('#snpshpwp_sdnv_left_bar'), 0.2, {left:'-320px', ease:Linear.none});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, right:0, ease:Linear.none});

			}

			if ( $('#snpshpwp_sdnv_right').parent().hasClass('snpshpwp_active') ) {
				$('#snpshpwp_sdnv_right').parent().removeClass('snpshpwp_active');

				TweenLite.to($('#snpshpwp_sdnv_right_bar'), 0.2, {right:'-320px'});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, right:0});

			}

			curr_nav.show();

			if ( curr_pos == 'left') {
				TweenLite.to(curr_nav, 0.2, {left:0, onComplete: function(){		}});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:'320px'});
			}
			else {
				TweenLite.to(curr_nav, 0.2, {right:0});
				TweenLite.to($('#snpshpwp_content'), 0.2, { right:'320px'});
			}

		}
		else {
			$(this).removeClass('snpshpwp_active');

			if ( curr_pos == 'left') {
				TweenLite.to(curr_nav, 0.2, {left:'-320px'});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, right:0, onComplete: function(){		}});
			}
			else {
				TweenLite.to(curr_nav, 0.1, {right:'-320px'});
				TweenLite.to($('#snpshpwp_content'), 0.2, { left:0, right:0});
			}

		}
		return false;
	});

	function snpshpwp_set_responsive() {

		if (window.matchMedia('(max-width: '+snpshpwp.content_width+'px)').matches ) {
			if ( !$('body').hasClass('snpshpwp_responsive') ) {
				$('body').addClass('snpshpwp_responsive');
				navActive = false;
				$('#snpshpwp_header ul.snpshpwp_menu').outerHeight(wHeight-hHeight-adminbar-36);
			}
		}
		else {
			if ( $('body').hasClass('snpshpwp_responsive') ) {
				$('body').removeClass('snpshpwp_responsive');
				navActive = true;
				$('#snpshpwp_header ul.snpshpwp_menu').removeAttr('style');
				$('#snpshpwp_header .snpshpwp_nav').removeAttr('style');
			}
		}

		if ( window.matchMedia('(max-width: '+snpshpwp.content_width_mobile+'px)').matches ) {
			if ( !$('body').hasClass('snpshpwp_mobile_responsive') ) {
				$('body').addClass('snpshpwp_mobile_responsive');
				$('#snpshpwp_header .snpshpwp_header_elements.snpshpwp_mode_default .snpshpwp_responsive_logo').css({'left':headerLeftW, 'right':headerRightW});
				$('#snpshpwp_sdnv_left_bar, #snpshpwp_sdnv_right_bar, #snpshpwp_header ul.snpshpwp_menu').height($('#snpshpwp_wrapper').outerHeight()-hHeight-adminbar);

			}
		}
		else {
			if ( $('body').hasClass('snpshpwp_mobile_responsive') ) {
				$('#snpshpwp_header .snpshpwp_responsive_logo').removeAttr('style');
				$('body').removeClass('snpshpwp_mobile_responsive');

			}
		}

	}


	$(document).on('click', 'a.snpshpwp_cartcont', function(){

		var curr = $(this).closest('.snpshpwp_element_woo-cart');

		if( curr.hasClass('snpshpwp_active') ) {
			$('#snpshpwp_woocart').stop(true,true).fadeOut(200);
			curr.removeClass('snpshpwp_active');
		}
		else{
			snpshpwp_remove_active();
			curr.addClass('snpshpwp_active')
			$('#snpshpwp_woocart').css({right: 0}).stop(true,true).fadeIn(200);
		}

		return false;
	});

	$(document).on('click', '.snpshpwp_element_login-link > a[href="#"]', function(){
		var curr = $(this).parent();

		if ( $('.snpshpwp_login_element').length ) {
			if ( !curr.hasClass('snpshpwp_active') ) {
				snpshpwp_remove_active();
				curr.addClass('snpshpwp_active')
				curr.find('.snpshpwp_login_element').stop(true,true).fadeIn(200);
			}
			else if ( curr.hasClass('snpshpwp_active') ) {
				curr.find('.snpshpwp_login_element').stop(true,true).fadeOut(200);
				curr.removeClass('snpshpwp_active');
			}
			return false;
		}

	});

	$(document).on('click', '#snpshpwp_srch_trggr', function(){
		var curr = $(this).parent();

		if ( !curr.hasClass('snpshpwp_active') ) {
			snpshpwp_remove_active();
			curr.addClass('snpshpwp_active');
			curr.find('.snpshpwp_srch_bx').fadeIn();
		}
		else {
			curr.find('.snpshpwp_srch_bx').fadeOut();
			curr.removeClass('snpshpwp_active');
		}

		return false;

	});


	function snpshpwp_remove_active() {
		$('#snpshpwp_header .snpshpwp_active:not(.snpshpwp_element_sidenav)').each( function() {
			$(this).find('div:first').stop(true,true).fadeOut(200);
			$(this).removeClass('snpshpwp_active');
		});
	}






window.snpshpwpHorisontalTabsFlag = [];
var $root = $('html, body');
var stickyFlag = false;
var headHeig;
var winScr = 0;
var marginTop = 0;
var menuWrap = 0;
var fullHeadHeig = 0;
var divTouchOptimizedStart;
var GridSliderStorage = [];
var GridResponsiveStorage = [];
var gridSliderResizeTimer;
var divSliderPosiitonMark, divSliderPosiitonMarkNew;
var numberOfSlides = [];
var numberOfSlidesFormated = [];
var resizeTimer;
var swipeboxInstance;
var entranceId = [], $divPortItem;

if ( $('#snpshpwp_favicon').length > 0 ) {
	var faviconsrc = $('#snpshpwp_favicon').attr('href');
}
else {
	faviconsrc = 'none';
}

if ( $('.team_member_module').length > 0) {
	var w = $(this).find('.snpshpwp_getheight:first').attr('width');
	var h = $(this).find('.snpshpwp_getheight:first').attr('height');
	snpshpwp_tratio = w/h;
}

var resizeItems;



	var fav_timer;
	
	

	$(document).on('click', '.add_to_cart_button', function(){

		var $this = $(this);



					setTimeout( function() {

						
						// create the notification
						var notification = new NotificationFx({
							message : '<i class="snpshp-wp-bag"></i><p>Your item has been added to cart. Go to checkout!</p>',
							layout : 'attached',
							effect : 'bouncyflip',
							type : 'notice',
							ttl : 2000
						});

						// show the notification
						notification.show();
						if ( $('.snpshpwp_element_woo-cart').length ) {
							var curr_offset = $('.snpshpwp_element_woo-cart').offset().left-282;
						}
						else {
							var curr_offset = 0;
						}
						$('.ns-attached').css({left:curr_offset, top:adminbar+$('#snpshpwp_header').outerHeight()});

					}, 500 );




		fav_timer = setInterval(function(){

			if ( !$this.hasClass('loading') ) {
				if ( faviconsrc != 'none' ) {
					var shop_canvas = document.createElement('canvas');
					var ctxw, ctxrw, counter;
					var counter = $('#woocart-trigger .snpshpwp_cartico').text();

					if ( counter < 10 ) {
						ctxw = 10;
						ctxrw = 6;
					}
					else {
						ctxw = 4;
						ctxrw = 12;
					}
					
					shop_canvas.width = 16;shop_canvas.height = 16;
				    var ctx = shop_canvas.getContext('2d');
				    var img = new Image();

				    img.src = faviconsrc;
				    img.onload = function() {
				        ctx.drawImage(img, 0, 0, 16, 16);
				        ctx.fillStyle = "#F00";
				        ctx.fillRect(ctxw, 6, ctxrw, 8);
				        ctx.fillStyle = '#FFFFFF';
				        ctx.font = 'bold 10px sans-serif';
				        ctx.fillText($('#snpshpwp_header .snpshpwp_wciw .snpshpwp_cartico').text(), ctxw, 13);

				        var link = document.createElement('link');
				        link.type = 'image/x-icon';
				        link.rel = 'shortcut icon';
				        link.href = shop_canvas.toDataURL("image/x-icon");
				        document.getElementsByTagName('head')[0].appendChild(link);
				    }
				}
				clearInterval(fav_timer);
			}
			
		}, 200);
	});

	$(document).on('click', '#snpshpwp_port_close', function(){
		var currentPort = $('#snpshpwp_quickview');
		TweenLite.to(currentPort, 0.3, {scale:0, opacity:0, onComplete: function(){
				currentPort.remove();
			}
		});
		$('body').removeClass('snpshpwp_quickview_active');
		return false;
	});

	if ( snpshpwp.video_bg != 'none' ) {
		var atts = {
			mute : ( snpshpwp.video_mute == 1 ? true : false ),
			loop : ( snpshpwp.video_loop == 1 ? true : false ),
			hd : ( snpshpwp.video_hd == 1 ? true : false )
		};
		fbuilderYoutube( "snpshpwp_page_bg_inner", snpshpwp.video_bg, atts );
	}

	/*$("a[rel^='prettyPhoto']").click(function() { return false; }); // Adds another click event
	$("a[rel^='prettyPhoto']").off('click');
	$("a[rel^='prettyPhoto']").on('click.mynamespace', function() {});
	$("a[rel^='prettyPhoto']").off('click.mynamespace');


	$("a[data-rel^='prettyPhoto']").attr('rel', 'lightbox');
	$("a[rel^='prettyPhoto']").attr('rel', 'lightbox');*/


	$('.blog_content iframe').each(function(){
		var url = $(this).attr("src");
		$(this).attr("src",url+"?wmode=transparent");
	});


	winScr = $(window).scrollTop();

	menuWrap = $('nav.menu_wrapper').outerHeight();

	headHeig = $('.header_wrapper').outerHeight();

	fullHeadHeig = headHeig + adminbar;

	if ( $('body').hasClass('page-template-template-onepage-php') === false ) {
		$('#snpshpwp_wrapper').css({'padding-top' : headHeig});
	}
	snpshpwpHeader();






var tempScrollTop, currentScrollTop = 0, currentDirection = 'down';

$(window).scroll(function(){

	currentScrollTop = $(window).scrollTop();

	if (tempScrollTop > currentScrollTop ) {
		currentDirection = 'up';
	}
	else if (tempScrollTop < currentScrollTop ){
		currentDirection = 'down';
	}

	tempScrollTop = currentScrollTop;

	winScr = $(window).scrollTop();
	


	if( winScr > fullHeadHeig ) {
		stickyFlag = true;
		headHeig = $('.header_wrapper').outerHeight();
		$('.header_wrapper .snpshpwp_top').removeAttr('style');

	}
	else {
		stickyFlag = false;
	}
	snpshpwpHeader();

});

/*	if ( $(window).width() < 961 ) {
		if ( $('.header_wrapper').hasClass('sticky-header') ) {
			$('.header_wrapper').css('padding-top', 0).removeClass('sticky-header');
		}
		return;
	}*/

function snpshpwpHeader(){
	if(stickyFlag === true){
		if(!$('.header_wrapper').hasClass('sticky-header')){

			$('.header_wrapper').css({'top' : -headHeig}).addClass('sticky-header');

			if($('.header_wrapper').hasClass('sticky-header')){
				$('.header_wrapper').stop(true).animate({'top' : adminbar}, 300);
			}
		}
	}
	else {
		if($('.header_wrapper').hasClass('sticky-header')){

			$('.header_wrapper').children('div').each(function(){
				$(this).removeClass('element-to-be-hidden');
			});

			$('.header_wrapper').css({top : 0}).removeClass('sticky-header');
		}
	}
}


//			Grid Position Measurement

var gridSlider = new Array();
var snpshpwpSlider = new Array();
var snpshpwpSliderWidthReference = new Array();

$(document).ready(function(){


	$(window).resize(function(){


		fullHeadHeig = $('.header_wrapper').outerHeight() + adminbar;

		headHeig = $('.header_wrapper').outerHeight();
		menuWrap = $('nav.menu_wrapper').outerHeight();

	});


$(document).ready(function(){

if ( $('#snpshpwp_header .snpshpwp_wciw .snpshpwp_cartico').text() != '0' && faviconsrc !== 'none' ) {
		var shop_canvas = document.createElement('canvas');
			var ctxw, ctxrw, counter;
			var counter = $('#snpshpwp_header .snpshpwp_wciw .snpshpwp_cartico').text();
			if ( counter < 10 ) {
				ctxw = 10;
				ctxrw = 6;
			}
			else {
				ctxw = 4;
				ctxrw = 12;
			}
			shop_canvas.width = 16;shop_canvas.height = 16;
			var ctx = shop_canvas.getContext('2d');
			var img = new Image();

			img.src = faviconsrc;
			img.onload = function() {
				ctx.drawImage(img, 0, 0, 16, 16);
				ctx.fillStyle = "#F00";
				ctx.fillRect(ctxw, 6, ctxrw, 8);
				ctx.fillStyle = '#FFFFFF';
				ctx.font = 'bold 10px sans-serif';
				ctx.fillText($('#snpshpwp_header .snpshpwp_wciw .snpshpwp_cartico').text(), ctxw, 13);

				var link = document.createElement('link');
				link.type = 'image/x-icon';
				link.rel = 'shortcut icon';
				link.href = shop_canvas.toDataURL("image/x-icon");
				document.getElementsByTagName('head')[0].appendChild(link);
			}
	}



//			snpshpwp slider
	$('.snpshpwp_slider_wrapper').each( function(ind) {
		var $this = $(this);
		$this.addClass('snpshpwp_slider_'+ind).children('.snpshpwp_slider_content').addClass('snpshpwp_slider_content_'+ind).children('.separate-slider-column').addClass('separate-slider-column_'+ind);
		numberOfSlides[ind] = parseInt($this.attr('data-slides'));

		snpshpwpSliderWidthReference[ind] = 280;
	
		
		numberOfSlidesFormated[ind] = ( numberOfSlides[ind] < Math.floor($this.width()/(snpshpwpSliderWidthReference[ind])) ) ? numberOfSlides[ind] : Math.floor($this.width()/(snpshpwpSliderWidthReference[ind]));
		var wrapSel = 'snpshpwp_slider_content_'+ind;
		var slideSel = 'separate-slider-column_'+ind;
		var itemHeight = ($this.width()/numberOfSlidesFormated[ind])/snpshpwp_pratio;
		$this.height(itemHeight).find('.snpshpwp_slider_content, .separate-slider-column').height(itemHeight);
		
		snpshpwpSlider[ind] = $('.snpshpwp_slider_'+ind).swiper({
		    createPagination : false,
		    wrapperClass : wrapSel,
		    slideClass : slideSel,
		    loop:true,
		    grabCursor: true,
		    loopedSlides : 6,
		    slidesPerView : numberOfSlidesFormated[ind]
		  });
		  
	});
});



});



$(document).ready(function(){

$(document).on('focus', 'select[name="contactEmailSend"]', function() {
	$(this).parent().addClass('snpshpwp_tc_border');
});
$(document).on('blur', 'select[name="contactEmailSend"]', function() {
	$(this).parent().removeClass('snpshpwp_tc_border');
});



$(document).on('click', '.snpshpwp_element_to-the-top a', function() {
	var top = $(document).scrollTop();
	var offseted = Math.abs(top)/100;
	var speed = ((1/offseted*100)*(1.25*offseted))/100;
	TweenLite.to(window, speed, {scrollTo:{y: 0, x:0}, ease:Quint.easeInOut});
	return false;
});


//	Input Field Clear

	
		$('input.snpshpwp_inpt').focus(function(){
			if (!$(this).hasClass('collected')) {
			$(this).attr('data-val', $(this).val());
			$(this).addClass('collected');
			$(this).val('');
			} else {
				if ($(this).val() === $(this).attr('data-val')) {
				$(this).val('');
				}
			}

		});
		$('input.snpshpwp_inpt').focusout(function(){
			if ($(this).val() === '') {
				$(this).val($(this).attr('data-val'));
			}
		
		});


//	Textarea Field Clear

		$('textarea.textarea_field').focus(function(){
			if (!$(this).hasClass('collected')) {
				$(this).attr('data-val', $(this).html());
				$(this).addClass('collected');
				$(this).html('');
				} else {
					if ($(this).html() === $(this).attr('data-val')) {
						$(this).html('');
					}
				}
		});
		$('textarea.textarea_field').focusout(function() {
				if ($(this).html() === '') {
					$(this).html($(this).attr('data-val'));
					}	
			

		});



//			team member module

	$(document).on('mouseenter', '.team_member_module', function(){
		$(this).addClass('snpshpwp_mousee');
	});
	$(document).on('mouseleave', '.team_member_module', function(){
		$(this).removeClass('snpshpwp_mousee');
	});

	$(document).on('mouseenter', 'ul.products li.product', function(){
		$(this).addClass('snpshpwp_mousee');
		return false;
	});
	$(document).on('mouseleave', 'ul.products li.product', function(){
		$(this).removeClass('snpshpwp_mousee');
		return false;
	});

	$(document).on('mouseenter', '.snpshpwp_div_featarea', function(){
		$(this).addClass('snpshpwp_mousee');
		return false;
	});
	$(document).on('mouseleave', '.snpshpwp_div_featarea', function(){
		$(this).removeClass('snpshpwp_mousee');
		return false;
	});

});   // document.ready END

$(window).resize(function(){

	clearTimeout(resizeItems);
	resizeItems = setTimeout(function(){


		if ( $('.team_member_module').length > 0) {
			$('.team_member_module').find('.img_wrapper').each(function(){
				$(this).css('min-height', $(this).width()/snpshpwp_tratio+'px');
			});

			$('.team_member_module').find('.snpshpwp_chover').each( function() {
				var cph = $(this).find('div.snpshpwp_relativw').height()+24;
				$(this).height(cph);
			});
		}

	}, 200);

});
//		portfolio columns

$(document).ready(function(){


	if ( $('.team_member_module').length > 0) {

		$(this).find('.img_wrapper').each(function(){
			$(this).css('height', $(this).width()/snpshpwp_tratio+'px');
		});

		$(this).find('.snpshpwp_chover').each( function() {
			var cph = $(this).find('div.snpshpwp_relativw').height();
			$(this).height(cph);
		});

	}


});



$(document).on('refresh','.fbuilder_module', function(){

	if ( $(this).find('.team_member_module').length > 0) {
		$(this).find('.team_member_module .snpshpwp_chover').each( function() {
			var cph = $(this).find('div.snpshpwp_relativw').height()+24;
			$(this).height(cph);
		});
	}

});


})(jQuery);


	// Ajax Load
	var ajaxLoading = false;
	function snpshpwp_ajaxload(currentItem) {
		"use strict";
		if ( ajaxLoading ) {
			return false;
		}

		ajaxLoading = true;

		var nav = currentItem.parents().eq(2);
		var oldItem = nav.prev();

		oldItem.parent().parent().css({'overflow': 'hidden'});
		var string = oldItem.attr('data-string');
		var shortData = oldItem.attr('data-shortcode').split('|');
		var stringClass = oldItem.attr('class');

		var direction = ( currentItem.hasClass('next') ? 'next' : 'previous' );
		var ajaxPage = currentItem.children('.snpshpwp_page').text();

		if ( stringClass.indexOf('snpshpwp_blog') >= 0 ) {
			var stringClassType = stringClass.replace('snpshpwp_blog ', '');
			var actionSend = 'snpshpwp_ajaxload_send';
		}
		else {
			return false;
		}


		var data = {
			action: actionSend,
			page: ajaxPage,
			type: stringClassType,
			data: string,
			ajax: 'yes',
			excerpt: shortData[0],
			columns: shortData[1],
			align: shortData[2],
			pagination: shortData[3],
			show_category: shortData[4],
			show_date: shortData[5],
			show_author: shortData[6],
			show_comments: shortData[7],
		};

		jQuery.post(snpshpwp.ajaxurl, data, function(response) {
			if (response) {

				var content = response.split('@@@!SPLIT!@@@');

				var margin = oldItem.find('.fbuilder_column').css('border-left-width');
				var width = oldItem.width() + 2*parseInt(margin, 10);

				nav.remove();
				oldItem.before(content[0]);
				oldItem.after(content[1]);

				var newItem = oldItem.next();

				if ( direction == 'next' ) {
					newItem.css({'position': 'absolute', 'width': 'inherit', 'left': width.toString()+'px', 'top': 0 });
					newItem.show();

					var imgLoad = imagesLoaded( newItem );

					imgLoad.on( 'always', function() {
						var new_h = newItem.height();
						TweenLite.to(oldItem, 0.5, {left: '-='+width.toString(), height: new_h, onComplete: function(){
							oldItem.remove();
						}});

						TweenLite.to(newItem, 0.5, {left: '-='+width.toString(), onComplete: function(){
							newItem.css({'position': 'relative', 'left': '0', 'top': '0'});
							ajaxLoading = false;
						}});
					});

				}
				else {
					newItem.css({'position': 'absolute', 'width': 'inherit', 'left': '-'+width.toString()+'px', 'top': 0 });
					newItem.show();

					var imgLoad = imagesLoaded( newItem );

					imgLoad.on( 'always', function( instance ) {
						var new_h = newItem.height();
						TweenLite.to(oldItem, 0.5, {left: width.toString(), height: new_h, onComplete: function(){
							oldItem.remove();
						}});
						TweenLite.to(newItem, 0.5, {left: 0, height: new_h, onComplete: function(){
							newItem.css({'position': 'relative', 'left': '0', 'top': '0'});
							ajaxLoading = false;
						}});
					});

				}
				
				//		swipebox
				var newItemMod = newItem.find('.fbuilder_module');
				newItemMod.trigger('refresh');
			
			} else {
				alert('fail');
			}
		});
	}


	// Ajax Load
	var ajaxLoading = false;
	function snpshpwp_ajaxload_send_woo(currentItem) {

		if ( ajaxLoading ) {
			return false;
		}
		ajaxLoading = true;
		"use strict";
		var nav = currentItem.parents().eq(2);

		var oldItem = nav.prev();

		oldItem.parent().parent().parent().css({'overflow': 'hidden'});
		var string = oldItem.parent().attr('data-string');
		
		var shortData = oldItem.parent().attr('data-shortcode').split('|');

		var direction = currentItem.attr('class');

		var ajaxPage = currentItem.children('.snpshpwp_page').text();

		var data = { 
			action: 'snpshpwp_ajaxload_send_woo',
			page: ajaxPage,
			data: string,
			bot_margin: shortData[0],
			columns: shortData[1],
			pagination: shortData[2],
			ajax: shortData[3]
		};

		jQuery.post(snpshpwp.ajaxurl, data, function(response) {
			if (response) {
				var content = response.split('@@@!SPLIT!@@@');
				var margin = oldItem.find('.fbuilder_column').css('border-left-width');
				margin = margin.replace('px','');
				var width = oldItem.width() + 2*parseInt(margin, 10);
				nav.remove();
				oldItem.before(content[1]);
				oldItem.after(content[0]);
				var newItem = oldItem.next();
				if ( direction.indexOf('next') >= 0 ) {
					newItem.css({'position': 'absolute', 'width': 'inherit', 'left': width.toString()+'px', 'top': '0'});
					newItem.show();

					var imgLoad = imagesLoaded( newItem );

					imgLoad.on( 'always', function() {
						var new_h = newItem.height();
						c = newItem.find('.linked_image_buttons');
						c.height(c.find('.linked_image_buttons_inner').height());

						TweenLite.to(oldItem, 0.5, {left: '-='+width.toString(), height: ( new_h === 0 ? 'auto' : new_h ), onComplete: function(){
							oldItem.remove();
						}});
						TweenLite.to(newItem, 0.5, {left: '-='+width.toString(), onComplete: function(){
							newItem.css({'position': 'relative', 'left': '0', 'top': '0'});
							ajaxLoading = false;
						}});
						jQuery('body').animate({
							scrollTop: newItem.offset().top - 208
						});
					});
				}
				else {
					newItem.css({'position': 'absolute', 'width': 'inherit', 'left': '-'+width.toString()+'px', 'top': '0'});
					newItem.show();

					var imgLoad = imagesLoaded( newItem );

					imgLoad.on( 'always', function() {
						var new_h = newItem.height();
						c = newItem.find('.linked_image_buttons');
						c.height(c.find('.linked_image_buttons_inner').height());

						TweenLite.to(oldItem, 0.5, {left: width.toString(), height: ( new_h === 0 ? 'auto' : new_h ), onComplete: function(){
							oldItem.remove();
						}});

						TweenLite.to(newItem, 0.5, {left: 0, onComplete: function(){
							newItem.css({'position': 'relative', 'left': '0', 'top': '0'});
							ajaxLoading = false;
						}});
						jQuery('body').animate({
							scrollTop: newItem.offset().top - 208
						});
					});
				}
			} else { 
				alert('fail');
			}
		});
	}

	// Ajax Load
	var ajaxLoading = false;
	function snpshpwp_ajaxload_send_woo_cat(currentItem) {

		if ( ajaxLoading ) {
			return false;
		}
		ajaxLoading = true;
		"use strict";
		var nav = currentItem.parents().eq(4);
		var oldItem = nav.next();

		oldItem.parent().parent().parent().css({'overflow': 'hidden'});
		
		var shortData = oldItem.parent().attr('data-shortcode').split('|');

		var direction = currentItem.attr('class');

		var ajaxPage = currentItem.children('.snpshpwp_page').text();

		var data = {
			action: 'snpshpwp_ajaxload_send_woo_cat',
			page: ajaxPage,
			ajax: 'yes',
			bot_margin: shortData[0],
			columns: shortData[1],
			per_page: shortData[2],
			order: shortData[3],
			orderby: shortData[4],
			ids: shortData[5]
		};

		jQuery.post(snpshpwp.ajaxurl, data, function(response) {
			if (response) {
				var margin = oldItem.find('.fbuilder_column').css('border-left-width');
				margin = margin.replace('px','');
				var width = oldItem.width() + 2*parseInt(margin, 10);
				nav.remove();
				oldItem.after(response);
				var newItem = oldItem.next();
				if ( direction.indexOf('next') >= 0 ) {

					var imgLoad = imagesLoaded( newItem );

					imgLoad.on( 'always', function() {
						newItem.css({'position': 'absolute', 'width': 'inherit', 'left': width.toString()+'px', 'top': '0'});
							newItem.show();
							TweenLite.to(oldItem, 0.5, {left: '-='+width.toString(), onComplete: function(){
								oldItem.remove();
							}});
							TweenLite.to(newItem, 0.5, {left: '-='+width.toString(), onComplete: function(){
								newItem.css({'position': 'relative', 'left': '0', 'top': '0'});
								ajaxLoading = false;
							}});
							jQuery('body').animate({
								scrollTop: newItem.offset().top - 208
						});
					});
				}
				else {
					var imgLoad = imagesLoaded( newItem );

					imgLoad.on( 'always', function() {
						newItem.css({'position': 'absolute', 'width': 'inherit', 'left': '-'+width.toString()+'px', 'top': '0'});
						newItem.show();
						TweenLite.to(oldItem, 0.5, {left: width.toString(), onComplete: function(){
							oldItem.remove();
						}});

						TweenLite.to(newItem, 0.5, {left: 0, onComplete: function(){
							newItem.css({'position': 'relative', 'left': '0', 'top': '0'});
							ajaxLoading = false;
						}});
						jQuery('body').animate({
							scrollTop: newItem.offset().top - 208
						});
					});
				}
			} else {
				alert('fail');
			}
		});
	}



/*
 * jQuery doTimeout: Like setTimeout, but better! - v1.0 - 3/3/2010
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);