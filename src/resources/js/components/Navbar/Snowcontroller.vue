<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
            Snow Settings
        </a>
        <div class="navbar-dropdown is-right is-boxed">
            <a class="navbar-item"  @click="toggle">
                    <span class="icon has-text-primary">
                      <i class="fas fa-snowflake"></i>
                    </span>
                <span class="ml-1" v-if="state.toggled">Disable</span>
                <span class="ml-1" v-else>Enable</span>
            </a>
            <a class="navbar-item"  @click="changeSpeed" v-if="state.toggled">
                    <span class="icon has-text-primary">
                      <i class="fas fa-tachometer-alt"></i>
                    </span>
                <span class="ml-1" >Change Speed</span>
            </a>
        </div>
    </div>
</template>

<script>
import {getCookie,setCookie} from "../helpers/cookies";
export default {
    name: "Snowcontroller",
    data() {
        return {
            state:{
                toggled: getCookie('snowstatus') !== "off",
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
    },
    setup(){
        if(getCookie('snowstatus') !== "off"){
            window.snowStorm.toggleSnow()

        }
    }

}
</script>
