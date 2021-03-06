"use strict";

window.onload = function () {
  var map_full_height_panel = document.getElementsByClassName("map-full-height-panel");

  if (typeof map_full_height_panel[0] != "undefined") {
    var stm_listing_map_custom = map_full_height_panel[0].getElementsByClassName("stm-listing-map-custom");
    if (typeof stm_listing_map_custom[0] != "undefined") stm_listing_map_custom[0].className = stm_listing_map_custom[0].className + " full-height";
  }

  setTimeout(function () {
    set_height();
  }, 100);
};

window.onresize = function () {
  setTimeout(function () {
    set_height();
  }, 100);
};

function set_height() {
  var elements = document.getElementsByClassName("full-height");

  for (var i = 0; i < elements.length; i++) {
    var rect = elements[i].getBoundingClientRect();

    if (window.innerWidth < 993) {
      elements[i].removeAttribute("style");
    } else {
      elements[i].setAttribute("style", "height:calc(100vh - " + rect.top + "px)");
    }
  }
}