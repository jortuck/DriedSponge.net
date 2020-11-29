<template>
    <Nav/>
    <router-view/>
</template>
<script>
import Nav from "./components/Navbar/Nav"
export default {
    name: 'App',
    components: {
        Nav
    },
}
</script>
