
/*
 * @build  : 20-05-2015
 * @author : hilbert kruidenier
 * @site   : tw.com
 */
(function($){
 $(".box").css("z-index", '500');
$(".box").css("cursor", 'move');
$( ".box" ).draggable(


{

        helper: function(){
        return $('<div></div>').css('opacity',0);
        },


        drag: function(event, ui){

            $(this).stop().animate({
                top: ui.helper.position().top
            },500,'easeOutCirc');
        }
    }
    );


      
        $(document).ready(function(){ 
                         var minNumberh = -1500; // The minimum number you want
                  var maxNumberh = 2000;         
            $('.box').each(function(){
            
              var pos = $(this).position();
              posL = $(this).css('left'),
                     posT = $(this).css('top');
      
                var tLeft = Math.floor(Math.random() * (maxNumberh + 1) + minNumberh),
                    tTop = Math.floor(Math.random() * (maxNumberh + 1) + minNumberh);
             
                $(this).animate({ "left": tLeft,
              					  "top": tTop,
                },1, "easeInOutCubic");
                        });
        });
      

    
        $(document).ready(function(){
            
                var minNumber = -100; // The minimum number you want
                var maxNumber = 200;         
            $('.box').each(function(){
            
              var pos = $(this).position();
              posL = $(this).css('left'),
                     posT = $(this).css('top');
                       
              $(this).animate({ "left": posL,
              					  "top": posT,
              },800, "easeInOutCubic");
              
            
            });
        });
      
      
      
      
$('.grpelem').mousedown(function(){
			
			var index_highest = 0;
			$('.grpelem').each(function() {
			    
			    var index_current = parseInt($(this).css("zIndex"), 10);
			    if(index_current > index_highest) {
			        index_highest = index_current;
			    }
			});

			$(this).css('z-index',index_highest + 10);

		});
	
		
		

})(jQuery);