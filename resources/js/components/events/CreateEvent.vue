<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!--TODO: add different inputs for occasions and tasks-->
                <form>
                    <div class="form-group">
                        <label for="occasionName">Name</label>
                        <input type="text" class="form-control" id="occasionName" placeholder="Name" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="occasionDescription">Description</label>
                        <input type="text" class="form-control" id="occasionDescription" placeholder="Description"
                               v-model="description">
                    </div>

                    <div v-if="type==='occasion'">
                        <div class="form-group">
                            <label for="occasionStartDate">Start Date</label>
                            <input type="date" class="form-control" id="occasionStartDate" placeholder="Starts.."
                                   v-model="startDate">
                        </div>
                        <div class="form-group">
                            <label for="occasionStartTime">Start Time</label>
                            <input type="time" class="form-control" id="occasionStartTime" placeholder=""
                                   v-model="startTime">
                        </div>
                        <div class="form-group ">
                            <label for="occasionEndDate">End Date</label>
                            <input type="date" class="form-control" id="occasionEndDate" placeholder="Ends..."
                                   v-model="endDate">
                        </div>
                        <div class="form-group ">
                            <label for="occasionEndTime">End Time</label>
                            <input type="time" class="form-control" id="occasionEndTime" placeholder=""
                                   v-model="endTime">
                        </div>
                    </div>

                    <div v-else-if="type==='task'">
                        <div class="form-group ">
                            <label for="deadlineDate">Deadline Date</label>
                            <input type="date" class="form-control" id="deadlineDate" placeholder="Ends..."
                                   v-model="deadlineDate">
                        </div>
                        <div class="form-group ">
                            <label for="deadlineTime">Deadline time</label>
                            <input type="time" class="form-control" id="deadlineTime" placeholder=""
                            v-model="deadlineTime">
                        </div>


                        <div class="form-group">
                            <location class="location" v-on:setLatLong="setLatLong"></location>
                        </div>
                    </div>
                    <div @click="createEvent" class="btn btn-primary">Create Occasion</div>

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
                name: 'An Event',
                description: 'A very nice event',
                startDate: '2019-08-17',
                startTime: '16:00',
                endDate: '2019-08-20',
                endTime: '08:00',
                latitude: '',
                longitude: '',
                deadlineDate: '2019-08-20',
                deadlineTime: '08:00'

            }
        },
        methods: {
            createEvent() {
                console.log(`/${this.type}s/store`);
                axios.post(`/${this.type}s/store`, this.params)
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
        computed: {
            params() {
                let params = {
                    name: this.name,
                    description: this.description,
                    latitude: this.latitude,
                    longitude: this.longitude
                };
                if (this.type === 'occasion') {
                    params.startDate = this.startDate;
                    params.startTime = this.startTime;
                    params.endDate = this.endDate;
                    params.endTime = this.endTime;
                } else if (this.type === 'task') {
                    params.deadlineDate = this.deadlineDate;
                    params.deadlineTime = this.deadlineTime;
                }
                return params;
            }
        },
        mounted() {
            console.log(this);
        }


    }
</script>
<style scoped>
    .location {
        margin: 24px 0 24px 0;
    }
</style>