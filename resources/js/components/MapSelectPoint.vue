<template>

  <div style="height: 500px; width: 100%">
      <!-- <p v-for="(marker, index) in markers"  v-bind:key="index" :lat-lng="marker">
        ID: {{index}}
        Marker: {{marker}}
      </p>
       -->


    <!-- <div style="height: 300px overflow: auto;">
      <p>First marker is placed at {{ withPopup.lat }}, {{ withPopup.lng }}</p>
      <p>Center is at {{ currentCenter }} and the zoom is: {{ currentZoom }}</p>
      <button @click="showLongText">
        Toggle long popup
      </button>
      <button @click="showMap = !showMap">
        Toggle map
      </button>
    </div> -->
    <l-map
      ref="myMap"
      v-if="showMap"
      :zoom="zoom"
      :center="center"
      :options="mapOptions"
      style="height: 100%"
      @ready="doSomethingOnReady()"
      @update:center="centerUpdate"
      @update:zoom="zoomUpdate"
      @click="addMarker"
    >
      <l-tile-layer
        :url="url"
        :attribution="attribution"
      />
      <l-marker v-for="(marker, index) in markers"  v-bind:key="index" :lat-lng="marker" @click="removeMarker(index)" :ready="updateMarkerEvent()"></l-marker>
      <!-- <l-marker :lat-lng="withPopup">
        <l-popup>
          <div @click="innerClick">
            I am a popup
            <p v-show="showParagraph">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
              sed pretium nisl, ut sagittis sapien. Sed vel sollicitudin nisi.
              Donec finibus semper metus id malesuada.
            </p>
          </div>
        </l-popup>
      </l-marker> -->
    </l-map>
  </div>
</template>

<script>
import L from 'leaflet';
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip, LControl } from "vue2-leaflet";
import { GeoSearchControl, OpenStreetMapProvider, Geocoder } from "leaflet-control-geocoder";
import 'leaflet-control-geocoder/dist/Control.Geocoder.css';


export default {
  name: "Example",
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip
  },
  data() {
    return {
      map: null,
      geocoder: null,
      markerproperties: null,
      zoom: 6.5,
      center: latLng(50.4495092916983, 30.52540755268638),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      markers: [
        L.latLng(50.4495092916983, 30.52540755268638),
        // L.latLng(47.412, -1.218),
        // L.latLng(47.413220, -1.219482),
        // L.latLng(47.414, -1.22),
      ],
      withPopup: latLng(49.83916, 24.03125),
      currentZoom: 11.5,
      currentCenter: latLng(47.41322, -1.219482),
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5
      },
      showMap: true,
    };
  },
  mounted() {
    console.log("Mounted)");
    this.$nextTick(() => {
      let vm = this;
      //L.Control.geocoder().addTo(this.$refs.myMap.mapObject);
      this.geocoder = L.Control.Geocoder.nominatim({
        geocodingQueryParams: {
            "country": "UA",
            "accept-language": "uk_UA"
        },
        reverseQueryParams: {
          "accept-language": "uk_UA"
        }
    });

      var control = L.Control.geocoder({
        query: 'Moon',
        placeholder: 'Search here...',
        showResultIcons: true,
        suggestTimeout: 100,
        defaultMarkGeocode: false,
        geocoder: this.geocoder
      })
      .on('markgeocode', function(e) {
        console.log(e.geocode.center);
        //Only one marker
        vm.removeMarker(0)
        vm.markers.push(e.geocode.center);
      })
      .addTo(this.$refs.myMap.mapObject);

        this.$refs.myMap.mapObject;
      });

      this.updateMarkerEvent()

    //L.Control.Geocoder().addTo(this.myMap);
    

   // console.log(this.$refs.myMap);
    //console.log(L);
  },
  methods: {
    doSomethingOnReady() {
        this.map = this.$refs.myMap
        console.log(this.map)
    },
    updateMarkerEvent(){
      const self = this;
      console.log("Marker Event )")
      if(this.geocoder!=null){
        self.geocoder.reverse(this.markers[0], 10, function(results) {
          var r = results[0];
          self.$emit('cordinate', {
            markers: results[0]
          })

          if (r) {
            console.log(r.properties.address.city)
            if(r.properties.address.city != null){
            }
            // if (marker) {
            //   marker
            //     .setLatLng(r.center)
            //     .setPopupContent(r.html || r.name)
            //     .openPopup();
            // } else {
            //   marker = L.marker(r.center)
            //     .bindPopup(r.name)
            //     .addTo(map)
            //     .openPopup();
            // }
            console.log(r)
            
          }
        });
      }

      
      
    },
    zoomUpdate(zoom) {
      this.currentZoom = zoom;
    },
    centerUpdate(center) {
      this.currentCenter = center;
    },
    showLongText() {
      this.showParagraph = !this.showParagraph;
    },
    innerClick() {
      alert("Click!");
    },
    removeMarker(index) {
      this.markers.splice(index, 1);
    },
    addMarker(event) {
      //Only one marker
      if(this.markers[0] != null){
        this.removeMarker(0)
      }

      this.markers.push(event.latlng);


      // this.$emit('cordinate', {
      //   markers: this.markers,
      // })
    }
  }
};
</script>