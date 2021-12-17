"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    carousel_style_1();
  });

  var carousel_style_1 = function carousel_style_1() {
    var owl;
    var owlRtl = false;

    if ($('body').hasClass('rtl')) {
      owlRtl = true;
    }

    var parent_class = $(".listing-gallery_global_carousel").parent().parent();
    parent_class.children().map(function (key, list_gal) {
      var list_gal_class = '.' + $(list_gal).attr('class').trim();
      owl = owl_gallery(owlRtl, owl, list_gal);
      list_click(owl, list_gal);
    });
  };

  function list_click(owl, list_gal) {
    var list_gal_class = '.' + $(list_gal).attr('class').trim();
    $(list_gal_class + ' .listing-gallery-list').on('click', list_gal_class + ' .item', function (e) {
      owl.trigger('to.owl.carousel', [$(this).index(), 300]);
    });
    $(list_gal_class + ' .listing-gallery-list .item').each(function () {
      var count = $(this).attr('data-count');
      var hidden_items = $(list_gal_class + ' .listing-gallery-list .item.hidden-items a');

      if (count) {
        $(this).find('a').append('<span class="count">' + count + '</span>');
        $(hidden_items).append('<span class="count">' + count + '</span>');
      }
    });
  }

  function owl_gallery(owlRtl, owl, list_gal) {
    var list_gal_class = '.' + $(list_gal).attr('class').trim();
    owl = $(list_gal).find(' .listing-gallery_global_carousel .listing-gallery-thumbnail').owlCarousel({
      rtl: owlRtl,
      items: 1,
      center: true,
      nav: true,
      dots: true,
      loop: false,
      animateOut: 'fadeOut',
      margin: 0,
      dotsContainer: list_gal_class + ' .listing-gallery-list .row',
      navText: ['<span class="property-icon-chevron-left-2"></span>', '<span class="property-icon-chevron-right-2"></span>']
    });
  }
})(jQuery);