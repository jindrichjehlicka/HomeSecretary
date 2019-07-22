<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--TODO: add different inputs for occasions and tasks-->
                <div style="width: 640px; height: 480px" id="mapContainer"></div>
            </div>
        </div>
    </div>
</template>

<script>


    export default {

        data() {
            return {
                latitude: '',
                longitude: ''
            }
        },
        methods: {
            getCurrentLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(this.showPosition);
                }

            },
            showPosition(position){
                console.log(position);
                // let latlon = position.coords.latitude + "," + position.coords.longitude;
                // console.log(latlon);
            }
        },


        mounted() {
            var platform = new H.service.Platform({
                'apikey': '9ikH2Uo_Ngu304J96SFsi9KKRe9mL628WHqmAR2I0JA'
            });
            var defaultLayers = platform.createDefaultLayers();

// Instantiate (and display) a map object:
            var map = new H.Map(
                document.getElementById('mapContainer'),
                defaultLayers.vector.normal.map,
                {
                    zoom: 10,
                    center: { lat: 52.5, lng: 13.4 }
                });
        }
    }
</script>