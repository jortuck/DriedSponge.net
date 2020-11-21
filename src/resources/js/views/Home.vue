<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span class="has-text-primary">DRIED</span> SPONGE
        </Pagehead>
        <div class="has-text-centered mt-5" data-aos="fade-up">
            <a class="white-link" target="_blank" href="https://steamcommunity.com/id/driedsponge/">
                <Icon classes="is-large mx-4" icon="fab fa-twitter fa-3x"/>
            </a>
            <a class="white-link" target="_blank" href="https://twitter.com/dried_sponge">
                <Icon classes="is-large mx-4" icon="fab fa-steam fa-3x"/>
            </a>
            <a class="white-link" href="https://discord.gg/YS4WZWG" target="_blank">
                <Icon classes="is-large mx-4" icon="fab fa-discord fa-3x"/>
            </a>
            <a class="white-link" href="https://github.com/driedsponge" target="_blank">
                <Icon classes="is-large mx-4" icon="fab fa-github fa-3x"/>
            </a>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="tile is-ancestor">
            </div>
        </div>
    </section>
</template>
<script>
import Pagehead from "../components/Pagehead";
import session from '../store/session.js'
import Icon from "../components/Icon";

export default {
    name: 'Home',
    components: {Pagehead, Icon},
    data: function () {
        return {
            subhead: "Full Stack Web Developer"
        }
    },
    setup() {
        session.fetch();
    },
}
</script>
