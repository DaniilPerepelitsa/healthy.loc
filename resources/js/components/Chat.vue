<template>
    <div class="container" style="text-align: center; margin-top: 40px; width: 100%">

        <div class="row">
            <div class="col"></div>
            <div class="col" style="text-align: right">
                <h3>{{ auth_user.name }}</h3>
            </div>
        </div>

        <div class="alert alert-success" v-if="newMessage" style="text-align: center">
            <ul>
                <li>
                    You have a new message!
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="newMessage = false">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="card" style="background-color: #363c42; color: white; width: 100%">
            <div class="card-header"><b>{{ chatName }}</b></div>

            <div class="card-body" style="">
                <div class="row">

                    <div class="col-3" style="height: 600px; overflow: auto;">
                        <button class="btn btn-outline-secondary" @click="showModal = true" style="width: 100%; color: white; border-radius: 0;">Create room</button>
                        <br><br>

                        <!--GENERAL CHAT-->
                        <div class="card" style="background-color: #1b1e21; color: white;">
                            <button class="btn btn-outline-dark" @click="switchRoom()" style="border-radius: 0; color: white; height: 60px">
                                <div class="card-body" style="text-align: left">
                                    <h6><b>General chat</b></h6>
                                </div>
                            </button>
                        </div>
                        <br><br>

                        <!--CHAT ROOMS-->
                        <div class="card" v-for="room in chatRooms" style="background-color: #1b1e21; color: white">
                            <button class="btn btn-outline-dark" @click="switchRoom(room)" style="border-radius: 0; color: white; height: 60px">
                                <div class="card-body" style="text-align: left">
                                    <h6><b> {{room.chat_name}} </b></h6>
                                </div>
                            </button>
                        </div>
                        <br><br>


                        <!--USERS-->
                        <button class="btn btn-outline-secondary" @click="showUsers = !showUsers" style="width: 100%; color: white; border-radius: 0;">Users</button>

                        <transition name="users">
                            <div v-if="showUsers">
                                <div class="card" v-for="user in users" style="background-color: #1b1e21; color: white">
                                    <button class="btn btn-outline-dark" style="border-radius: 0; color: white">
                                        <div class="card-body" style="text-align: left">
                                            <h6><b>{{user.name}}</b></h6>
                                            <small><b>{{user.email}}</b></small>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </transition>
                    </div>

                    <!--MESSAGES-->
                    <div class="col-9" id="general-container" style="height: 600px;  overflow: auto; background-color: #1b1e21">

                        <div v-if="messages.length === 0" style="color: white; height: 100%">
                            <div class="card" style="width: 100%; background-color: #1b1e21; color: white; height: 100%">
                                <p style="margin-top: 40%">No messages yet</p>
                            </div>
                        </div>

                        <div class="card" v-for="message in messages" style="width: 100%; background-color: #1b1e21; color: white; ">
                            <div class="card-body">

                                <div class="row" v-if="message.user_email === auth_user.email">
                                    <div class="col"></div>
                                    <div class="col" style="text-align: left;">
                                        <small>{{message.user_email}}</small>
                                            <div class="card" style="background-color: #30557a; border-radius: 25px">
                                                <p style="margin-left: 20px; margin-top: 15px">{{message.message_text}}</p>
                                            </div>
                                        <small style="margin-left: 85%;">{{message.message_time}}</small>
                                    </div>
                                </div>

                                <div v-else class="row" >
                                    <div class="col" style="text-align: left; ">
                                        <small>{{message.user_email}}</small>
                                            <div class="card" style="background-color: #363c42; border-radius: 25px">
                                                <p style="text-indent: 20px; margin-top: 15px">{{message.message_text}}</p>
                                            </div>
                                        <small style="margin-left: 85%">{{message.message_time}}</small>
                                    </div>
                                    <div class="col"></div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <!--SEND MESSAGE-->
                <form @submit.prevent="">
                    <div class="row">
                        <div class="col-3"></div>

                        <div class="col">
                            <input type="text" class="form-control" v-model="message.text" style="margin-top: 20px; margin-bottom: 10px; background-color: #1b1e21; color: white; border-radius: 25px; width: 100%" placeholder="Start messaging...">
                        </div>

                        <div class="col-1" style="text-align: left">
                            <button class="btn btn-outline-success" @click="sendMessage()" style="margin-top: 20px; margin-bottom: 10px;">Send</button>
                        </div>
                    </div>
                </form>

            </div>

            <transition name="modal">
                <div class="modal fade show" tabindex="-1" role="dialog" v-if="showModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: #363c42; color: white;">

                            <form @submit.prevent="createRoom()">
                                <div class="modal-header" style="background-color: #363c42; color: white;">
                                    <input type="text" name="room_name" class="form-control" v-model="chatName" placeholder="Enter room name...">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="showModal = false">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body" style="background-color: #363c42; color: white;">
                                    <div style="height: 300px; overflow: auto">
                                        <div class="card" v-for="user in users" v-if="user.email !== auth_user.email" style="background-color: #363c42; color: white;">
                                            <div class="card-body" style="text-align: left; background-color: #363c42; color: white;">
                                                <input type="checkbox" :id="user.id" :value="user.email" v-model="checkedUsers">
                                                <label :for="user.id">{{user.name}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <div class="btn-group" style="width: 100%">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="showModal = false">Close</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </transition>
            <div class="modal-backdrop fade show" v-if="showModal"></div>

        </div>
        <br><br>

    </div>
</template>


<script>

import GeneralChat from "./GeneralChat";

export default {
    name: "Chat",

    comments: [
        GeneralChat
    ],

    data: () => ({
        users: [],
        showUsers: false,

        messages: [],

        currentRoom: undefined,

        message:{
            text: '',
            time: ''
        },

        timer: '',

        showModal: false,

        checkedUsers: [],

        chats: [],

        chatRooms: [],

        lastTime: 0,
        newMessage: false
    }),

    props:['auth_user'],

    computed: {
        chatName() {
            return this.currentRoom === undefined
                ? "General chat"
                : this.currentRoom.chat_name;
        }
    },

    methods:{
        getMessages() {
            console.log("CHAT: ", this.currentRoom ? this.currentRoom.chat_id : 'general');

            let url = this.currentRoom === undefined
                ? '/api/messages'
                : '/api/get/room/' + this.currentRoom.chat_id;
            url += '?last=' + this.lastTime;

            return axios
                .get(url)
                .then(({data}) => {
                    console.log(data);
                    if(this.messages.length > 0){
                        data.data = data.data.filter((message) => {
                            let msg = _.find(this.messages, ((origMessage) => origMessage.id !== message.id));
                            console.log('NEW MESSAGE : ' , msg);
                            return msg !== undefined;
                        });
                    }

                    this.lastTime = data.timestamp;
                    this.messages.push(...data.data);
                })
        .catch(error => console.log(error.response.data));
        },

        getUsersList(){
            axios
                .get('/api/users')
                .then(({data}) => {
                    this.users = [];
                    return this.users = data
                })
                .catch(error => console.log(error.response.data));
        },

        sendMessage: function () {
            console.log('CHAT ID : ', this.currentRoom === undefined ? 'GENERAL' : this.currentRoom.chat_id);

            let url = this.currentRoom === undefined
                ? '/api/send/message'
                : '/api/send/room/message';

            let time = new Date();
            this.message.time = time.getHours() + ':' + time.getMinutes();

            let data = {
                user_id: this.auth_user.id,
                user_name: this.auth_user.name,
                user_email: this.auth_user.email,
                message_text: this.message.text,
                message_time: this.message.time
            }

            if (this.currentRoom !== undefined){
                data['chat_id'] = this.currentRoom.chat_id
            }

            axios
                .post(url,{data})
                .then(({data}) => {
                    this.message.text = this.message.time = ''
                })
                .catch(({response}) => {
                    console.log(response.data.errors);
                });
        },

        createRoom(){
            this.checkedUsers.unshift(this.auth_user.email)
            this.chats.push(this.chatName)
            axios
                .post('/api/create/room',
                    {
                        chatName: this.chatName,
                        checkedUsers: this.checkedUsers
                    })
                .then(({data}) => {
                    console.log(data)
                    this.showModal = false
                    this.getChatRooms()
                })
                .catch(({response}) => {
                    console.log(response.data.errors);
                });
        },

        getChatRooms(){
            axios
                .get('/api/chat/rooms')
                .then(({data}) => {
                    return this.chatRooms = data
                })
                .catch(error => console.log(error.response.data));
        },

        switchRoom(room) {
            this.currentRoom = room;
        },

        refreshRoom() {
            this.lastTime = 0;
            this.messages = [];
            this.getMessages()
            .then(() => {
                this.$nextTick(() => {
                    console.log("scrolling down");
                    var general_container = this.$el.querySelector("#general-container");
                    general_container.scrollTop = general_container.scrollHeight;
                });
            });
            clearInterval(this.timer);
            this.timer = setInterval(this.getMessages, 1000);
        },
    },

    mounted() {
        this.getUsersList();
        this.getChatRooms();
        this.refreshRoom();
    },

    watch: {
        currentRoom() {
            this.refreshRoom();
        }
    },
}
</script>
