<template>
    <div class="container" style="text-align: center">

        <div class="container" style="width: 80%">
            <ul v-for="user in data">
                <li style="list-style: none">
                    <user :user="user" v-on:remove="removeFromList"></user>
                </li>
            </ul>

        </div>

    </div>
</template>

<script>

import User from './User'

export default {
    name: "UserList",
    components: {User},
    data: () => ({
        data: [],
        position: 0
    }),

    props: [
        'user',
        'idx'
    ],

    methods: {

        getUsersList(){
            axios
                .get('/api/users/list')
                .then(({data}) => {
                    this.data = [];
                    return this.data = data
                })
                .catch(error => console.log(error.response.data));
        },


        removeFromList(user){
            axios
                .post('/api/delete/user/'+user.id, {id: user.id})
                .then(({data}) => {
                    this.showDelete = false
                })
                .catch(error => console.log(error.response.data));

            this.position = this.data.indexOf(user)
            this.data.splice(this.position, 1)
        }
    },

    mounted() {
        this.getUsersList();
    }
}
</script>

