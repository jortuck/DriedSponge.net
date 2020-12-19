<template>
    <span class="icon" ref="root" >
         <i v-bind:class="icon"></i>
    </span>
</template>

<script>
import tippy from 'tippy.js';

export default {
    name: "Icon",
    props: {
        icon: {
            type: String,
            required: true
        },
        tooltip: {
            type: String,
            required: false,
        },
        tooltiptheme:{
            type:String,
            required: false
        }

    },
    mounted() {
        if (this.tooltip) {
            tippy(this.$refs.root, {
                content: this.tooltip,
                allowHTML: true,
                theme: this.tooltiptheme,
            });
        }
    }
}
</script>
