<template>
    <router-view/>
</template>
<script>
import Nav from "./views/public/Nav"
import Footer from "./components/includes/Footer/Footer";

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

}
</script>
