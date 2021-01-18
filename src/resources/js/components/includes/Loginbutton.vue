<template>
    <div v-if="state.authenticated" class="dropdown is-up is-right" :class="{'is-active':dropdown_active}">
        <div class="dropdown-trigger">
            <button class="button is-light is-outlined" aria-haspopup="true" aria-controls="user-dropdown"
                    @click="this.dropdown_active = !this.dropdown_active">
                <Icon class="is-left" icon="fas fa-angle-up"/>
                <span>{{ state.user.username }}</span>
            </button>
        </div>
        <div class="dropdown-menu" id="user-dropdown" role="menu">
            <div class="dropdown-content">
                <Can permission="Manage.See">
                    <router-link class="dropdown-item" :to="{name:'manage'}">
                        <Icon class="has-text-primary is-left" icon="fas fa-columns"/>
                        <span class="ml-1">Dashboard</span>
                    </router-link>
                </Can>
                <a class="dropdown-item" @click="logout">
                    <Icon class="has-text-danger is-left" icon="fas fa-sign-out-alt"/>
                    <span class="ml-1">Logout</span>
                </a>
            </div>
        </div>
    </div>
    <div class="dropdown is-up is-right" :class="{'is-active':dropdown2_active}" v-else>
        <div class="dropdown-trigger">
            <button class="button is-light is-outlined" aria-haspopup="true" aria-controls="user-dropdown"
                    @click="this.dropdown2_active = !this.dropdown2_active">
                <Icon class="is-left" icon="fas fa-angle-up"/>
                <span>Login</span>
            </button>
        </div>
        <div class="dropdown-menu" role="menu">
            <div class="dropdown-content">
                <a class="dropdown-item" @click="login('github')">
                    <Icon class="is-left" icon="fab fa-github"/>
                    <span class="ml-1">Github</span>
                </a>
                <a class="dropdown-item" @click="login('discord')">
                    <Icon class="is-left" icon="fab fa-discord"/>
                    <span class="ml-1">Discord</span>
                </a>
            </div>
        </div>
    </div>
</template>
<script>
import session from "../../store/session.js";
import Can from "../helpers/Can";
import Icon from "../text/Icon";
import tippy from "tippy.js";

export default {
    name: "Loginbutton",
    methods: {
        logout() {
            session.logout();
        },
        setToolTip() {
            tippy(this.$refs.lb, {
                content: "This is just for me to login and access my dashboard. You can login if you want but it does absolutley nothing for you.",
                theme: "danger",
            });
        },
        login(provider){
            session.login(provider);
        }
    },
    mounted() {
        this.setToolTip()
    },
    data() {
        return {
            state: session.state,
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
