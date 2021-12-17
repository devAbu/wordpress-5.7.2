"use strict";

new Vue({
  el: "#map_location_" + map_location_data.id,
  data: {
    zoom: 10,
    center: {
      address: "",
      lat: 0,
      lng: 0
    },
    markers: [{
      id: "",
      html: "",
      lat: 0,
      lng: 0,
      icon: {
        url: "",
        scaledSize: {
          height: 50,
          width: 50
        }
      }
    }]
  },
  created: function created() {
    if (typeof map_location_data == "undefined") return;
    if (typeof map_location_data.address != "undefined") this.center.address = map_location_data.address;
    if (typeof map_location_data.latitude != "undefined") this.center.lat = Number(map_location_data.latitude);
    if (typeof map_location_data.longitude != "undefined") this.center.lng = Number(map_location_data.longitude);
    if (typeof map_location_data.zoom != "undefined") this.zoom = Number(map_location_data.zoom);
    this.markers[0].id = map_location_data.id;
    this.markers[0].lat = this.center.lat;
    this.markers[0].lng = this.center.lng;

    if (typeof map_location_data.marker != "undefined") {
      this.markers[0].html = map_location_data.marker.html;
      this.markers[0].icon = map_location_data.marker.icon;
    }
  }
});