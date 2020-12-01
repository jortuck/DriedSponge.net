<template>
    <div ref="captcha" class="captcha"></div>
</template>
<script>
export default {
    name: "Captcha",
    methods: {
        render(){
            console.log(this.$refs.captcha)
            window.grecaptcha.render(this.$refs.captcha, {
                'sitekey' : '6LczSMcZAAAAADwXi4U34KxHyS324gn0T275nLTI'
            });
        }
    },
    mounted() {
        this.render()
    }
}
</script>
<!--6LczSMcZAAAAADwXi4U34KxHyS324gn0T275nLTI-->
