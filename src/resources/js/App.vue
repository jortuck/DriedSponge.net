<template>
    <router-view/>
</template>
<script>
import Nav from "./views/public/Nav"
import Footer from "./components/includes/Footer/Footer";
import AOS from 'aos';

export default {
    name: 'App',
    components: {
        Nav,
        Footer
    },
    props: {
        manage: {
            required: false,
        }
    },
    beforeMount() {
        AOS.init({once:true,disable: 'phone'})

    }

}
</script>
