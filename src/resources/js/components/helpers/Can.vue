<template>
    <slot v-if="can(permission)"></slot>
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
    methods:{
        can(perm){
            return this.$store.dispatch ("can", perm);
        }
    }
}
</script>
