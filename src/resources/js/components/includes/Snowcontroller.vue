<template>
    <div class="navbar-item has-dropdown is-clicked" :class="{'is-active':state.showShowSettings}">
        <a class="navbar-link" @click="toggleDrop">
            Snow Settings
        </a>
        <div class="navbar-dropdown is-right is-boxed">
            <a class="navbar-item"  @click="toggle">
                <Icon icon="fas fa-snowflake" class="icon has-text-primary" />
                <span class="ml-1" v-if="state.toggled">Disable</span>
                <span class="ml-1" v-else>Enable</span>
            </a>
            <a class="navbar-item"  @click="changeSpeed" v-if="state.toggled">
                <Icon icon="fas fa-tachometer-alt" class="icon has-text-primary" />
                <span class="ml-1" >Change Speed</span>
            </a>
        </div>
    </div>
</template>
<script>
import {getCookie,setCookie} from "../helpers/cookies";
import Icon from "../text/Icon";
export default {
    name: "Snowcontroller",
    components: {Icon},
    data() {
        return {
            state:{
                toggled: getCookie('snowstatus') !== "off",
                showShowSettings: false,
            }
        }
    },
    methods: {
        toggle() {
            var toggled = getCookie('snowstatus') !== 'off'
            var thing = toggled ? 'off' : 'on'
            window.snowStorm.toggleSnow()
            this.state.toggled = !toggled;
            setCookie("snowstatus", thing);
        },
        changeSpeed(){
            window.snowStorm.randomizeWind()
        },
        toggleDrop(){
            this.state.showShowSettings = !this.state.showShowSettings;
        }
    },
    setup(){
        if(getCookie('snowstatus') !== "off"){
            window.snowStorm.toggleSnow()

        }
    }

}
</script>
