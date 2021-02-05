<template>
    <a :href="to" target="_blank" class="button is-light is-outlined" v-if="isExternal">
        <slot></slot>
    </a>
    <router-link v-else :to="to" class="button is-light is-outlined">
        <slot></slot>
    </router-link>
</template>
<script>
export default {
    name: "Footerlink",
    props:{
        to:{
            required: true,
        }
    },
    computed:{
        isExternal(){
            return typeof this.to === 'string';
        }
    }
}
</script>
