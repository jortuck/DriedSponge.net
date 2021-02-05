<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="servers.length === 0" class="has-text-centered">
        <h1 class="title is-3 my-4 mc-text has-text-white">No servers exist at the moment...</h1>
    </div>
    <div class="container" v-else>
        <div class="columns is-multiline is-centered">
            <div class="column is-6" v-for="server in servers" :key="server.name" data-aos="fade-in">
                <div class="box mc-server cursor-pointer" v-if="server.online" @click="goto(server.slug)">
                    <h1 class="title server-name is-5 mc-text is-size-6-mobile">{{ server.name }}<span
                        class="ping is-online is-size-6-mobile">{{ server.status.players.online }}/{{ server.status.players.max }}</span>
                    </h1>
                    <h2  v-if="server.status.description.text">
                        <span class="subtitle is-5 mc-text is-size-6-mobile" v-html="server.status.description.text"></span>
                    </h2>
                </div>
                <div class="box mc-server cursor-pointer" v-else @click="goto(server.slug)">
                    <p class="title server-name is-5 mc-text is-size-6-mobile">{{ server.name }}<span class="ping-offline"></span></p>
                    <span class="subtitle is-5 mc-text is-size-6-mobile">
                        <span style="color: #AA0000">Server Offline</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="has-text-centered">
        <button data-aos="fade-in" data-aos-delay="300" class="button has-text-centered mc-text is-primary my-1"
                @click="this.fetch">Refresh
        </button>
    </div>
</template>
<script>
import axios from 'axios'
import Icon from "../../../../components/text/Icon";
import {toast} from "../../../../components/helpers/toasts";

export default {
    name: "Serverlist",
    components: {Icon},
    data() {
        return {
            servers: {},
            loading: true
        }
    },
    beforeMount() {
        this.fetch()
    },
    methods: {
        goto(slug) {
            this.$router.push({name: "mc-server", params: {slug}})
        },
        fetch() {
            axios.get("/api/mc/servers").then(res => {
                this.servers = res.data.data;
                this.loading = false;
            })
                .catch(error => {
                    this.loading = false;
                    toast("toast-is-danger", "An error occurued on the server, please try again later!")
                })
        }
    }
}
</script>
