<template>

    <div>
        <!--TODO: add different inputs for occasions and tasks-->
        <h6 class="card-subtitle mb-2 mt-5">Location: {{address}}</h6>
        <div style="width:100%;height: 260px" id="mapContainer"></div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                platform: new H.service.Platform({
                    'apikey': '9ikH2Uo_Ngu304J96SFsi9KKRe9mL628WHqmAR2I0JA'
                }),
                map: {},
                address: ''
            }
        },
        props: {
            latitude: {
                required: true,
                type: Number,

            },
            longitude: {
                required: true,
                type: Number,

            }
        },
        methods: {
            async initializeMap() {
                const defaultLayers = this.platform.createDefaultLayers();
                this.map = await new H.Map(
                    document.getElementById('mapContainer'),
                    defaultLayers.vector.normal.map,
                    {
                        zoom: 12,
                        center: {lat: this.latitude, lng: this.longitude},
                        pixelRatio: window.devicePixelRatio || 1
                    });
                this.reverseGeocode();
            },
            async reverseGeocode() {
                let geocoder = await this.platform.getGeocodingService(),
                    parameters = {
                        prox: `${this.latitude},${this.longitude}`,
                        mode: 'retrieveAddresses',
                        maxresults: '1',
                        gen: '9'
                    };
                const vm = this;
                geocoder.reverseGeocode(parameters,
                    function (result) {
                        vm.address = result.Response.View[0].Result[0].Location.Address.Label

                    }, function (error) {
                        console.log(error);
                    });
            }
        },
        async mounted() {
            await this.initializeMap()
        }
    }
</script>