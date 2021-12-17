"use strict";

(function ($) {
  "use strict";

  $(document).ready(function () {
    homepress_google_full();
  });

  var homepress_google_full = function homepress_google_full() {
    $('.gallery-data-location').each(function () {
      var id = 'gallery-map';
      var lat = $(this).attr('data-lat');
      var lng = $(this).attr('data-lng');
      var icon = $(this).attr('data-icon');
      var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 8
      };
      $(".gallery-view").on("click", function () {
        $(".listing-gallery-auxiliary-buttons > div").removeClass("active");
        $(this).addClass("active");
        $(this).parents().find(".listing-gallery").removeClass("map-view-active");
      });
      $(".map-view").on("click", function () {
        $(".listing-gallery-auxiliary-buttons > div").removeClass("active");
        $(this).addClass("active");
        $(this).parents().find(".listing-gallery").addClass("map-view-active");
        var map = new google.maps.Map(document.getElementById(id), mapOptions);
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(lat, lng),
          map: map,
          icon: {
            url: icon,
            scaledSize: {
              height: 40,
              width: 40
            }
          }
        });
        marker.setMap(map);
        return false;
      });
      $(".street-view").on("click", function () {
        $(".listing-gallery-auxiliary-buttons > div").removeClass("active");
        $(this).addClass("active");
        $(this).parents().find(".listing-gallery").addClass("map-view-active");
        var map = new google.maps.Map(document.getElementById(id), mapOptions);
        var panoramaOptions = {
          position: new google.maps.LatLng(lat, lng),
          pov: {
            heading: 34,
            pitch: 10,
            zoom: 1
          }
        };
        var panorama = new google.maps.StreetViewPanorama(document.getElementById(id), panoramaOptions);
        map.setStreetView(panorama);
        return false;
      });
    });
  };
})(jQuery);