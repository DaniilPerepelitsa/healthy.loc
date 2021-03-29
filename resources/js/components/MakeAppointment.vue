<template>


    <div class="container" style="text-align: center">

        <div class="card" style="text-align: left">
            <div class="card-header" style="text-align: center"><h5>Make appointment</h5></div>
            <div class="card-body">
                <form @submit.prevent="saveAppointment()">

                    Doctor:
                    <select name="doctor" class="form-control" v-model="data.doctor" style="margin-bottom: 30px" required>
                        <option v-for="doctor in doctors" :value="doctor">
                            {{doctor.specialization}}
                        </option>
                    </select>

                    Patient:
                    <select name="patient" class="form-control" v-model="data.patient" style="margin-bottom: 30px" required>
                        <option v-for="user in users" :value="user.id">{{user.name}}</option>
                    </select>

                    <div class="row">
                        <div class="col">
                            Date:
                            <input type="date" class="form-control" v-model="data.date" name="date" style="width: 100%; margin-bottom: 30px" required>
                        </div>
                        <div class="col">
                            Time:
                            <input type="time" class="form-control" name="time" v-model="data.time" style="width: 100%; margin-bottom: 30px" required>
                        </div>
                    </div>

                    <div class="btn-group" style="width: 100%">
                        <button class="btn btn-outline-success" style="width: 90%">Save</button>
                        <button class="btn btn-outline-dark" style="width: 10%">Close</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
</template>

<script>

export default {
    name: "MakeAppointment",

    data: () => ({
        doctors: [],
        users: [],
        data: {
            doctor: '',
            user_id: '',
            patient: '',
            date: '',
            time: ''
        },
    }),

    props: [
        'errors'
    ],

    methods: {
        getDoctorsList(){
            axios
                .get('/api/make/appointment')
                .then(({data}) => {
                    console.log(data.doctors)
                    this.doctors = [];
                    return this.doctors = data.doctors
                })
                .catch(error => console.log(error.response.data));
        },

        getUsersList(){
            axios
                .get('/api/make/appointment')
                .then(({data}) => {
                    console.log(data.users)
                    this.users = [];
                    return this.users = data.users
                })
                .catch(error => console.log(error.response.data));
        },

        saveAppointment(){
            axios
                .post('/api/save/appointment', {doctor: this.data.doctor, patient: this.data.patient, date: this.data.date, time: this.data.time})
                .then(({data}) => {
                    console.log(data)
                    this.data = []
                })
                .catch(error => console.log(error.response.data));
        }
    },

    mounted() {
        this.getDoctorsList()
        this.getUsersList()
    }
}
</script>
