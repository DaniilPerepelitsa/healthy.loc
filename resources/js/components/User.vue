<template>
    <div>
        <div class="card" style="text-align: center">
            <div class="card-header" v-model="id">{{user.id}}</div>
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <h3></h3>
                        {{user.name}} / {{user.email}}
                    </div>

                    <div class="col"></div>

                    <div class="col">
                        <a class="btn btn-outline-success" @click="show = !show" style="font-size: 12px">Edit</a>
                        <button class="btn btn-outline-danger" @click="showDelete = !showDelete" style="font-size: 12px">Delete</button>
                    </div>

                </div>

            </div>
        </div>

        <transition name="info">
            <div v-if="show" style="margin-top: 20px; margin-bottom: 30px">
                <form @submit.prevent="">
                    <input type="hidden" name="id" :value="user.id">
                    <input class="form-control" type="text" name="name" style="margin-bottom: 10px" v-model:value="user.name">
                    <input class="form-control" type="email" name="email" style="margin-bottom: 10px" v-model:value="user.email">
                    <input type="button" class="btn btn-outline-success" value="Save" @click="editUser(user.id)">
                </form>
            </div>
        </transition>

        <transition name="delete">
            <div v-if="showDelete" style="margin-top: 20px; margin-bottom: 30px">
                <form @submit.prevent="">
                    <input type="hidden" name="id" :value="user.id">
                    <p>Are you sure you want delete this user?</p>
                    <input type="button" class="btn btn-outline-danger" value="Delete" @click="deleteUser(user.id)">
                    <input type="button" class="btn btn-outline-dark" value="Close" @click="showDelete = false">
                </form>
            </div>
        </transition>
    </div>
</template>

<script>



export default {
    name: "User",

    data: () => ({
        show: false,
        showDelete: false,
        id: null,
        name: '',
        email: ''
    }),

    props: [
        'user',
        'idx'
    ],

    methods: {
        editUser(id){
            console.log(id)
            axios
                .post('/api/edit/user/'+id, {id: this.user.id, name: this.user.name, email: this.user.email})
                .then(({data}) => {
                    this.name = data.name;
                    this.email = data.email;
                    this.show = false
                })
                .catch(error => console.log(error.response.data));
        },

        deleteUser(){
            this.$emit('remove', this.user);
        }
    },
}
</script>
