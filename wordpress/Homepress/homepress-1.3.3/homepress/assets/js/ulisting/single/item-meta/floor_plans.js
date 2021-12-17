"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    homepress_floor_plans();
  });

  var homepress_floor_plans = function homepress_floor_plans() {
    $(".inventory-accordion_style_3").each(function () {
      $(this).find(".collapse").addClass("show");
    });
  };
})(jQuery);