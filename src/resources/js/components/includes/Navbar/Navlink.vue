<template>
    <router-link class="navbar-item" :to="to" exact-active-class="is-active" v-if="can">
        <slot></slot>
    </router-link>
</template>
<script>
export default {
    name: "Navlink",
    props: {
        permission: {
            type: String,
            required: false
        },
        to: {
            required: false,
            default: {"name":"home"}
        }
    },
    computed:{
        can(){
            if(!this.permission){
                return true;
            }
            return this.$store.state.permissions[this.permission] || this.$store.state.permissions["*"];
        }
    }
}
</script>
