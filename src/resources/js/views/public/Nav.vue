<template>
    <nav data-aos="fade-down" class="navbar mb-5" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://driedsponge.net">
                    <span class="has-text-primary">D</span><span class="has-text-white">S</span>
                </a>
                <a @click="toggleNav" role="button" class="navbar-burger burger" :class="{'is-active':navbarToggled}"
                   aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu" :class="{'is-active':navbarToggled}">
                <div class="navbar-end">
                    <router-link class="navbar-item" :to="{ name: 'home'}" exact-active-class="is-active">Home</router-link>
                    <router-link class="navbar-item" :to="{ name: 'projects'}" exact-active-class="is-active">Projects</router-link>
                    <Navlogin />
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import Snowcontroller from '../../components/includes/Snowcontroller';
import Navlogin from "../../components/includes/Navbar/Navlogin";

export default {
    name: "Nav",
    components: {
        Navlogin,
        Snowcontroller
    },
    data() {
        return {
            navbarToggled: false
        }
    },
    methods: {
        toggleNav() {
            this.navbarToggled = !this.navbarToggled;
        }
    }
}
</script>

<style scoped>

</style>
