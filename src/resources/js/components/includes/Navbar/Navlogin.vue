<template>
    <div v-if="state.authenticated" class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
            {{ state.user.username }}
        </a>
        <div class="navbar-dropdown is-right is-boxed">
            <Can permission="Manage.See">
                <router-link class="navbar-item" :to="{'name':'manage'}">
                    <span class="icon has-text-primary">
                      <i class="fas fa-home"></i>
                    </span>
                    <span class="ml-1">Dashboard</span>
                </router-link>
            </Can>
            <a class="navbar-item" @click="logout">
                    <span class="icon has-text-danger ">
                      <i class="fas fa-sign-out-alt"></i>
                    </span>
                <span class="ml-1">Logout</span>
            </a>
        </div>
    </div>
</template>
<script>
import session from "../../../store/session.js";
import Can from "../../helpers/Can";

export default {
    name: "Navlogin",
    methods: {
        logout() {
            session.logout();
        }
    },
    data() {
        return {
            state: session.state
        }
    },
    components: {
        Can
    }
}
</script>
<style scoped>
</style>
