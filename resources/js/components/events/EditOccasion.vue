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
                        <location class="location" v-on:setLatLong="setLatLong" :lat="occasion.latitude"
                                  :long="occasion.longitude"></location>
                    </div>

                    <div @click="createEvent" class="btn btn-primary">Update Occasion</div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import location from '../maps/Location';
    import debounce from 'debounce';

    export default {
        components: {
            location
        },
        props: {
            occasion: {
                type: Object,
                required: true
            }
        },
        watch: {
            userNameSearch() {
                this.searchUsers();
            }
        },
        created() {
            this.searchUsers = debounce(this.searchUsers, 300)
        },
        data() {
            return {
                name: '',
                description: '',
                startDate: '',
                startTime: '',
                endDate: '',
                endTime: '',
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
                axios.put(`/occasions/update/${this.occasion.id}`, params)
                    .then(function (response) {
                        //add alert
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            assignToUser(user) {
                this.user = user;
                this.suggestions = []
            },
            searchUsers() {
                if (this.userNameSearch) {
                    let vm = this;
                    axios.get(`/users/search`, {
                        params: {
                            search_string: this.userNameSearch,
                        }
                    })
                        .then(function (response) {
                            vm.suggestions = response.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            setLatLong(latLong) {
                this.longitude = latLong.long;
                this.latitude = latLong.lat;
            },
            removeUser() {
                this.user = null;
            },
        },
        mounted() {
            this.name = this.occasion.name;
            this.description = this.occasion.description;
            this.latitude = this.occasion.latitude;
            this.longitude = this.occasion.longitude;
            this.startDate = this.occasion.from_date.toLocaleDateString();
            this.startTime = this.occasion.from_date.toLocaleTimeString();
            this.endDate = this.occasion.to_date.toLocaleDateString();
            this.endTime = this.occasion.to_date.toLocaleTimeString();

        }


    }
</script>
<style scoped>
    .location {
        margin: 24px 0 24px 0;
    }
</style>