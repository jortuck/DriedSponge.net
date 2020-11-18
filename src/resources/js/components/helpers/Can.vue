<template>
    <slot v-if="can"></slot>
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
    created() {
        this.can = session.can("Manage.See");
    },
    data(){
        return{
            can: false
        }
    }
}
</script>

<style scoped>

</style>
