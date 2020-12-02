<template>
    <footer class="py-5 m-3" >
        <div class="container">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <div class="content has-text-white ">
                            <p>&copy; Jordan Tucker 2020</p>
                        </div>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <div class="field has-addons level-item">
                            <p class="control">
                                <a href="https://github.com/driedsponge" target="_blank" class="button is-light is-outlined">
                                    <Icon icon="fab fa-github" class="is-left" />
                                    <span>Source Code</span>
                                </a>
                            </p>
                            <p class="control">
                                <router-link :to="{ name: 'home'}" class="button is-light is-outlined">
                                    <Icon icon="fas fa-envelope" class="is-left" />
                                    <span>Contact</span>
                                </router-link>
                            </p>
                            <p class="control">
                                <Loginbutton />
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </footer>
</template>
<script>
import Icon from "../text/Icon";
import Loginbutton from "./Navbar/Loginbutton";
export default {
    name: "Footer",
    components: {Loginbutton, Icon}
}
</script>
