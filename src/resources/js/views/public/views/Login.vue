<template>
    <section class="section">
        <div class="container">
            <div class="columns is-justify-content-center">
                <div class="column is-5-desktop is-12-mobile is-9-tablet">
                    <div class="box">
                        <h2 class="title has-text-centered is-3">Login With...</h2>
                        <br>
                            <a href="/app/login/github" class="button is-large is-fullwidth is-light">
                                <Icon icon="fab fa-github" class="is-left"/>
                                <span>Github</span>
                            </a>
                            <br>
                            <a href="/app/login/discord" class="button is-large is-fullwidth is-light">
                                <Icon icon="fab fa-discord" class="is-left"/>
                                <span>Discord</span>
                            </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import Tileancestor from "../../../components/tiles/Tileancestor";
import Icon from "../../../components/text/Icon";

export default {
    name: "Login",
    components: {Icon, Tileancestor}
}
</script>
