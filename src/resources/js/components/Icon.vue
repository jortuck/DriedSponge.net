<template>
    <span title="tooltips"  v-bind:class="spanClasses">
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
        classes:{
            type: String,
            required: false
        }
    },
    computed:{
        spanClasses(){
            return "icon "+this.classes;
        }
    }
}
</script>

<style scoped>

</style>
