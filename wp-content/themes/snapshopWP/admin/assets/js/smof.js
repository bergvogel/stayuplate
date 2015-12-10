/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function($){
	
	//(un)fold options in a checkbox-group
	jQuery('.fld').click(function() {
		var $fold='.f_'+this.id;
		$($fold).slideToggle('normal', "swing");
	});

	//Color picker
	$('.of-color').wpColorPicker();
	
	//hides warning if js is enabled
	$('#js-warning').hide();
	
	//Tabify Options
	$('.group').hide();
	
	// Display last current tab	
	if ($.cookie("of_current_opt") === null) {
		$('.group:first').fadeIn('fast');
		$('.group:first').find('.of-mini-section:first').slideDown(200);
		$('.group:first').find('.of-section:first, .section-info:first').addClass('of-active');
		$('#of-nav > ul > li:nth-child(2)').addClass('current');
		$('#of-nav > ul > li li:first-child').addClass('current');
		$('#of-nav li:nth-child(2)').children('ul').slideDown(300);

	} else {
		var hooks = $('#hooks').html();
		hooks = jQuery.parseJSON(hooks);

		$.each(hooks, function(key, value) {

			if ($.cookie("of_current_opt") == '#of-option-'+ value) {
				var curr = $('#of-nav li.' + value).attr('data-group');
				$('#of-nav > ul > li[data-group="'+curr+'"]').addClass('current');
				$('#of-nav li[data-group="'+curr+'"] > ul').slideDown(300);
				$('.group#of-option-' + value).fadeIn();
				$('.group#of-option-' + value).find('.of-mini-section:first').slideDown(300);
				$('.group#of-option-' + value).find('.of-section:first, .section-info:first').addClass('of-active');

				$('#' + curr).addClass('current');
				$('#of-nav li.' + value).addClass('current');
			}

		});
	
	}

	//Current Group Class
	$('#of-nav .parent-group a:not([href="#"])').click(function(){

		var par = $(this).parent();
		var curr = par.attr('data-group');

		if ( !par.hasClass('current') ) {
			$('#of-nav > ul > li:not(.current) > ul:visible').slideUp(300);
			$('#of-nav li:not(.current)').removeClass('current');
			par.addClass('current');
			par.children('ul').slideDown(300);
		}
		else {
			par.removeClass('current');
			par.children('ul').slideUp(300);
		}

		return false;

	});

	$('.section-info').click(function(){

		var curr = $(this);
		var par = curr.parent();
		
		if ( !curr.hasClass('of-active') ) {
			curr.next().slideDown();
			curr.addClass('of-active');
			par.addClass('of-active');
		}
		else {
			curr.next().slideUp();
			curr.removeClass('of-active');
			par.removeClass('of-active');
		}

		return false;

	});


	//Current Menu Class
	$('#of-nav li:not(.parent-group) a:not([href="#"])').click(function(){

		$('#of-nav li:not(.parent-group)').removeClass('current');
		$(this).parent().addClass('current');

		var clicked_group = $(this).attr('href');

		$.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });

		$('.group').hide();

		$(clicked_group).fadeIn('fast').addClass('of-active');
		$(clicked_group).find('.of-mini-section:first').addClass('of-active').slideDown(300);
		$(clicked_group).find('.of-section:first, .section-info:first').addClass('of-active');
		return false;

	});

	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		return this;
	}
	$.fn.center_left = function () {
		this.css("left", ( ( $(window).width() - this.outerWidth() - 300 ) / 2 ) );
		return this;
	}

	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();
	$('#of-popup-install').center();
	$('#of-popup-save').center_left();
	$('#of-popup-reset').center_left();
	$('#of-popup-fail').center_left();
	$('#of-popup-install').center_left();

	$(window).scroll(function() { 
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
		$('#of-popup-install').center();
	});
			

	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();
	
	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();

	// Style Select
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$(document).on('change', '.select', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		}); 
		}
	};
	$(document).ready(function () {
		styleSelect.init()
	})
	})(jQuery);
	
	
	/** Aquagraphite Slider MOD */
	
	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide(); 

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(document).on('click', '.slide_edit_button', function(){		
		/*
		//display as an accordion
		$(".slide_header").removeClass("active");	
		$(".slide_body").slideUp("fast");
		*/
		//toggle for each
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});	
	
	// Update slide title upon typing		
	function update_slider_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parent().prev().find('strong').text( element.value );
		}, 100);
		return true;
	}
	
	$(document).on('keyup', '.of-slider-title, .of-slider-language', function(){
		update_slider_title(this);
	});
		
	
	//Remove individual slide
	$(document).on('click', '.slide_delete_button', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this item?");
		if (agree) {
			var $trash = $(this).parents('li');
			if ( $trash.parent().find('li').length == 1 ) {
				confirm("You cannot delete the last item.");
				return false;
			}
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0,
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}	
	});









	//Add new slide
	$(document).on('click', '.slide_add_button', function(){
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');
		
		var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
			var str = this.id; 
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;			
		}).get();
		
		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;
		
		if ( sliderId == 'sidebar' ) {
			var newSlide = '<li class="temphide"><div class="slide_header"><strong>Sidebar ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><a class="button-primary slide_delete_button" href="#">Delete Sidebar</a><div class="clear"></div></div></li>';
		}
		if ( sliderId == 'contact' ) {
			var newSlide = '<li class="temphide"><div class="slide_header"><strong>Contact ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_' + newNum + '_slide_order" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: block;"><div class="slide_comment_image"><label>Image</label><div class="screenshot"></div><input class="upload slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="of-button media_upload_button" id="' + sliderId + '_' + newNum + '">Upload</span><span class="of-button remove-image hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div></div><div class="slide_comment_meta"><label>Name</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][name]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Email</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][email]" id="' + sliderId + '_' + newNum + '_slide_email" value=""><label>Job</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][job]" id="' + sliderId + '_' + newNum + '_slide_phone" value=""><label>Description (optional)</label><textarea class="slide" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea>';
			var newIcons = slidesContainer.find('.of-regular-element:first').html();
			var changedIcons = newIcons.replace(/contact\[1\]/g, 'contact['+ newNum +']');
			var changedIconsNew = changedIcons.replace(/contact\_1/g, 'contact_'+ newNum);
			newSlide += '</div><div class="slide_comment_snetworks"><label>Social Networks</label><div class="of-socials-container">';
			
			newSlide += '<div class="of-regular-element">'+ changedIconsNew +'</div>';
			
			newSlide += '</div><div class="clear"></div><a href="#" class="of-button network_add_button" title="Add Social Network">+ Add Social Network</a><a class="of-button slide_delete_button" href="#" title="Delete Contact">Delete Contact</a><div class="clear"></div></div></div><div class="clear"></div></li>';
		}
		if ( sliderId == 'language' ) {
			var newSlide = '<li class="temphide"><div class="slide_header"><strong>Language ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="language[' + newNum + '][order]" id="language_' + newNum + '_slide_order" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body">';

			var newLng = slidesContainer.find('.select_wrapper:first').html();
			var changedLng = newLng.replace(/language\[1\]/g, 'language['+ newNum +']');
			var changedLngNew = changedLng.replace(/language\_1/g, 'language_'+ newNum);
			newSlide += '<div class="select_wrapper">'+ changedLngNew +'</div>';

			newSlide += '<label>Language</label><input class="slide of-input of-slider-language" name="language[' + newNum + '][language]" id="language_' + newNum + '_slide_language" value="French"><label>Language URL</label><input class="slide of-input of-slider-langurl" name="language[' + newNum + '][langurl]" id="language_' + newNum + '_slide_langurl" value="#"><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		}

		if ( sliderId == 'bf_sidenavico' ) {
			var newSlide = '<li class="temphide"><div class="slide_header"><strong>Icon ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Icon</label><input class="slide of-input of-slider-icon" name="' + sliderId + '[' + newNum + '][icon]" id="' + sliderId + '_' + newNum + '_slide_icon" value=""><label>URL</label><input class="slide of-input of-slider-url" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		}
		
		slidesContainer.append(newSlide);
		var nSlide = slidesContainer.find('.temphide');
		nSlide.fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});

		optionsframework_file_bindings(); // re-initialise upload image..

		return false; //prevent jumps, as always..
	});



	//Social Networks icons

	$(document).on('change', '.socialnetwork-select', function() {
		var curr = $(this).parent().prev().prev().prev();
		var new_icon = curr.attr('src');
		var new_url = new_icon.replace( new_icon.substring( new_icon.lastIndexOf('/')+1), $(this).val() );
		curr.attr('src', new_url);
	});


	//Duplicate Social Networks
	$(document).on('click', '.network_add_button', function() {

		var duplicateContent = $(this).parent().find('.of-regular-element:first').html();

		var curr = $(this).prev().prev();
		console.log(curr.attr('class'));
		curr.append('<div class="of-regular-element">'+duplicateContent+'</div>');
		objectId = $(this).parent().find('.socialnetwork').length;

		setObjectInput = curr.find('.of-regular-element:last .socialnetwork');
		setObjectSelect = curr.find('.of-regular-element:last select');

		var changeNameInput = setObjectInput.attr('name');
		var changeNameSelect = setObjectSelect.attr('name');

		var changedNameInput = changeNameInput.replace('[contact][1]','[contact]['+ objectId +']');
		var changedNameSelect = changeNameSelect.replace('[contact][1]','[contact]['+ objectId +']');

		setObjectInput.attr('name', changedNameInput);
		setObjectSelect.attr('name', changedNameSelect);

		return false;
	});



	$(document).on('click', '.network_delete_button', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this item?");
		if (agree) {
			var $trash = $(this).parent();
			if ( $trash.parent().find('.of-regular-element').length == 1 ) {
				confirm("You cannot delete the last item.");
				return false;
			}
			$trash.animate({
					opacity: 0.25,
					height: 0,
				}, 500, function() {
					$(this).remove();
			});
			return false;
		} else {
		return false;
		}	
	});











	//Sort slides
	jQuery('.slider').find('ul').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).sortable({
			placeholder: "placeholder",
			opacity: 0.6,
			handle: ".slide_header",
			cancel: "a"
		});	
	});
	
	
	/**	Sorter (Layout Manager) */
	jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {
				
					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
					
				});
			}
		});	
	});
	
	
	/**	Ajax Backup & Restore MOD */
	//backup button
	$(document).on('click', '#of_backup_button', function(){
	
		var answer = confirm("Click OK to backup your current saved options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
				//check nonce
				if(response==-1){ //failed
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
							
				else {
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				}

			});
			
		}
		
	return false;
					
	}); 
	
	//restore button
	$(document).on('click', '#of_restore_button', function(){
	
		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
				security: nonce
			};
						
			$.post(ajaxurl, data, function(response) {
			
				//check nonce
				if(response==-1){ //failed
								
					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}
							
				else {
							
					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}	
						
			});
	
		}
	
	return false;
					
	});
	
	/**	Ajax Transfer (Import/Export) Option */
	$(document).on('click', '#of_import_button', function(){
	
		var answer = confirm("Click OK to import options.")
		
		if (answer){
	
			var clickedObject = $(this);
			var clickedID = $(this).attr('id');
					
			var nonce = $('#security').val();
			
			var import_data = $('#export_data').val();
		
			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};
						
			$.post(ajaxurl, data, function(response) {
				var fail_popup = $('#of-popup-fail');
				var success_popup = $('#of-popup-save');
				
				//check nonce
				if(response==-1){ //failed
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();                        
					}, 2000);
				}		
				else 
				{
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				}
							
			});
			
		}
		
	return false;
					
	});
	
	/** AJAX Save Options */
	$(document).on('click', '#of_save', function() {
			
		var nonce = $('#security').val();
					
		$('.ajax-loading-img').fadeIn();
		
		//get serialized data from all our option fields			
		var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();
						
		var data = {
			type: 'save',
			action: 'of_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};
					
		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			var loading = $('.ajax-loading-img');
			loading.fadeOut();  
						
			if (response==1) {
				success.fadeIn();
			} else { 
				console.log(response);
				fail.fadeIn();
			}
						
			window.setTimeout(function(){
				success.fadeOut(); 
				fail.fadeOut();				
			}, 2000);
		});
			
	return false; 
					
	});   
	
	
	/* AJAX Options Reset */	
	$('#of_reset').click(function() {
		
		//confirm reset
		var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");
		
		//ajax reset
		if (answer){
			
			var nonce = $('#security').val();
						
			$('.ajax-reset-loading-img').fadeIn();
							
			var data = {
			
				type: 'reset',
				action: 'of_ajax_post_action',
				security: nonce,
			};
						
			$.post(ajaxurl, data, function(response) {
				var success = $('#of-popup-reset');
				var fail = $('#of-popup-fail');
				var loading = $('.ajax-reset-loading-img');
				loading.fadeOut();  
							
				if (response==1)
				{
					success.fadeIn();
					window.setTimeout(function(){
						location.reload();                        
					}, 1000);
				} 
				else 
				{ 
					fail.fadeIn();
					window.setTimeout(function(){
						fail.fadeOut();				
					}, 2000);
				}
							

			});
			
		}
			
	return false;
		
	});

	//Remove individual slide
	$(document).on('click', 'div.of-lo-element', function(){
		var curr = $(this).attr('data-element');
		$('.group:not(#of-option-layoutoverview)').fadeOut('fast');
		$('.group[data-element="'+curr+'"]').fadeIn('fast');

		return false;

	});


	/* EXTENSION AJAX Demo Install */	
	$('.snpshpwp-install-demo-layout').click(function() {
		var curr = $(this);

		//confirm reset
		var answer = confirm("CAUTION! This will install the SnapShopWP theme demo content you've selected! Make sure you've successfully completed previous stepes and you're installing the demo content on a clean Wordpress installation! If you have any posts/pages/content, they will get replaced with the demo posts!");

		//ajax reset
		if (answer){
			var curr_theme = ( $('#ss_install_theme').prop('checked') ? 'yes' : 'no' );
			var curr_images = ( $('#ss_install_images').prop('checked') ? 'yes' : 'no' );
			var curr_pages = ( $('#ss_install_pages').prop('checked') ? 'yes' : 'no' );

			var load_popup = $('#of-popup-install');
			load_popup.fadeIn();

			var nonce = $('#security').val();

			var data = {
				type: 'demo_install',
				action: 'of_ajax_post_action',
				style: curr.attr('data-demo'),
				theme: curr_theme,
				images: curr_images,
				pages: curr_pages,
				security: nonce
			};
			$.post(ajaxurl, data, function(response) {

				if (response==1)
				{
					alert("SnapShopWP Demo Content you've selected has been installed successfully! Have fun!");
					window.setTimeout(function(){
						load_popup.fadeOut();
						location.reload();
					}, 1000);
				}
				else
				{ 
					alert('Demo installation has failed! Contact us at support.shindiristudio.com or via email support@shindiristudio.com to help you with the installation.')
					window.setTimeout(function(){
						load_popup.fadeOut();
					}, 2000);
				}
			});
		}
	return false;
	});


	/* EXTENSION AJAX Demo Remove */	
	$('#demo_remove').click(function() {
		
		//confirm reset
		var answer = confirm("CAUTION! This will remove the Demo Installation tab from the Theme Options!");
		
		//ajax reset
		if (answer){
			var nonce = $('#security').val();
						
			$('.ajax-reset-loading-img').fadeIn();
							
			var data = {
				type: 'demo_remove',
				action: 'of_ajax_post_action',
				security: nonce,
			};
			$.post(ajaxurl, data, function(response) {
				var loading = $('.ajax-reset-loading-img');
				loading.fadeOut();
							
				if (response==1)
				{
					alert('Tab removed!');
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				} 
				else 
				{ 
					alert('Failed.')
					window.setTimeout(function(){
						fail.fadeOut();
					}, 2000);
				}
			});
		}
	return false;
	});


	/**	Tipsy @since v1.3 */
	if (jQuery().tipsy) {
		$('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.7,
		});
	}
	
	
	/**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery('.smof_sliderui').each(function() {
		
		var obj   = jQuery(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));
		
		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			range: "min",
			slide: function( event, ui ) {
				jQuery(sId).val( ui.value );
			}
		});
		
	});


	/**
	  * Switch
	  * Dependencies 	 : jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery(".cb-enable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-disable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', true);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideDown('normal', "swing");
	});
	jQuery(".cb-disable").click(function(){
		var parent = $(this).parents('.switch-options');
		jQuery('.cb-enable',parent).removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('.main_checkbox',parent).attr('checked', false);
		
		//fold/unfold related options
		var obj = jQuery(this);
		var $fold='.f_'+obj.data('id');
		jQuery($fold).slideUp('normal', "swing");
	});
	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if (($.browser.msie && $.browser.version < 10) || $.browser.opera) { 
		$('.cb-enable span, .cb-disable span').find().attr('unselectable', 'on');
	}
	
	
	/**
	  * Google Fonts
	  * Dependencies 	 : google.com, jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	function GoogleFontSelect( slctr, mainID ){
		
		var _selected = $(slctr).val(); 						//get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';
		
		if( _selected ){ //if var exists and isset
			
			//Check if selected is not equal with "Select a font" and execute the script.
			if ( _selected !== 'none' && _selected !== 'Select a font' ) {
				
				//remove other elements crested in <head>
				$( '.'+ _linkclass ).remove();
				
				//replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');
				
				//add reference to google font family
				$('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
				
				//show in the preview box the font
				$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );
				
			}else{
				
				//if selected is not a font remove style "font-family" at preview box
				$('.'+ _previewer ).css('font-family', '' );
				
			}
		
		}
	
	}
	
	//init for each element
	jQuery( '.google_font_select' ).each(function(){ 
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});
	
	//init when value is changed
	jQuery( '.google_font_select' ).change(function(){ 
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});


	/**
	  * Media Uploader
	  * Dependencies 	 : jquery, wp media uploader
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 05.28.2013
	  */
	function optionsframework_add_file(event, selector) {
	
		var upload = $(".uploaded-file"), frame;
		var $el = $(this);

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),

			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: $el.data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: false
			}
		});

		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			frame.close();
			selector.find('.upload').val(attachment.attributes.url);
			if ( attachment.attributes.type == 'image' ) {
				selector.find('.screenshot').empty().hide().append('<img class="of-option-image" src="' + attachment.attributes.url + '">').slideDown('fast');
			}
			selector.find('.media_upload_button').unbind();
			selector.find('.remove-image').show().removeClass('hide');//show "Remove" button
			selector.find('.of-background-properties').slideDown();
			optionsframework_file_bindings();
		});

		// Finally, open the modal.
		frame.open();
	}
    
	function optionsframework_remove_file(selector) {
		selector.find('.remove-image').hide().addClass('hide');//hide "Remove" button
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind();
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.media_upload_button').remove();
		}
		optionsframework_file_bindings();
	}
	
	function optionsframework_file_bindings() {
		$('.remove-image, .remove-file').on('click', function() {
			optionsframework_remove_file( $(this).parents('.section-upload, .section-media, .slide_body') );
		});

		$('.media_upload_button').unbind('click').click( function( event ) {
			optionsframework_add_file(event, $(this).parents('.section-upload, .section-media, .slide_body'));
		});
	}

	optionsframework_file_bindings();

	
	$('#snpshpwp_admin_logo a').click(function(){ return false;});

}); //end doc ready