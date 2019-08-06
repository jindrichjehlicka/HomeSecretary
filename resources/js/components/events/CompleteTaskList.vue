<template>
    <div>
        <h6 class="card-subtitle mt-5 mb-1 text-muted">Task list</h6>
        <ul class="list-group mt-3">
            <li class="list-group-item" v-for="(list, index) in task.task_list">
                {{list.name}}
                <button v-if="!list.completed" type="button" @click="completeTask(list,index)"
                        class="btn btn-primary float-right btn-sm">
                    Complete
                </button>
                <button v-else type="button"
                        class="btn btn-grey float-right btn-sm disabled">
                    Completed
                </button>

            </li>
        </ul>
    </div>
</template>

<script>

    export default {
        data() {
            return {}
        },
        props: {
            task: {
                required: true,
                type: Object
            }
        },
        methods: {
            completeTask(list, index) {
                let vm = this;
                axios.patch(`/tasks/update-list/${this.task.id}`, {
                    params: {
                        'task_list_id': list.id,
                    }
                })
                    .then(function (response) {
                        vm.task.task_list[index].completed = 1;
                        vm.$forceUpdate();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        mounted() {
            console.log(this.task)
        }
    }
</script>