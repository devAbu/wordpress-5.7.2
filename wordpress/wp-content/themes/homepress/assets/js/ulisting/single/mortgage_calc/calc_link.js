"use strict";

(function ($) {
  $(document).ready(function () {
    $(".mortgage_calc_popup_box .payments-of-month").clone().appendTo(".calc-info-month");
    $(".calc-in-popup").on('click', function () {
      $(this).parents().find(".mortgage_calc_popup_box").addClass("active");
    });
    $(".mortgage_calc_popup_close").on('click', function (event) {
      event.preventDefault();
      $(this).parents().find(".mortgage_calc_popup_box").removeClass("active");
    });
  });
})(jQuery);