<template>
    <FullCalendar
            style="margin-top:10px"
            defaultView="dayGridMonth"
            :plugins="calendarPlugins"
            :events="events"
    />
</template>

<script>

    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import axios from 'axios';

    export default {
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        data() {
            return {
                calendarPlugins: [dayGridPlugin],
                events: []
            }
        },
        methods: {
            getCalendarData() {
                let vm = this;
                axios.get('/api/calendar/events')
                    .then(function (response) {

                        vm.events = vm.mapEvents(response.data);
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            mapEvents(events) {
                let tasks = events.tasks.map(task => ({
                    title: task.name,
                    backgroundColor: 'red',
                    date: task.deadline
                }));

                let occasions = events.occasions.map(occasion => ({
                    title: occasion.name,
                    backgroundColor: 'red',
                    start: occasion.from_date,
                    end: occasion.to_date,
                }));

                return [...tasks, ...occasions]
            }
        },
        mounted() {
            this.getCalendarData()
        }
    }

</script>


<style lang='scss'>

    @import '~@fullcalendar/core/main.css';
    @import '~@fullcalendar/daygrid/main.css';

</style>