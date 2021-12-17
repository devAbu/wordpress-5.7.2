"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    carousel_style_5();
  });

  var carousel_style_5 = function carousel_style_5() {
    var owl;
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    owl = $('.listing-gallery_global_carousel .listing-gallery-thumbnail').owlCarousel({
      rtl: owlRtl,
      items: 1,
      center: true,
      nav: true,
      dots: false,
      loop: false,
      margin: 0,
      responsive: {
        0: {
          stagePadding: 0
        },
        768: {
          stagePadding: 100
        },
        1024: {
          stagePadding: 200
        },
        1200: {
          stagePadding: 250
        }
      },
      navText: ['<span class="property-icon-chevron-left-2"></span>', '<span class="property-icon-chevron-right-2"></span>']
    });
  };
})(jQuery);