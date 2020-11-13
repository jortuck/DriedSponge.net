<template>
    <div @click="saveAuth">
        Test Authentication: {{ token }}
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Authenticate",
    props:['token'],
    data: function (){
        return {
            status: "Authenticating..."
        }
    },
    methods: {
        saveAuth() {
            this.status = "Validating Token..."
            axios.get("http://localhost:8000/sanctum/csrf-cookie").then(response => {
                console.log(response);
                axios.get("http://localhost:8000/api/user",{
                    headers: {
                        'Authorization':"Bearer "+ this.token
                    }
                }).then(res => {
                    console.log(res);
                })
            })
        }
    }
}
</script>

<style scoped>

</style>
