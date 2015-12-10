


$( "#toggle-menu" ).click(function() {
	
   if ( $(this).hasClass("visible") ) {
		 $( "#topmenu" ).animate({ left: '-100%' },300);
		 $( ".lineup ul" ).delay(300).queue(function(){
    $(this).addClass("menu_item_slide_in").removeClass("menu_item_slide_out").dequeue();
});

}
	else 
   {
	   	 $( ".lineup ul" ).addClass("menu_item_slide_out").removeClass("menu_item_slide_in");
		 $( "#topmenu" ).delay( 300 ).animate({ left: '0%' }, 300);
	}
	return true;
});

    $('#toggle-menu').click(function(){
        $(this).toggleClass('visible').toggleClass('hidden');
    });

 $('#toggle-menu_footer').click(function(){
        $('#topmenu_overlay').slideToggle();
    });
  
  $('.close_menu').click(function(){
        $('#topmenu_overlay').slideToggle();
    });


$('.box').flowtype({
  fontRatio : 1.1
});

$('.lineup').flowtype({
  fontRatio : 7.5
});


$('#topmenu').flowtype({
  fontRatio : 12.5
});

$('.swiper-wrapper_page').flowtype({
  fontRatio : 45
});


$(".box").css("z-index", '500');


$('.box').mouseover(function(){
					var index_highest = 0;
					$('.box').each(function() {
					    var index_current = parseInt($(this).css("zIndex"), 10);
					    if(index_current > index_highest) {
					        index_highest = index_current;
					    }
					});
					$(this).css('z-index',index_highest + 10);
				});

