<template>
    <section class="section">
        <div class="container">
            <div class="columns is-justify-content-center">
                <div class="column is-6-desktop is-12-mobile is-10-tablet">
                    <div class="box" v-if="session.authenticated" data-aos="fade-in">
                        <h2 class="title has-text-centered is-3 has-text-danger">You are already logged in!</h2>
                    </div>
                    <div class="box" v-else data-aos="fade-in">
                        <h2 class="title has-text-centered is-3">Login</h2>
                        <p class="block has-text-danger has-text-centered has-text-weight-bold">
                            This is just for me to login and access my dashboard. You can login if you want but it does
                            absolutley nothing for you :).
                        </p>
                        <div class="buttons are-large">
                            <a  v-for="provider in providers" :href="provider.url" class="button is-fullwidth">
                                <Icon :icon="provider.icon" class="is-left"/>
                                <span class="icon-text">Login With {{ provider.name }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Icon from "../../../components/text/Icon";

export default {
    name: "Login",
    components: {Icon},
    data() {
        return {
            session: this.$store.state,
            providers: [
                {name: "Github", icon: "fab fa-github", url: "/app/login/github"},
                {name: "Discord", icon: "fab fa-discord", url: "/app/login/discord"}
            ]
        }
    }
}
</script>
