(function($) {
    
   /* $( "#nextButton" ).click(function() {
        $( ".cal-month-box" ).animate({ "left": "+=50px" }, "slow" );
    });*/
 //  $( "#nextButton" ).click(function() {
//        console.log("toto");
//        $( "#calendar" ).css({"-webkit-transform":"translate(500px)"});
        //.animate({},400);
        /*.animate({  textIndent: 0 }, {
                step: function(now,fx) {
                 $(this).css('-webkit-transform','rotate('+now+'deg)'); 
        },
        duration:'slow'
        },'linear');*/
 //   });
    
    
    
    var calendar = document.getElementById('calendar');
    //console.log(calendar);
    
    var options = {
        dragLockToAxis: true,
        dragBlockHorizontal: true
    };
    
    var hammertime = new Hammer(calendar, options);
    
    //hammertime.get('swipe').set({ direction: Hammer.DIRECTION_HORIZONTAL });
    
//    hammertime.on('swipe', function(ev) {
        //console.log(ev);
        //console.log(ev.velocityX);
//        if (ev.velocityX < 0) // < 0 -> vers la droite
//            $('#prevButton').click();
//        else // > 0 -> vers la gauche
//            $('#nextButton').click();
//    });
    
    hammertime.on("dragleft dragright swipeleft swiperight", function(event){

        console.log(event.deltaX);
        //$('#calendar').animate({translateX: '550px'}, 500);
        //backgroundElement.style.transform = 'translateX(' + event.deltaX + 'px)';
        
        if (event.deltaX < 0) { // < 0 -> vers la droite
            console.log("toto");
            $( "#prevButton" ).click();
            
        }    
            //$('#prevButton').click().transition({ x: "50" }, 200);
        else { // > 0 -> vers la gauche
            console.log("tata");
            $( "#nextButton" ).click();
            
            
            
        }    
            //$('#nextButton').click();
        
    });
}(Zepto));