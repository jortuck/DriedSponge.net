<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="notfound" class="has-text-centered">
        <h1 class="title mb-6 mc-text has-text-white">The server you are looking for could not be found!</h1>
    </div>
    <div v-else class="container">
        <div class="box mc-server">
            <p class="title is-4 mc-text has-text-white mb-6">
                {{ server.name }}
                <span class="ping is-online" v-if="server.online">{{
                        server.status.players.online
                    }}/{{ server.status.players.max }}</span>
                <span class="ping is-offline" v-else>Offline</span>
            </p>
            <p class="subtitle is-5 mc-text">
                <span v-if="server.online" v-html="server.status.description.text + ' - '"></span><span
                class="has-text-white">{{ server.description }}</span>
            </p>
            <br>
            <p v-if="server.status.modinfo" class="subtitle is-5 mc-text has-text-white">Mods:</p>
            <div class="tags" v-if="server.online && server.status.modinfo">
                <div class="tags has-addons mc-text ml-2" v-for="mod in server.status.modinfo.modList">
                    <span class="tag">{{ mod.modid }}</span>
                    <span class="tag is-success">{{ mod.version }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import {toast} from "../../../../components/helpers/toasts";
import Icon from "../../../../components/text/Icon";

export default {
    name: "Server",
    components: {Icon},
    mounted() {
        axios.get("/api/mc/" + this.$route.params.slug).then(res => {
            this.loading = false
            this.server = res.data.data
        })
            .catch(error => {
                if (error.response.status === 404) {
                    this.loading = false
                    this.notfound = true
                } else {
                    this.loading = false
                    toast("toast-is-danger", "Something went wrong on the server side of things, plese try again later.")
                }
            })
    },
    data() {
        return {
            loading: true,
            notfound: false,
            server: null
        }
    }
}
</script>
