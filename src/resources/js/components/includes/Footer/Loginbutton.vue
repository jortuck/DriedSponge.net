<template>
    <a v-if="state.authenticated" class="button is-light is-outlined" @click="logout">
        <span class="icon-text">
           <Icon icon="fas fa-sign-out-alt"/>
           <span class="ml-1">Logout</span>
        </span>
    </a>
    <router-link class="button is-light is-outlined" :class="{'is-active':dropdown2_active}" :to="{'name':'login'}"
                 v-else>
        <span class="icon-text">
            <Icon icon="fas fa-sign-in-alt"/>
            <span>Login</span>
        </span>
    </router-link>
</template>
<script>
import Can from "../../helpers/Can";
import Icon from "../../text/Icon";

export default {
    name: "Loginbutton",
    methods: {
        logout() {
            this.$store.commit("logout");
        },
    },
    data() {
        return {
            state: this.$store.state,
            dropdown_active: false,
            dropdown2_active: false,
        }
    },
    components: {
        Icon,
        Can
    }
}
</script>
