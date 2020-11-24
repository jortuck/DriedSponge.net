<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span class="has-text-primary">DRIED</span> SPONGE
        </Pagehead>
        <div class="has-text-centered mt-5" data-aos="fade-up">
            <a class="white-link" target="_blank" href="https://twitter.com/dried_sponge">
                <Icon classes="is-large is-me mx-4" icon="fab fa-twitter fa-3x"/>
            </a>
            <a class="white-link" target="_blank" href="https://steamcommunity.com/id/driedsponge/">
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
    <section class="section" data-aos="fade-up">
        <div class="container">
            <div class="tile is-ancestor has-text-centered">
                <div class="tile is-4 is-vertical">
                    <div class="tile is-parent">
                        <div class="tile is-child box">
                            <h1 class="title mb-3">Discord Bots</h1>
                            <div class="content is-medium">
                                <Icon classes="is-medium mx-2" icon="fab fa-python fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-node fa-2x"/>
                                <br>
                                dsag agahdejkr hjwgokjh gwjklg hwkgrlj wbgwkelg bwkj glb wgklw jbngwg
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile is-4 is-vertical">
                    <div class="tile is-parent">
                        <div class="tile is-child box">
                            <h1 class="title mb-3">Web Development</h1>
                            <div class="content is-medium">
                                <Icon classes="is-medium mx-2" icon="fab fa-laravel fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-php fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-vuejs fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-css3-alt fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-sass fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-html5 fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-js fa-2x"/>
                                <br>
                                dsagagah dejkrh jwgok jhg wjklg hwkg rlj wbgwk elgbw kjg lbwg klwj bngwg
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tile is-4 is-vertical">
                    <div class="tile is-parent">
                        <div class="tile is-child box">
                            <h1 class="title mb-3">Server Infrastructure</h1>
                            <div class="content is-medium">
                                <Icon classes="is-medium mx-2" icon="fab fa-docker fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-linux fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-ubuntu fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-digital-ocean fa-2x"/>
                                <Icon classes="is-medium mx-2" icon="fab fa-cloudflare fa-2x"/>
                                <br>
                                Web services require servers, databases, and other types of infrastructure to operate. I
                                got tired of paying for shared hosting, so I taught myself how to setup and operate my
                                own servers running linux.
                                I also taught myself how to use docker, so I can effieciently deploy applications at
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
}
</script>
