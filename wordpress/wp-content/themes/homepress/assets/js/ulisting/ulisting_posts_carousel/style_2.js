"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    carousel_style_1();
  });
  $(window).on("resize", function () {
    carousel_style_1();
  });

  var carousel_style_1 = function carousel_style_1() {
    var owl;
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    $('.ulisting_posts_carousel').each(function () {
      var $this = $(this); //Settings

      var desktop = $(this).data('desktop');
      var landscape = $(this).data('landscape');
      var tablet = $(this).data('tablet');
      var mobile_landscape = $(this).data('mobile_landscape');
      var mobile = $(this).data('mobile');
      var nav = $(this).data('nav');
      var dots = $(this).data('dots');
      var loop = $(this).data('loop');
      var stage = $(this).data('stage');
      var owl = $this.owlCarousel({
        rtl: owlRtl,
        stagePadding: stage,
        margin: 0,
        nav: nav,
        dots: dots,
        loop: loop,
        responsive: {
          0: {
            items: mobile
          },
          680: {
            items: mobile_landscape
          },
          1024: {
            items: tablet
          },
          1440: {
            items: landscape
          },
          1920: {
            items: desktop
          }
        },
        navText: ['<span class="property-icon-chevron-left-2"></span>', '<span class="property-icon-chevron-right-2"></span>']
      });
    });
  };
})(jQuery);