<template>

    <div>
        <div class="form-group ">
            <label for="mapLocation">Location - Street name and city</label>
            <input type="text" class="form-control" id="mapLocation" placeholder="" v-model="searchText"
                   @change="geocode()">
        </div>
        <!--TODO: add different inputs for occasions and tasks-->
        <div style="width:100%;height: 260px" id="mapContainer" ></div>
    </div>

</template>

<script>


    export default {

        data() {
            return {
                latitude: 52.5,
                longitude: 13,
                locationName: '',
                map: {},
                //TODO put into env\`
                platform: new H.service.Platform({
                    'apikey': '9ikH2Uo_Ngu304J96SFsi9KKRe9mL628WHqmAR2I0JA'
                }),
                bubble: null,
                locationsContainer: {},
                behavior: {},
                ui: {},
                marker: null,
                group: null,
                position: null,
                searchText: ''
            }
        },
        methods: {
            initializeMap() {
                const defaultLayers = this.platform.createDefaultLayers();
                this.map = new H.Map(
                    document.getElementById('mapContainer'),
                    defaultLayers.vector.normal.map,
                    {
                        zoom: 12,
                        //TODO: current location
                        center: {lat: this.latitude, lng: this.longitude},
                        pixelRatio: window.devicePixelRatio || 1
                    });

                this.locationsContainer = document.getElementById('panel');
                this.behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));
                this.ui = H.ui.UI.createDefault(this.map, defaultLayers);

            },
            geocode() {
                let geocoder = this.platform.getGeocodingService(),
                    geocodingParameters = {
                        searchText: this.searchText,
                        jsonattributes: 1
                    };

                geocoder.geocode(
                    geocodingParameters,
                    this.onSuccess,
                    this.onError
                );
            },
            onSuccess(result) {
                let locations = result.response.view[0].result;
                this.latitude = locations[0].location.displayPosition.latitude;
                this.longitude = locations[0].location.displayPosition.longitude;
                this.$emit('setLatLong',{
                    long:this.longitude,
                    lat:this.latitude
                });
                this.addLocationsToMap(locations);

            },
            onError(error) {
               console.log(error)
            },

            addLocationsToMap(locations) {
                this.group = new H.map.Group();
                for (let i = 0; i < locations.length; i += 1) {
                    this.position = {
                        lat: locations[i].location.displayPosition.latitude,
                        lng: locations[i].location.displayPosition.longitude
                    };
                    this.marker = new H.map.Marker(this.position);
                    this.marker.label = locations[i].location.address.label;
                    this.group.addObject(this.marker);
                }

                this.map.addObject(this.group);
                this.map.setCenter(this.group.getBoundingBox().getCenter());
            }
        },

        mounted() {
            this.initializeMap()
        }
    }
</script>