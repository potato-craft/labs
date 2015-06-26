(function($){

  $.fn.sidescroll=function(options){
    var defaults={
      
    };
    var options=$.extend(defaults, options);
    
    return this.each(function(){
      
      obj = $(this);
      obj.addClass("redjacket-sidescroller");
      
      $(window).load(function(){
        
        $('.redjacket-sidescroller img').on('dragstart', function(event){event.preventDefault();});
        
        $(".redjacket-sidescroller .item").css({'float':'left'});
        
        var width=0;
        $(".redjacket-sidescroller .item").each(function(){
          width=width+$(this).outerWidth(true);
        });

        $(".redjacket-sidescroller .item-wrapper").css({'width':width});

        $(".redjacket-sidescroller .arrow.left").on('mouseenter touchstart',function(){
          var left=$(".redjacket-sidescroller .scroller").scrollLeft();
          $(".redjacket-sidescroller .scroller").stop().animate({scrollLeft:'-='+left}, left*5, 'linear');
        });
        $(".redjacket-sidescroller .arrow.left").on('mouseleave touchend',function(){
          $(".redjacket-sidescroller .scroller").stop();
        });
        
        $(".redjacket-sidescroller .arrow.right").on('mouseenter touchstart',function(){
          var right=$(".redjacket-sidescroller .item-wrapper").outerWidth()-$(".scroller").scrollLeft();
          $(".redjacket-sidescroller .scroller").stop().animate({scrollLeft:'+='+right}, right*5, 'linear');
        });
        $(".redjacket-sidescroller .arrow.right").on('mouseleave touchend',function(){
          $(".redjacket-sidescroller .scroller").stop();
        });
        
      });
      
      
        
      
     //end of return 
    });
    
  };
  
})(jQuery);
