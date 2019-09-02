<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <!--TODO: add different inputs for tasks and tasks-->
        <form>
          <div class="form-group">
            <label for="taskName">Name</label>
            <input type="text" class="form-control" id="taskName" placeholder="Name" v-model="name">
          </div>
          <div class="form-group">
            <label for="taskDescription">Description</label>
            <input type="text" class="form-control" id="taskDescription" placeholder="Description"
                   v-model="description">
          </div>

          <div class="form-group">
            <label for="deadlineDate">Deadline Date</label>
            <input type="date" class="form-control" id="deadlineDate" placeholder="Starts.."
                   v-model="deadlineDate">
          </div>
          <div class="form-group">
            <label for="taskDeadlineTime">Deadline Time</label>
            <input type="time" class="form-control" id="taskDeadlineTime" placeholder=""
                   v-model="deadlineTime">
          </div>

          <div class="form-group">
            <location class="location" v-on:setLatLong="setLatLong" :lat="task.latitude"
                      :long="task.longitude"></location>
          </div>

          <div @click="createEvent" class="btn btn-primary">Update task</div>

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
            task: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                //TODO: delete after testing
                name: 'An task',
                description: 'A very nice task',
                deadlineDate: '2019-08-17',
                deadlineTime: '16:00',
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
                    deadlineDate: this.deadlineDate,
                    deadlineTime: this.deadlineTime,
                };
                axios.put(`/tasks/update/${this.task.id}`, params)
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
        mounted() {
            this.name = this.task.name;
            this.description = this.task.description;
            this.latitude = this.task.latitude;
            this.longitude = this.task.longitude;
            this.deadlineDate = this.task.deadline_date.toLocaleDateString();
            this.deadlineTime = this.task.deadline_date.toLocaleTimeString();


        }


    }
</script>
<style scoped>
  .location {
    margin: 24px 0 24px 0;
  }
</style>