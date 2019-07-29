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

                    <div class="flex space-between">
                        <div class="form-group width-48">
                            <label for="deadlineDate">Deadline Date</label>
                            <input type="date" class="form-control" id="deadlineDate" placeholder="Ends..."
                                   v-model="deadlineDate">
                        </div>
                        <div class="form-group width-48">
                            <label for="deadlineTime">Deadline time</label>
                            <input type="time" class="form-control" id="deadlineTime" placeholder=""
                                   v-model="deadlineTime">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="taskList">Add task</label>
                        <input type="text" class="form-control" id="taskList" @change="addToList"
                               v-model="taskListName">
                    </div>
                    <div class="">
                        <ul class="list-group">
                            <li class="list-group-item flex" v-for="(task, key) in tasksList">
                                {{task}}
                                <button type="button" class="btn btn-danger float-right btn-sm" @click="removeFromList(key)">Delete</button>
                            </li>
                        </ul>
                    </div>


                    <div class="form-group">
                        <location class="location" v-on:setLatLong="setLatLong"></location>
                    </div>

                    <div @click="createEvent" class="btn btn-primary">Create Task</div>

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
                    deadlineDate: this.deadlineDate,
                    deadlineTime: this.deadlineTime,
                    tasksList:this.tasksList
                };

                const vm = this;
                axios.post("/tasks/store", params)
                    .then(function (response) {
                        vm.resetWindow();
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            setLatLong(latLong) {
                this.longitude = latLong.long;
                this.latitude = latLong.lat;
            },
            addToList() {
                this.tasksList.push(this.taskListName);
                this.taskListName = '';
            },
            removeFromList(index){
                this.tasksList.splice(index, 1);
            },
            initialState(){
                return{
                    name: '',
                    description: '',
                    latitude: '',
                    longitude: '',
                    deadlineDate: '',
                    deadlineTime: '',
                    tasksList: [],
                    taskListName: ''
                }
            },
            resetWindow (){
                console.log(this.$data);
                Object.assign(this.$data, this.initialState());
            }
        },


    }
</script>
<style scoped>
    .location {
        margin: 24px 0 24px 0;
    }

    .flex {
        display: flex;
    }

    .width-48 {
        width: 48%;
    }
    li{
        justify-content: space-between;
        align-items: center;
    }

    .space-between{
        justify-content: space-between;
    }
</style>