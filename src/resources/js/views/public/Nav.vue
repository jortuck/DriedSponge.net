<template>
    <Navbar>
        <router-link class="navbar-item" :to="{ name: 'home'}" exact-active-class="is-active">Home</router-link>
        <router-link class="navbar-item" :to="{ name: 'projects'}" exact-active-class="is-active">Projects</router-link>
        <Navlogin />
    </Navbar>
</template>
<script>
import Navlogin from "../../components/includes/Navbar/Navlogin";
import Navbar from "../../components/includes/Navbar/Navbar";

export default {
    name: "Nav",
    components: {
        Navbar,
        Navlogin
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
