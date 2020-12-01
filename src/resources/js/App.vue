<template>
    <main>
        <Nav/>
        <router-view/>
    </main>
    <Footer />
</template>
<script>
import Nav from "./components/includes/Navbar/Nav"
import Footer from "./components/includes/Footer";
export default {
    name: 'App',
    components: {
        Nav,
        Footer
    },
}
</script>
