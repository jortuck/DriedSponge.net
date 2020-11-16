<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span style="color: #62A1EC">DRIED</span> SPONGE
        </Pagehead>
    </section>
</template>
<script>
import Pagehead from "../components/Pagehead";
import axios from 'axios'
import session from '../store/session.js'
export default {
    name: 'Home',
    components: {Pagehead},
    data: function () {
        return {
            subhead: "Full Stack Web Developer"
        }
    },
    setup(){
        session.fetch();
    }
}
</script>
