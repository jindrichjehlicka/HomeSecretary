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
                        <input type="time" class="form-control" id="occasionEndTime" placeholder="" v-model="endTime">
                    </div>

                    <!--                    TODO: add location-->

                    <div @click="createOccasion" class="btn btn-primary">Create Occasion</div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        data() {
            return {
                //TODO: delete after testing
                name: 'An Event',
                description: 'A very nice event',
                startDate: '2019-08-17',
                startTime: '16:00',
                endDate: '2019-08-20',
                endTime: '08:00'
            }
        },
        methods: {
            createOccasion() {
                axios.post('/occasions/store', {
                    name: this.name,
                    description: this.description,
                    startDate: this.startDate,
                    startTime: this.startTime,
                    endDate: this.endDate,
                    endTime: this.endTime,
                })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },


        mounted() {

        }
    }
</script>