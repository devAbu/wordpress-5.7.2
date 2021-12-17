"use strict";

(function ($) {
  $(document).ready(function () {
    add_listing_step_back();
  });

  var add_listing_step_back = function add_listing_step_back() {
    $('.add-listing-steps.add-listing-step-two .add-listing-steps-column:first-child').on('click', function () {
      event.preventDefault();
      history.back(1);
    });
  };
})(jQuery);