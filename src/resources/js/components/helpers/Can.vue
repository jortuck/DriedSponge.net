<template>
    <slot v-if="can.permissions[permission]"></slot>
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
    data(){
        return{
            can: session.state
        }
    }
}
</script>

<style scoped>

</style>
