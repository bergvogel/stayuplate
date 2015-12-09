
$(document).ready(function(){
   $('#hamburger_menu').click(function(){
       $('#topmenu').slideToggle(100, 'swing');
       $('#header').toggleClass('minus60');
   });
});

$( "#hamburger_menu" ).click(function() {
  	 $(this).toggleClass('hamburger_active');
});



$( "#footer" ).mouseover(function() {
  	 $('.lees').hide();
  	 $('.scroll').show();
});

$( "#footer" ).mouseout(function() {
  	 $('.lees').show();
  	 $('.scroll').hide();
});
