<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="notfound" class="has-text-centered">
        <h1 class="title mb-6 mc-text has-text-white" data-aos="fade-in">The player you are looking for could not be found!</h1>
    </div>
    <div v-else class="container">
        <div class="box mc-server" data-aos="fade-in">

            <p class="title is-3 mc-text has-text-warning mb-5 has-text-centered">
                {{ player.username }}
            </p>
            <div class="has-text-centered">
                <h2 class="subtitle is-5 mc-text has-text-white" v-if="player.servers.length !== 0">Servers Played On:</h2>
                <div class="tags mc-text is-centered" v-if="player.servers.length !== 0">
                    <router-link :to="{'name':'mc-server','params':{'slug':server.slug}}" v-for="server in player.servers">
                        <span class="tag is-dark is-success">{{server.name}}</span>
                    </router-link>
                </div>

                <br>

                <div class="control has-icons-left mb-5" v-if="stats.length !== 0">
                    <span class="subtitle mc-text has-text-white is-5 mb-3">View Statistics For </span>
                    <div class="select mc-text is-small mc-select" :class="{'is-loading':loadingStats}">
                        <select class="mc-text" @change="fetchStats($event.target.value)">
                            <template v-for="stat in stats">
                                <option :value="stat.server.slug" class="mc-text">{{stat.server.name}}</option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="tags has-addons mc-text is-centered m-4"  v-if="stats.length !== 0">
                    <template v-for="(key, value) in currstats" data-aos="fade-in">
                        <span class="mx-1">
                            <span class="tag">
                            {{value}}
                            </span>
                            <span class="tag is-primary">
                            {{key}}
                            </span>
                        </span>
                    </template>
                </div>
                <p class="subtitle has-text-white has-text-danger mc-text is-5" v-else>There appears to be no statistical data on this player yet!<br></p>
                <p class="subtitle has-text-white has-text-centered mc-text is-6">* Stats are updated every time the player disconnects from the server *</p>
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
    name: "Player",
    components: {Icon},
    mounted() {
        axios.get("/api/mc/players/" + this.$route.params.slug).then(res => {
            this.loading = false
            this.player = res.data.data
            this.stats = res.data.data.stats;
            this.fetchStats(res.data.data.stats[0].server.slug)
        })
        .catch(err => {
            if(err.response){
                if (err.response.status === 404) {
                    this.loading = false
                    this.notfound = true
                } else {
                    this.loading = false
                    toast("toast-is-danger", "Something went wrong on the server side of things, plese try again later.")
                }
            }
        })

    },
    methods:{
      fetchStats(server){
        if(!this.notfound){
            this.loadingStats = true;
            axios.get("/api/mc/players/"+this.$route.params.slug+"/stats/"+server).then(res =>{
                this.currstats = res.data.data.stats
                this.loadingStats = false;

            })
            .catch(err=>{
                this.loadingStats = false;
                switch (err.response.status){
                    case 404:
                        toast("toast-is-danger", "No stats found for this server")
                        break;
                    default:
                        toast("toast-is-danger", "Something went wrong on the server side of things, plese try again later.")
                        break;
                }
            })
        }
      }
    },
    data() {
        return {
            loading: true,
            notfound: false,
            player: null,
            stats: null,
            currstats: null,
            loadingStats: false
        }
    }
}
</script>
