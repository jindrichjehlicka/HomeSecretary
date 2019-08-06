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
                    <div class="form-group">
                        <location class="location" v-on:setLatLong="setLatLong"></location>
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
            return this.initialState()
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
                let vm = this;
                axios.post(`/occasions/store`, params)
                    .then(function (response) {
                        vm.resetWindow();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            setLatLong(latLong) {
                this.longitude = latLong.long;
                this.latitude = latLong.lat;
            },
            initialState() {
                return {
                    name: '',
                    description: '',
                    latitude: '',
                    longitude: '',
                    startDate: '',
                    startTime: '',
                    endDate: '',
                    endTime: '',
                    tasksList: [],
                    taskListName: '',
                    user: null,
                    userNameSearch: '',
                    suggestions: []
                }
            },
            resetWindow() {
                Object.assign(this.$data, this.initialState());
            }
        },


    }
</script>
<style scoped>
    .location {
        margin: 24px 0 24px 0;
    }
</style>