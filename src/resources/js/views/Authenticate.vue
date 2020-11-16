<template>
    <Pagehead>
        {{ status }}
    </Pagehead>
</template>

<script>
import axios from "axios";
import Pagehead from "../components/Pagehead";
import Auth from  "../store";
export default {
    name: "Authenticate",
    components: {Pagehead},
    props: ['token'],
    data: function () {
        return {
            status: "Authenticating..."
        }
    },
    created() {
        this.saveAuth()
    },
    methods: {
        saveAuth() {
            this.status = 'Verifying...'
            axios.get("/user").then(res => {
                console.log(res);
                if(res.data === ""){
                    Auth.authenticated=false;
                    this.status = "Unauthenticated..."
                }else{
                    Auth.authenticated=true;
                    this.status = "Logged in! Redirecting you back!"
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
