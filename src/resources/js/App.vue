<template>
    <Nav/>
    <router-view/>
</template>
<script>
import Nav from "./components/inc/Nav"
export default {
    name: 'App',
    components: {
        Nav
    },
}
</script>
