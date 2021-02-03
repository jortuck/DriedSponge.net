<template>
    <Pagehead>Minecraft</Pagehead>
    <br>
    <div class="section">
        <div class="container">
            <div class="tabs is-toggle is-fullwidth">
                <ul>
                    <router-link custom :to="{'name':'mc'}"  v-slot="{ href,navigate, isActive,isExactActive}">
                        <li :class="{'is-active':isExactActive}">
                            <a :href="href" @click="navigate">
                                <span class="mc-text">Servers</span>
                            </a>
                        </li>
                    </router-link>
                    <router-link custom :to="{'name':'mc-players'}"  v-slot="{ href,navigate, isActive,isExactActive}">
                        <li :class="{'is-active':isExactActive}">
                            <a :href="href" @click="navigate">
                                <span class="mc-text">Players</span>
                            </a>
                        </li>
                    </router-link>
                </ul>
            </div>
        </div>
        <br>
        <router-view></router-view>
    </div>
</template>
<script>
import Pagehead from "../../../../components/includes/Pagehead";
import Icon from "../../../../components/text/Icon";

export default {
    name: "Mc",
    components: {Icon, Pagehead}
}
</script>
