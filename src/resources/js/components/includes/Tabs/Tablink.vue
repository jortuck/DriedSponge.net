<template>
    <router-link custom :to="to"  v-slot="{ href,navigate, isActive,isExactActive}" v-if="can">
        <li :class="{'is-active':isExactActive}">
            <a :href="href"  @click="navigate"><slot></slot></a>
        </li>
    </router-link>
</template>
<script>
export default {
    name: "Tablink",
    props:{
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
