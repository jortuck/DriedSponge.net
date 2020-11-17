<template>
    <div v-if="state.loaded" style="display: inherit">
        <div v-if="state.authenticated" class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
                {{ state.user.username }}
            </a>
            <div class="navbar-dropdown is-right is-boxed">
                <a class="navbar-item">
                    <span class="icon has-text-primary">
                      <i class="fas fa-columns"></i>
                    </span>
                    <span class="ml-1">Dashboard</span>
                </a>
                <a class="navbar-item" @click="logout">
                    <span class="icon has-text-danger ">
                      <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <span class="ml-1">Logout</span>
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
            session.logout();
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
