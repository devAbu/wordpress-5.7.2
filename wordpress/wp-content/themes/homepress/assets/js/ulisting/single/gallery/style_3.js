"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    carousel_style_3();
  });

  var carousel_style_3 = function carousel_style_3() {
    var owl;
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    owl = $('.listing-gallery_style_3 .listing-gallery-thumbnail').owlCarousel({
      rtl: owlRtl,
      nav: true,
      dots: false,
      loop: false,
      smartSpeed: 990,
      margin: 0,
      responsive: {
        0: {
          items: 1,
          slideBy: 1
        },
        767: {
          items: 2,
          slideBy: 2
        }
      },
      navText: ['<span class="property-icon-chevron-left-2"></span>', '<span class="property-icon-chevron-right-2"></span>']
    });
  };
})(jQuery);