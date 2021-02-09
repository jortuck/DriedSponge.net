<template>
    <span ref="root" :class="{'timestamp':diffForHumans}">{{ts}}</span>
</template>
<script>
import dayjs from "dayjs"
import relativeTime from "dayjs/plugin/relativeTime"
import tippy from "tippy.js";
export default {
    name: "Timestamp",
    props:{
        format:{
            type: String,
            required: false,
            default:"MMMM D, YYYY, h:mm A"
        },
        timestamp:{
            type: String,
            required: true
        },
        diffForHumans:{
            required: false,
            default: false
        }
    },
    computed:{
        ts(){
            if(this.diffForHumans){
                dayjs.extend(relativeTime);
                return dayjs(this.timestamp).fromNow();
            }else{
                return dayjs(this.timestamp).format(this.format);
            }
        }
    },
    mounted() {
        if (this.diffForHumans){
            tippy(this.$refs.root, {
                content: dayjs(this.timestamp).format(this.format),
                theme: "primary",
            });
        }
    }
}
</script>
