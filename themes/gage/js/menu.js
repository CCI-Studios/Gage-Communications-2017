(function($){
  var menu_top = 0;
  $(function(){
    $(".menu-button").on("click", menuBtn);
    $(window).on("scroll", scroll);
    $(window).on("resize", resize);
    resize();
  });
  function scroll() {
    if ($(window).scrollTop() >= menu_top) {
      $("body").addClass("menu-fixed");
    } else {
      $("body").removeClass("menu-fixed");
    }
  }
  function resize() {
    $("body").removeClass("menu-fixed");
    menu_top = $(".layout-top").position().top;
    scroll();
  }
  function menuBtn() {
    $("body").toggleClass("menu-open");
    return false;
  }
})(jQuery);
