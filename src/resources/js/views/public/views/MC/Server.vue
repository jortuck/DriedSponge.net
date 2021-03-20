<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="notfound" class="has-text-centered">
        <h1 class="title mb-6 mc-text has-text-white" data-aos="fade-in">The server you are looking for could not be
            found!</h1>
    </div>
    <div v-else class="container">
        <div class="box mc-server" data-aos="fade-in">

            <p class="title is-4 is-size-5-mobile mc-text has-text-white mb-5">
                {{ server.name }}
                <span class="ping is-online"
                      v-if="server.online">{{ server.playerCount.online }}/{{ server.playerCount.total }}</span>
                <span class="ping is-offline" v-else>Offline</span>
            </p>

            <div class="content">
                <p class="subtitle is-5 is-size-6-mobile mc-text " v-if="server.online">
                    <span v-html="server.message"></span>
                </p>

                <p class="subtitle is-5 is-size-6-mobile mc-text" v-if="server.description">
                    <span class="has-text-white">{{ server.description }}</span>
                </p>
            </div>

            <div class="content" v-if="server.players.length !== 0">
                <p  class="subtitle is-5 is-size-6-mobile mc-text has-text-white mb-4">Players:</p>
                <div class="tags has-addons">
                    <router-link :to="{'name':'mc-player','params':{'slug':player.username}}" class="mc-text mr-2"
                                 v-for="player in server.players">
                        <span class="tag">{{ player.username }}</span>
                        <span class="tag is-success" v-if="player.online">Online</span>
                        <span class="tag is-danger" v-else>Offline</span>
                    </router-link>
                </div>
            </div>

            <div class="content" v-if="server.mods">
                <p class="subtitle is-5 is-size-6-mobile mc-text has-text-white mb-4">Mods:</p>
                <div class="tags has-addons">
                    <span class="mc-text mr-3" v-for="mod in server.mods">
                        <span class="tag">{{ mod.modid }}</span>
                        <span class="tag is-success">{{ mod.version }}</span>
                    </span>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from "axios";
import httpError from "../../../../components/helpers/httpError";
import Icon from "../../../../components/text/Icon";

export default {
    name: "Server",
    components: {Icon},
    mounted() {
        axios.get("/api/mc/servers/" + this.$route.params.slug).then(res => {
            this.loading = false
            this.server = res.data.data
        })
            .catch(error => {
                if (error.response.status === 404) {
                    this.loading = false
                    this.notfound = true
                } else {
                    this.loading = false
                    httpError(err)
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
