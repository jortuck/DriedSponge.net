<template>
    <a @click="login" class="button is-dark is-outlined is-rounded is-inverted">
        Login With Steam
    </a>
</template>

<script>
export default {
    name: "Loginbutton",
    methods: {
        login(){
            window.location = "http://localhost:8000/login"
        }
    }
}
</script>

<style scoped>

</style>
