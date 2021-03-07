<template>
    <slot v-if="can"></slot>
</template>

<script>
export default {
    name: "Can",
    props: {
        permission:{
            type: String,
            required: true
        }
    },
    computed:{
        can(){
            return this.$store.state.permissions[this.permission] || this.$store.state.permissions["*"];
        }
    }
}
</script>
