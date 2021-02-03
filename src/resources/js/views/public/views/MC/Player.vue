<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="notfound" class="has-text-centered">
        <h1 class="title mb-6 mc-text has-text-white">The server you are looking for could not be found!</h1>
    </div>
    <div v-else class="container">
        <div class="box mc-server">

            <p class="title is-3 mc-text has-text-warning mb-5 has-text-centered">
                {{ player.username }}
            </p>
            <div class="has-text-centered">
                <h2 class="subtitle is-5 mc-text has-text-white" v-if="player.servers.length !== 0">Servers Played On:</h2>
                <div class="tags has-addons mc-text is-centered" v-if="player.servers.length !== 0">
                    <router-link :to="{'name':'mc-server','params':{'slug':server.slug}}" v-for="server in player.servers">
                        <span class="tag is-dark is-success">{{server.name}}</span>
                    </router-link>
                </div>

                <br>
                <div class="control has-icons-left">
                    <span class="subtitle mc-text has-text-white is-5 mb-3">View Statistics For </span>
                    <div class="select mc-text is-small">
                        <select class="mc-text">
                            <template v-for="stat in stats">
                                <option class="mc-text">{{stat.server.name}}</option>
                            </template>
                        </select>
                    </div>
                </div>
                <div v-for="stat in selected_stats" >
                    {{stat}}
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import {toast} from "../../../../components/helpers/toasts";
import Icon from "../../../../components/text/Icon";
import tippy from "tippy.js";

export default {
    name: "Server",
    components: {Icon},
    mounted() {
        axios.get("/api/mc/players/" + this.$route.params.slug).then(res => {
            this.loading = false
            this.player = res.data.data
            this.stats = res.data.data.stats;
            this.selected_stats = JSON.parse(res.data.data.stats[0].stats) ;
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
            player: null,
            stats: null,
            selected_stats: null
        }
    }
}
</script>
