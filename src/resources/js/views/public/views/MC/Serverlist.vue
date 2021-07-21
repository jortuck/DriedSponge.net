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
                    <h1 class="title is-5 mc-text  mc-color-white is-size-6-mobile">{{ server.name }}<span
                        class="ping is-online is-size-6-mobile">{{ server.status.players.online }}/{{ server.status.players.max }}</span>
                    </h1>
                    <h2  v-if="server.status.description">
                        <span class="subtitle is-5 mc-text is-size-6-mobile" v-html="server.status.description"></span>
                    </h2>
                </div>
                <div class="box mc-server cursor-pointer" v-else @click="goto(server.slug)">
                    <p class="title is-5 mc-text  mc-color-white is-size-6-mobile">{{ server.name }}<span class="ping-offline"></span></p>
                    <span class="subtitle is-5 mc-text mc-color-darkred is-size-6-mobile">Server Offline</span>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="has-text-centered"  data-aos="fade-in">
        <button
                class="button mc-button has-text-centered my-1"
                @click="fetch" :class="{'is-loading':refreshing}">
            Refresh
        </button>
    </div>
</template>
<script>
import axios from 'axios'
import Icon from "../../../../components/text/Icon";
import {POSITION, useToast} from "vue-toastification";

export default {
    name: "Serverlist",
    components: {Icon},
    data() {
        return {
            servers: {},
            loading: true,
            refreshing: false,
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
            this.refreshing = true
            axios.get("/api/mc/servers").then(res => {
                this.servers = res.data.data;
                this.loading = false;
                this.refreshing = false
            })
            .catch(error => {
                this.loading = false;
                this.refreshing = false
                useToast().error("An error occurued on the server, please try again later!")
            })
        }
    }
}
</script>
