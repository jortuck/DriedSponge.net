<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span style="color: #62A1EC">DRIED</span> SPONGE
        </Pagehead>
    </section>
</template>
<script>
import Pagehead from "../components/Pagehead";
import session from '../store/session.js'
import Can from "../components/helpers/Can"
export default {
    name: 'Home',
    components: {Pagehead, Can},
    data: function () {
        return {
            subhead: "Full Stack Web Developer"
        }
    },
    setup(){
        session.fetch();
    },
}
</script>
