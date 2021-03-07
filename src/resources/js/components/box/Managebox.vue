<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead v-if="header">{{header}}</Managepagehead>
                <slot></slot>
            </div>
        </div>
    </section>
</template>

<script>
import Managepagehead from "../text/Managepagehead";
export default {
    name: "Managebox",
    components: {Managepagehead},
    props:{
        header:{
            required: false,
            type:String
        }
    }
}
</script>
