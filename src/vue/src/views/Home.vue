<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span style="color: #62A1EC">DRIED</span> SPONGE
        </Pagehead>
    </section>
</template>
<script>
import Pagehead from "@/components/Pagehead";
import axios from 'axios';

export default {
    name: 'Home',
    components: {Pagehead},
    data: function () {
        return {
            subhead: "Full Stack Web Developer"
        }
    },
    setup: function () {
        axios.get("http://localhost:8000/sanctum/csrf-cookie").then(response => {
            console.log(response);
            axios.get("http://localhost:8000/user").then(res => {
                console.log(res);
            })
        })

    }
}
</script>
