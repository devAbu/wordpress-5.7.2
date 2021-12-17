"use strict";

(function ($) {
  $(document).ready(function () {
    $('.homepress_property_slider').each(function () {
      $(this).owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        autoplay: true,
        loop: true,
        nav: true,
        dots: false,
        mouseDrag: false
      });
    });
  });
})(jQuery);