<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="players.length === 0" class="has-text-centered">
        <h1 class="title is-3 my-4 mc-text has-text-white">No one has played...</h1>
    </div>
    <div class="container" v-else>
        <div class="columns is-multiline is-centered has-text-centered" >
            <div class="column is-4" v-for="player in players" :key="player.username" data-aos="fade-in">
                <div class="box mc-server">
                    <h1 class="title is-4 mc-text mb-6 has-text-warning is-size-5-mobile">{{player.username }}</h1>

                    <h2 class="subtitle is-5 mc-text has-text-white is-size-6-mobile" v-if="player.servers.length !== 0">Servers Played On:</h2>

                    <div class="tags has-addons mc-text is-centered" v-if="player.servers.length !== 0">
                        <router-link :to="{'name':'mc-server','params':{'slug':server.slug}}" v-for="server in player.servers">
                            <span class="tag is-dark is-success">{{server.name}}</span>
                        </router-link>
                    </div>

                    <h2 class="subtitle is-5 mc-text has-text-danger" v-else>No info on this player yet!</h2>
                    <router-link class="mc-text" :to="{'name':'mc-player','params':{'slug':player.username}}" >Stats</router-link>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="has-text-centered">
        <button class="button has-text-centered mc-text is-primary my-1" @click="this.fetch">Refresh</button>
    </div>
</template>
<script>
import axios from 'axios'
import Icon from "../../../../components/text/Icon";
import {toast} from "../../../../components/helpers/toasts";

export default {
    name: "Playerlist",
    components: {Icon},
    data() {
        return {
            players: {},
            loading: true
        }
    },
    beforeMount() {
        this.fetch()
    },
    methods:{
        goto(slug){
            this.$router.push({name:"mc-server",params:{slug}})
        },
        fetch(){
            axios.get("/api/mc/players").then(res => {
                this.players = res.data.data;
                this.loading = false;
            })
            .catch(error=>{
                this.loading = false;
                toast("toast-is-danger","An error occurued on the server, please try again later!")
            })
        }
    }
}
</script>
