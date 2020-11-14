<template>
    <Pagehead>
        {{ status }}
    </Pagehead>
</template>

<script>
import axios from "axios";
import Pagehead from "@/components/Pagehead";

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
            axios.get("http://localhost:8000/user").then(res => {
                if(res.data === ""){
                    this.status = "Unauthenticated..."
                }else{
                    this.status = "Logged in! Redirecting you back!"
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
