(function($){
  $.fn.rjoverlay = function(options) { // $.fn.[plugin-name]
    
    var defaults = {
     width: "100%",
     height: "100%",
     fadeLength: "400",
     fadeStyle: "linear"
    };

    var options = $.extend(defaults, options);
      
    return this.each(function() {
      obj = $(this);
      

      obj.click(function(e){
        e.preventDefault();
        var href=this.href;
        console.log("href: "+href+" set");
        buildOverlay(href);
      });

      return obj;
     
    });//end return

    function buildOverlay(href){
      if(!$('body').hasClass('rj-overlay-active')){
        $('body').addClass('rj-overlay-active');
        $('<div class="rj-overlay-screen"><div class="rj-overlay-wrapper"></div></div>').appendTo('body').hide().fadeIn(options.fadeLength, function(){
          loadFrame(href);
        });
        $('.rj-overlay-wrapper').on('click touchend', function(e){
          e.stopPropagation();
        });
        
        centerOverlay();
        
        $('body').on('click touchend', '.rj-overlay-screen', function(){
          removeOverlay();
        });
        
      }
    }

    function centerOverlay(){
      center();
      $(window).on('resize', function(){
          center();
      });
      
      function center(){
        var outer=$('.rj-overlay-screen').height();
        var inner=$('.rj-overlay-wrapper').height();
        var extra=outer-inner;
        if(extra>0){
          $('.rj-overlay-wrapper').css('margin-top', extra/2);
        }
      }
      
    }
    
    function removeOverlay(){
      $('.rj-overlay-screen').fadeOut(options.fadeLength, function(){
        $(this).remove();
        $('body').removeClass('rj-overlay-active');
      });
    }
    
    function loadFrame(href){
      href=preprocessLink(href);
      $('.rj-overlay-wrapper').append('<iframe src="'+href+'" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>');
    }
    
    function preprocessLink(href){
      console.log("href: "+href);
      if(href.indexOf("youtube.com")>=0){
        return href.replace("watch", "embed");
      }
      if(href.indexOf("vimeo.com")>=0){
        return href.replace("vimeo.com", "player.vimeo.com/video");
      }
      if(href.indexOf("dailymotion.com")>=0){
        var i=href.indexOf('_');
        if(i>=0){
          href=href.substring(0, i);
          console.log(href);
        }
        return href.replace("/video", "/embed/video");
      }
      return href;
    }

    $(window).unload(function(){ 
      $.off();
    });

  };
})(jQuery);
