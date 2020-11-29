<template>
    <span class="icon">
         <i v-bind:class="icon"></i>
    </span>
</template>

<script>
export default {
    name: "Icon",
    props: {
        icon:{
            type: String,
            required: true
        },
    },
}
</script>
