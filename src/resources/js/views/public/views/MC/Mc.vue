<template>
    <Pagehead>Minecraft</Pagehead>
    <br>
    <div class="section">
        <div class="container">
            <div class="tabs is-toggle is-fullwidth">
                <ul>
                    <li class="is-active">
                        <router-link :to="{'name':'mc'}" exact-active-class="is-active">
                            <span class="mc-text">Servers</span>
                        </router-link>
                    </li>
                    <li>
                        <a>
                            <span class="mc-text">Players</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <router-view></router-view>
    </div>
</template>
<script>
import Pagehead from "../../../../components/includes/Pagehead";

export default {
    name: "Mc",
    components: {Pagehead}
}
</script>
