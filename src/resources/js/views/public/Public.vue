<template>
    <main>
        <Nav/>
        <router-view/>
    </main>
    <Footer/>
</template>
<script>
import Footer from "../../components/includes/Footer/Footer";
import Nav from "./Nav";

export default {
    name: "Public",
    components: {Nav, Footer}
}
</script>
