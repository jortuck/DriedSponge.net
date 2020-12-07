<template>
    <slot v-if="can(permission)"></slot>
</template>

<script>
import session from "../../store/session";

export default {
    name: "Can",
    props: {
        permission:{
            type: String,
            required: true
        }
    },
    methods:{
        can(perm){
            if(session.can(perm)){
                return true
            }else{
                return false
            }
        }
    }
}
</script>

<style scoped>

</style>
