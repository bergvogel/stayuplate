sym.$( ".box" ).draggable({

        helper: function(){
        return $('<div></div>').css('opacity',0);
        },


        drag: function(event, ui){

            $(this).stop().animate({
                top: ui.helper.position().top
            },500,'easeOutCirc');
        }
    });


		 $(document).ready(function(){
    var h = $(document).height()*3;
    var w = $(document).width()*2;            
    $('#Stage .box').each(function(){
        var originalOffset = $(this).position(),
            $this = $(this),
           tLeft = w-Math.floor(Math.random()*1200),
           tTop  = h-Math.floor(Math.random()*1200);


        $(this).hide().animate({"left": tLeft , "top": tTop},400, "easeInOutCubic",function(){
                           $this.show().animate({
                               "left": originalOffset.left, 
                               "top": originalOffset.top
                           },800, "easeInOutCubic");

                        });        
    });
});


