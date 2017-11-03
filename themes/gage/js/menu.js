(function($){
  var menu_top = 0;
  $(function(){
    menu_top = $(".layout-top").position().top;
    $(window).on("scroll", scroll);
  });
  function scroll() {
    if ($(window).scrollTop() >= menu_top) {
      $("body").addClass("menu-fixed");
    } else {
      $("body").removeClass("menu-fixed");
    }
  }
})(jQuery);
