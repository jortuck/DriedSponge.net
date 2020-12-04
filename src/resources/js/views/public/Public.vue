<template>
    <main>
        <Nav/>
        <router-view/>
    </main>
    <Footer/>
</template>
<script>
import Footer from "../../components/includes/Footer";
import Nav from "./Nav";

export default {
    name: "Public",
    components: {Nav, Footer}
}
</script>
