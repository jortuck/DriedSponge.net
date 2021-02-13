<template>
    <div class="block">
        {{msg}}
        <br>
        <a class="has-text-white is-underlined" href="#" @click="copy">
            Copy The Token
        </a>
    </div>
</template>

<script>
import tippy from "tippy.js";
import Icon from "./Icon";

export default {
    name: "Token",
    components: {Icon},
    props:{
        token:{
            type: String,
            required: true
        },
        msg:{
            type: String,
            required: true
        }
    },
    methods:{
        copy(e){
            navigator.clipboard.writeText(this.token)
            tippy(e.target, {
                content: "Copied!",
                onHidden(instance) {
                    instance.destroy()
                },
            }).show();
        }
    }
}
</script>
