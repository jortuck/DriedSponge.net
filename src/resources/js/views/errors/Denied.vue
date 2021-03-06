<template>
    <div class="hero is-fullheight  has-text-centered is-bold is-large" >
        <div class="hero-body">
            <div class="container">
                <h1 class="title is-size-1 has-text-danger">
                    403
                </h1>
                <h2 class="subtitle has-text-white">
                    Access Denied!
                </h2>
                <h2 class="subtitle has-text-white">
                    <span v-if="!session.authenticated"><router-link :to="{'name':'login'}" class="white-link">Login</router-link> | </span><router-link class="white-link" :to="{'name':'home'}">Home</router-link>
                </h2>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Denied",
    data(){
        return{
            session: this.$store.state
        }
    }
}
</script>
