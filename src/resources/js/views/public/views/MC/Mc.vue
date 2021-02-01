<template>
    <Pagehead>Minecraft</Pagehead>
    <br>
    <div class="section">
        <div class="container">
            <div class="tabs is-toggle is-fullwidth">
                <ul>
                    <li class="is-active">
                        <a class="is-active">
                            <span class="mc-text">Servers</span>
                        </a>
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
