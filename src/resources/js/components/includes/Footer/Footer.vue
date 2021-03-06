<template>
    <footer class="py-5 m-3">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column">
                    <div class="content has-text-white has-text-centered-mobile">
                        <p>&copy; Jordan Tucker 2021</p>
                    </div>
                </div>
                <div class="column has-text-right has-text-centered-mobile">
                    <p class="buttons has-addons  is-inline-block">
                        <Footerlink to="https://github.com/driedsponge">
                            <Icon icon="fab fa-github" class="is-left"/>
                            <span>Source Code</span>
                        </Footerlink>
                        <Footerlink :to="{ name: 'home', hash:'#contact'}">
                            <Icon icon="fas fa-envelope" class="is-left"/>
                            <span>Contact</span>
                        </Footerlink>
                        <Loginbutton/>
                    </p>
                </div>
            </div>

        </div>
    </footer>
</template>
<script>
import Icon from "../../text/Icon";
import Loginbutton from "../Loginbutton";
import Footerlink from "./Footerlink";

export default {
    name: "Footer",
    components: {Footerlink, Loginbutton, Icon}
}
</script>
