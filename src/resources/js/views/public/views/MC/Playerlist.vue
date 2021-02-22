<template>
    <div v-if="loading" data-aos="fade-in" class="is-centered has-text-centered">
        <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
    </div>
    <div v-else-if="players.length === 0" class="has-text-centered">
        <h1 class="title is-3 my-4 mc-text mc-color-white">No one has played...</h1>
    </div>
    <div class="container" v-else>
        <div class="columns is-multiline is-centered has-text-centered" >
            <div class="column is-4" v-for="player in players" :key="player.username" data-aos="fade-in">
                <div class="box mc-server">
                    <h1 class="title is-4 mb-6 mc-text mc-color-gold is-size-5-mobile">{{player.username }}</h1>

                    <h2 class="subtitle is-5 mc-text has-text-white is-size-6-mobile" v-if="player.servers.length !== 0">Servers Played On:</h2>

                    <div class="tags has-addons mc-text is-centered" v-if="player.servers.length !== 0">
                        <router-link :to="{'name':'mc-server','params':{'slug':server.slug}}" v-for="server in player.servers">
                            <span class="tag is-primary">{{server.name}}</span>
                        </router-link>
                    </div>

                    <h2 class="subtitle is-5 mc-text mc-color-darkred" v-else>No info on this player yet!</h2>
                    <router-link class="button mc-button is-fullwidth" :to="{'name':'mc-player','params':{'slug':player.username}}" >Stats</router-link>

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
    name: "Playerlist",
    components: {Icon},
    data() {
        return {
            players: {},
            loading: true,
            refreshing: false,
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
            this.refreshing = true;
            axios.get("/api/mc/players").then(res => {
                this.players = res.data.data;
                this.loading = false;
                this.refreshing = false;
            })
            .catch(error=>{
                this.loading = false;
                this.refreshing = false;
                useToast().error("An error occurued on the server, please try again later!")
            })
        }
    }
}
</script>
