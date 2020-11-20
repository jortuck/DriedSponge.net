<template>
    <nav data-aos="fade-down" class="navbar container is-transparent" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="https://driedsponge.net">
                <span class="has-text-primary">D</span><span class="has-text-white">S</span>
            </a>
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="navbarMain">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarMain" class="navbar-menu">
            <div class="navbar-end">
                <router-link class="navbar-item" :to="{ name: 'home'}">Home</router-link>
                <router-link class="navbar-item" :to="{ name: 'projects'}">Projects</router-link>
                <Snowcontroller />
                <Loginbutton/>
            </div>
        </div>
    </nav>
</template>
<script>
import Loginbutton from "../Loginbutton";
import Snowcontroller from '../Snowcontroller';
export default {
    name: "Nav",
    components:{
        Loginbutton,
        Snowcontroller
    },
}
document.addEventListener('DOMContentLoaded', () => {
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
    if ($navbarBurgers.length > 0) {
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {
                const target = el.dataset.target;
                const $target = document.getElementById(target);
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');
            });
        });
    }
});
</script>

<style scoped>

</style>
