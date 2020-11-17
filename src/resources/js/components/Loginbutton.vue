<template>
    <div v-if="state.loaded" style="display: inherit">
        <div v-if="state.authenticated" class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
                {{ state.user.username }}
            </a>
            <div class="navbar-dropdown is-right is-boxed">
                <a class="navbar-item">
                    Dashboard
                </a>
                <a class="navbar-item" @click="logout">
                    Logout
                </a>
            </div>
        </div>
        <div class="buttons navbar-item" v-else>
            <a class="button login-button" @click="login">
                    <span class="icon">
                      <i class="fab fa-steam"></i>
                    </span>
                <span>LOGIN</span>
            </a>
        </div>
    </div>
    <div v-else style="display: inherit">
        <span class="navbar-item router-link-active">
            LOADING
        </span>
    </div>
</template>
<script>
import session from "../store/session.js";
import axios from "axios"

export default {
    name: "Loginbutton",
    methods: {
        login() {
            window.location = "/login"
        },
        logout() {
            axios.post("/logout/").then(res => {
                session.fetch();
            })
        }
    },
    data() {
        return {
            state: session.state
        }
    },
}
</script>

<style scoped>

</style>
