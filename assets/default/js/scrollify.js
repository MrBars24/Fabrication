(function($) {

  $.fn.scrollify = function(options) {
    var settings = $.extend({
      before() {
      },
      triggered() {

      },
      offset: 5,
      reverse: false,
      targetChild: '.scrollable-wrapper',
    }, options);

    this.on('scroll', function() {
      // run the before function
      settings.before();
      // Get the Parent
      var parent =  $(this);
      var scrollable = $(this).find(settings.targetChild)

      if (!settings.reverse) {
        var reachedBottom = false;
        // Get the div with .scrollable-wrapper class inside the parent
        var scrollableBottom = scrollable.offset().top + scrollable.height();
        var parentBottom = parent.offset().top + parent.height();
        // Determine if we scroll to the bottom of notification
        if( (scrollableBottom  - settings.offset) < parentBottom && !reachedBottom) {
          settings.triggered();
        }
      }
      else {
        var scrollableTop = scrollable.offset().top;
        var parentTop = parent.offset().top;

        if( (scrollableTop  + settings.offset) > parentTop ) {
          settings.triggered();
        }
      }

    });
  };

  $.fn.scrollToBottom = function(){
    if (this[0].scrollHeight == undefined) {
      return;
    }
      this.scrollTop(this[0].scrollHeight);
  }

}(jQuery))
