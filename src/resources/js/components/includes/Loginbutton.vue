<template>
    <div v-if="state.loaded" style="display: inherit">
        <div v-if="state.authenticated" class="dropdown is-up is-right" :class="{'is-active':dropdown_active}">
            <div class="dropdown-trigger">
                <button class="button is-light is-outlined" aria-haspopup="true" aria-controls="user-dropdown" @click="toggleDropdown">
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
        <a ref="loginbutton" class="button is-light is-outlined" @click="login" v-else>
                    <span class="icon">
                      <i class="fab fa-steam"></i>
                    </span>
            <span>LOGIN</span>
        </a>
    </div>
    <a class="button is-light is-outlined" v-else>
        <span class="icon"><i class="fas fa-sync fa-spin"></i></span>
    </a>
</template>
<script>
import session from "../../store/session.js";
import Can from "../helpers/Can";
import Icon from "../text/Icon";
import tippy from "tippy.js";

export default {
    name: "Loginbutton",
    methods: {
        login() {
            session.login()
        },
        logout() {
            session.logout();
        },
        toggleDropdown(){
          this.dropdown_active = !this.dropdown_active;
        }
    },
    mounted() {
        console.log("test")
        tippy(this.$refs.loginbutton, {
            content: "This is just for me to login and access my dashboard. You can login if you want but it does absolutley nothing for you.",
            theme:"danger",
        });
    },
    data() {
        return {
            state: session.state,
            dropdown_active: false
        }
    },
    components: {
        Icon,
        Can
    }
}
</script>
