"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    social_share_style_7();
  });

  var social_share_style_7 = function social_share_style_7() {
    $('body').on('click', function () {
      $('.listing-share').removeClass('active');
    });
    $('.listing-share').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
    });
    $('.listing-share a').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).parent().toggleClass('active');
    });
  };
})(jQuery);