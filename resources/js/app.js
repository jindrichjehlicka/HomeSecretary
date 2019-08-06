/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('create-occasion', require('./components/events/CreateOccasion.vue').default);
Vue.component('edit-occasion', require('./components/events/EditOccasion.vue').default);
Vue.component('create-task', require('./components/events/CreateTask.vue').default);
Vue.component('create-group', require('./components/groups/CreateGroup.vue').default);
Vue.component('edit-group', require('./components/groups/EditGroup.vue').default);
Vue.component('show-location', require('./components/maps/ShowLocation.vue').default);
Vue.component('calendar', require('./components/calendar.vue').default);
Vue.component('complete-task-list', require('./components/events/CompleteTaskList').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
