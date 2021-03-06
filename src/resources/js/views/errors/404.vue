<template>
    <div class="hero is-fullheight  has-text-centered is-bold is-large" >
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-size-1 has-text-white" data-aos="fade-in">
                    <span class="has-text-primary">4</span>0<span class="has-text-primary">4</span>
                </h1>
                <h2 class="subtitle has-text-white" data-aos="fade-in">
                    Not Found!
                </h2>
                <h3 class="is-5 has-text-white" data-aos="fade-in" v-if="quote">"{{quote}}" - {{author}}</h3>
                <br>
                <div class="buttons is-centered">
                    <router-link :to="{name:'home'}" class="button is-primary">
                        <Icon icon="fas fa-home" />
                        <span class="icon-text">
                            Home
                        </span>
                    </router-link>
                    <button @click="back" class="button is-primary">
                        <Icon icon="fas fa-arrow-left" />
                        <span class="icon-text">
                            Back
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagehead from "../../components/includes/Pagehead";
import axios from "axios";
import Icon from "../../components/text/Icon";
export default {
    name: "404",
    components: {Icon, Pagehead},
    data(){
        return{
            quote: null,
            author: null,
        }
    },
    mounted(){
        axios.get("https://www.breakingbadapi.com/api/quote/random",{withCredentials: false}).then(res=>{
          this.quote = res.data[0].quote
            this.author = res.data[0].author
        })
    },
    methods:{
        back(){
            this.$router.back();
        }
    }
}
</script>
