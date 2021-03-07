<template>
    <Navbar>
        <Navlink  v-for="nav in navlinks" :to="nav.to">{{nav.name}}</Navlink>
        <Navlogin />
    </Navbar>
</template>
<script>
import Navlogin from "../../components/includes/Navbar/Navlogin";
import Navbar from "../../components/includes/Navbar/Navbar";
import Navlink from "../../components/includes/Navbar/Navlink";

export default {
    name: "Nav",
    components: {
        Navlink,
        Navbar,
        Navlogin
    },
    data() {
        return {
            navbarToggled: false,
            navlinks:[
                {"name":"Home","to":{ name: 'home'}},
                {"name":"Projects","to":{ name: 'projects'}},
                {"name":"Minecraft","to":{ name: 'mc'}}
            ]
        }
    },
    methods: {
        toggleNav() {
            this.navbarToggled = !this.navbarToggled;
        }
    }
}
</script>
