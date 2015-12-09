
$( "#menu_button_box" ).click(function() {
  	 $('#main').toggleClass('main_open').toggleClass('main_close');
});

$(function() {
if ($(".main_close")[0]){
} else {
		      $('#main').addClass('main_close');

}
});

	$('.menu_button_box_close').click(function(){
    $('#hamburger').toggleClass('menuclose').toggleClass('menuopen');
    $(this).toggleClass('menu_button_box_close').toggleClass('menu_button_box_open');
  });


