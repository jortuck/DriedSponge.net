<template>
    <section class="section">
        <Pagehead v-bind:sub_header="subhead">
            <span class="has-text-primary">DRIED</span> SPONGE
        </Pagehead>
        <div class="has-text-centered mt-5" data-aos="fade-up">
            <Whitelink target="_blank" href="https://twitter.com/dried_sponge">
                <Icon tooltip="Twitter" class="is-large is-me mx-4" icon="fab fa-twitter fa-3x"/>
            </Whitelink>
            <Whitelink target="_blank" href="https://steamcommunity.com/id/driedsponge/">
                <Icon tooltip="Steam" class="is-large mx-4" icon="fab fa-steam fa-3x"/>
            </Whitelink>
            <Whitelink @click="copydiscord" ref="discordbtn">
                <Icon class="is-large mx-4" icon="fab fa-discord fa-3x"/>
            </Whitelink>
            <Whitelink class="white-link" href="https://github.com/driedsponge" target="_blank">
                <Icon tooltip="Github" class="is-large mx-4" icon="fab fa-github fa-3x"/>
            </Whitelink>
        </div>
    </section>
    <section class="section" data-aos="fade-up">
        <div class="container">
            <Tileancestor class="has-text-centered">
                <Homecard heading="Discord Bots">
                    <Icon tooltip="Python" class="is-medium mx-2" icon="fab fa-python fa-2x"/>
                    <Icon tooltip="NodeJS" class="is-medium mx-2" icon="fab fa-node fa-2x"/>
                    <br>
                    Aside from Web Development, I make discord bots. I'm familiar with both Discord JS and
                    Discord PY. I actually used Discord PY to teach myself Python. I use these skills to
                    make functional and efficient discord bots. Sometimes I make bots for myself (just for
                    fun), or I take on jobs from other people.
                </Homecard>
                <Homecard heading="Web Development">
                    <Icon tooltip="Laravel" class="is-medium mx-2" icon="fab fa-laravel fa-2x"/>
                    <Icon tooltip="PHP" class="is-medium mx-2" icon="fab fa-php fa-2x"/>
                    <Icon tooltip="VueJS" class="is-medium mx-2" icon="fab fa-vuejs fa-2x"/>
                    <Icon tooltip="CSS3" class="is-medium mx-2" icon="fab fa-css3-alt fa-2x"/>
                    <Icon tooltip="SASS" class="is-medium mx-2" icon="fab fa-sass fa-2x"/>
                    <Icon tooltip="HTML" class="is-medium mx-2" icon="fab fa-html5 fa-2x"/>
                    <Icon tooltip="JavaScript" class="is-medium mx-2" icon="fab fa-js fa-2x"/>
                    <br>
                    Full stack web development is my strongest suit. I've been developing websites for about
                    {{ webtime.string }}. I'm skilled in many web development technologies (see icons
                    above). I use these skills to create optimized websites with slick user interfaces and
                    pleasant user experiences.
                </Homecard>
                <Homecard heading="Server Infrastructure">
                    <Icon tooltip="Docker" class="is-medium mx-2" icon="fab fa-docker fa-2x"/>
                    <Icon tooltip="Linux" class="is-medium mx-2" icon="fab fa-linux fa-2x"/>
                    <Icon tooltip="Digital Ocean" class="is-medium mx-2" icon="fab fa-digital-ocean fa-2x"/>
                    <Icon tooltip="Cloudflare" class="is-medium mx-2" icon="fab fa-cloudflare fa-2x"/>
                    <br>
                    Web services require servers, databases, and other types of infrastructure to operate. I
                    got tired of paying for shared hosting, so I taught myself how to setup and operate my
                    own servers running linux.
                    I also taught myself how to use docker, so I can efficiently deploy applications at
                    scale.
                </Homecard>
            </Tileancestor>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <Contactform/>
        </div>
    </section>
</template>
<script>
import Pagehead from "../../../components/includes/Pagehead";
import session from '../../../store/session.js'
import Icon from "../../../components/text/Icon";
import Whitelink from "../../../components/text/Whitelink"
import Tileancestor from "../../../components/tiles/Tileancestor";
import Homecard from "../../../components/Home/Homecard";
import Contactform from "../../../components/Home/Contactform";
import tippy from "tippy.js";
export default {
    name: 'Home',
    components: {Pagehead, Icon, Whitelink, Tileancestor, Homecard,Contactform},
    data: function () {
        return {
            subhead: "Full Stack Web Developer (i can code web stuff)",
            discord_status: {
                msg: "(Click to copy)",
            }
        }
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
    },
    methods:{
        copydiscord(e){
            navigator.clipboard.writeText("DriedSponge#4730")
            tippy(e.target, {
                content: "Copied!",
                theme:"success",
                onHidden(instance) {
                    instance.destroy()
                },
            }).show();
        }
    }
}
</script>
