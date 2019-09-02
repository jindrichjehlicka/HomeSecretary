<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                Choose a reminder period
                <ul class="list-group mt-3 mb-3">
                    <li
                            class="list-group-item"
                            v-for="(period, index) in periods"
                            @click="setNewPeriod(index)"
                            :class="{active:currentPeriod === index}"
                    >
                        {{period}}
                    </li>
                </ul>
                <button type="button" class="btn btn-primary mb-3">Save</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        data() {
            return {
                periods: {
                    'hourly': 'Hour before',
                    'weekly': 'Week before',
                    'biweekly': 'Two weeks before',
                    'monthly': 'Month before',
                },
                currentPeriod: 'weekly'
            }
        },
        methods: {
            setNewPeriod(index) {
                this.currentPeriod = index;
            },
        },
        mounted() {

        }
    }
</script>