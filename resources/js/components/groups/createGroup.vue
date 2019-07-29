<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    <div class="form-group">
                        <label for="groupName">Name</label>
                        <input type="text" class="form-control" id="groupName" placeholder="Name" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="occasionDescription">Description</label>
                        <input type="text" class="form-control" id="occasionDescription" placeholder="Description"
                               v-model="description">
                    </div>

                    <div @click="createGroup" class="btn btn-primary">Create Group</div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import location from '../maps/Location';

    export default {
        components: {
            location
        },
        props: {
            type: {
                type: String,
                required: false,
                default: 'occasion'
            }
        },
        data() {
            return {
                //TODO: delete after testing
                name: 'An Occasion',
                description: 'A very nice occasion',
                startDate: '2019-08-17',
                startTime: '16:00',
                endDate: '2019-08-20',
                endTime: '08:00',
                latitude: '',
                longitude: '',

            }
        },
        methods: {
            createEvent() {
                const params = {
                    name: this.name,
                    description: this.description,
                    latitude: this.latitude,
                    longitude: this.longitude,
                    startDate: this.startDate,
                    startTime: this.startTime,
                    endDate: this.endDate,
                    endTime: this.endTime,
                };
                console.log(`/occasions/store`);
                axios.post(`/occasions/store`, params)
                    .then(function (response) {
                        //add alert
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            setLatLong(latLong) {
                this.longitude = latLong.long;
                this.latitude = latLong.lat;
            }
        },


    }
</script>
<style scoped>
    .location {
        margin: 24px 0 24px 0;
    }
</style>