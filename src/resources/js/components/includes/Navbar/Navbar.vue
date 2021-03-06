<template>
    <nav data-aos="fade-down" class="navbar mb-5" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <router-link class="navbar-item is-size-4-mobile" :to="brandlink">
                    <span class="has-text-primary">{{brand.split(".")[0]}}</span><span class="has-text-white">{{brand.split(".")[1]}}</span>
                </router-link>
                <a @click="toggleNav" role="button" class="navbar-burger burger" :class="{'is-active':navbarToggled}"
                   aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu" :class="{'is-active':navbarToggled}">
                <div class="navbar-end">
                    <slot></slot>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    name: "Navbar",
    props:{
        brand:{
            required: false,
            type: String,
            default: "D.S"
        },
        brandlink:{
            required: false,
            default:{'name':'home'}
        }
    },
    data() {
        return {
            navbarToggled: false
        }
    },
    methods: {
        toggleNav() {
            this.navbarToggled = !this.navbarToggled;
        }
    }
}
</script>
