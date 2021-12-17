"use strict";

(function ($) {
  $(document).ready(function () {
    $("header [data-elementor-id!=''][data-elementor-id]").each(function () {
      var id = $(this).attr('data-elementor-id');
      sticky(window["hfe_position_".concat(id)]);
    });
  });

  function sticky(settings) {
    var $selector = $('header [data-elementor-id="' + settings['id'] + '"]');
    if (!$selector.length) return false;
    if (settings['header_position'] === 'absolute') $selector.addClass('header-position_absolute');
    if (settings['header_position'] === 'fixed') $selector.addClass('header-position_fixed');
  }
})(jQuery);