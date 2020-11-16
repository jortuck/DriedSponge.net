<template>
    <a v-if="Auth.authenticated" @click="logout" class="button is-dark is-outlined is-rounded is-inverted">
        LOGOUT
    </a>
    <a  @click="login" class="button is-dark is-outlined is-rounded is-inverted" v-else>
        Login With Steam
    </a>
</template>
<script>
import Auth from "../store";
import axios from "axios"
export default {
    name: "Loginbutton",
    methods: {
        login(){
            window.location = "/login"
        },
        logout(){
            axios.post("/logout/").then(res=>{
                Auth.authenticated= false;
            })
        }
    },
    setup(){
        return{
            Auth
        }
    }
}
</script>

<style scoped>

</style>
