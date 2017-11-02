(function($){
  $(function(){
    $(window).on("scroll", scroll);
  });
  function scroll() {
    if ($(window).scrollTop() >= $(window).height()) {
      $("body").addClass("menu-fixed");
    } else {
      $("body").removeClass("menu-fixed");
    }
  }
})(jQuery);
