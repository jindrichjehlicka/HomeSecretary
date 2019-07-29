<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    <div class="form-group">
                        <label for="groupName">Name</label>
                        <input type="text" class="form-control" id="groupName" placeholder="Name" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="groupDescription">Description</label>
                        <input type="text" class="form-control" id="groupDescription" placeholder="Description"
                               v-model="description">
                    </div>

                    <div class="form-group">
                        <label for="taskList">Add user</label>
                        <input type="text" class="form-control" id="taskList"
                               v-model="userNameSearch">
                    </div>
                    <div class="dropdown">
                        <!--                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                        <!--                            Dropdown button-->
                        <!--                        </button>-->
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="suggestions"
                             :class="{block:suggestions.length>0}">
                            <div class="dropdown-item" @click="addUserToGroup(user)" v-for="user in suggestions">
                                {{user.name}}
                            </div>
                        </div>
                    </div>
                    <div class="user-list">
                        <ul class="list-group">
                            <li class="list-group-item flex" v-for="(user, key) in users">
                                {{user.name}}
                                <button type="button" class="btn btn-danger float-right btn-sm"
                                        @click="removeUserFromGroup(key)">Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div @click="createGroup" class="btn btn-primary">Create Group</div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import debounce from 'debounce';

    export default {
        name: 'create-group',
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
                name: 'New Group',
                description: 'An amazing group',
                users: [],
                userNameSearch: '',
                suggestions: []


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
        methods: {
            addUserToGroup(user) {
                this.users.push(user);
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
                            console.log(response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
            createGroup() {
                const params = {
                    name: this.name,
                    description: this.description,
                    userIds: this.users.map(user => user.id)
                };

                axios.post(`/groups/store`, params)
                    .then(function (response) {
                        //add alert
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            removeUserFromGroup(index) {
                this.users.splice(index, 1);
            }
        },


    }
</script>
<style scoped>
    .location {
        margin: 24px 0 24px 0;
    }

    .block {
        display: block
    }

    .user-list {
        margin-bottom: 20px
    }
</style>