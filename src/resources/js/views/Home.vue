<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span class="has-text-primary">DRIED</span> SPONGE
        </Pagehead>
        <div class="has-text-centered mt-5" data-aos="fade-up">
            <a class="white-link" target="_blank" href="https://twitter.com/dried_sponge">
                <Icon class="is-large is-me mx-4" icon="fab fa-twitter fa-3x"/>
            </a>
            <a class="white-link" target="_blank" href="https://steamcommunity.com/id/driedsponge/">
                <Icon class="is-large mx-4" icon="fab fa-steam fa-3x"/>
            </a>
            <a class="white-link" href="https://discord.gg/YS4WZWG" target="_blank">
                <Icon class="is-large mx-4" icon="fab fa-discord fa-3x"/>
            </a>
            <a class="white-link" href="https://github.com/driedsponge" target="_blank">
                <Icon class="is-large mx-4" icon="fab fa-github fa-3x"/>
            </a>
        </div>
    </section>
    <section class="section" data-aos="fade-up">
        <div class="container">
            <div class="tile is-ancestor has-text-centered">
                <div class="tile is-4 is-vertical">
                    <div class="tile is-parent">
                        <div class="tile is-child box">
                            <h1 class="title mb-3">Discord Bots</h1>
                            <div class="content is-medium">
                                <Icon class="is-medium mx-2" icon="fab fa-python fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-node fa-2x"/>
                                <br>
                                Aside from Web Development, I make discord bots. I'm familiar with both Discord JS and
                                Discord PY. I actually used Discord PY to teach myself Python. I use these skills to
                                make functional and efficient discord bots. Sometimes I make bots for myself (just for
                                fun), or I take on jobs from other people.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile is-4 is-vertical">
                    <div class="tile is-parent">
                        <div class="tile is-child box">
                            <h1 class="title mb-3">Web Development</h1>
                            <div class="content is-medium">
                                <Icon class="is-medium mx-2" icon="fab fa-laravel fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-php fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-vuejs fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-css3-alt fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-sass fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-html5 fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-js fa-2x"/>
                                <br>
                                Full stack web development is my strongest suit. I've been developing websites for about
                                {{ webtime.string }}. I'm skilled in many web development technologies (see icons above). I use these skills to create optimized websites with slick user interfaces and pleasant user experiences.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile is-4 is-vertical">
                    <div class="tile is-parent">
                        <div class="tile is-child box">
                            <h1 class="title mb-3">Server Infrastructure</h1>
                            <div class="content is-medium">
                                <Icon class="is-medium mx-2" icon="fab fa-docker fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-linux fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-ubuntu fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-digital-ocean fa-2x"/>
                                <Icon class="is-medium mx-2" icon="fab fa-cloudflare fa-2x"/>
                                <br>
                                Web services require servers, databases, and other types of infrastructure to operate. I
                                got tired of paying for shared hosting, so I taught myself how to setup and operate my
                                own servers running linux.
                                I also taught myself how to use docker, so I can efficiently deploy applications at
                                scale.
                            </div>
                        </div>
                    </div>
                </div>
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
    computed: {
        webtime() {
            let efromnow = Math.floor(Date.now() / 1000) - 1567728000;
            let years = Math.floor((efromnow) / 31536000);
            let months = Math.floor((efromnow) / 2628288) - 12 * years;
            return {
                string: years + " year(s) and " + months + " month(s)",
                months: months,
                year: years
            };
        }
    }
}
</script>
