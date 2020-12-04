<template>
    <nav data-aos="fade-down" class="navbar mb-5" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://driedsponge.net">
                    <span class="has-text-primary">Man</span><span class="has-text-white">Age</span>
                </a>
                <a @click="toggleNav" role="button" class="navbar-burger burger" :class="{'is-active':navbarToggled}"
                   aria-label="menu" aria-expanded="false">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu" :class="{'is-active':navbarToggled}">
                <div class="navbar-end">
                    <Navdropdown text="CONTENT">
                        <a class="navbar-item"  >
                            <Icon icon="fas fa-snowflake" class="icon has-text-primary" />
                            <span class="ml-1" >Projects</span>
                        </a>
                        <a class="navbar-item"  >
                            <Icon icon="fas fa-snowflake" class="icon has-text-primary" />
                            <span class="ml-1" >Files</span>
                        </a>
                    </Navdropdown>
                    <Navdropdown text="COMMUNICATION">
                        <a class="navbar-item"  >
                            <Icon icon="fas fa-snowflake" class="icon has-text-primary" />
                            <span class="ml-1" >Disable</span>
                        </a>
                    </Navdropdown>
                    <Navdropdown text="Administration">
                        <a class="navbar-item"  >
                            <Icon icon="fas fa-snowflake" class="icon has-text-primary" />
                            <span class="ml-1" >Disable</span>
                        </a>
                    </Navdropdown>
                    <Snowcontroller/>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import Snowcontroller from "../../components/includes/Snowcontroller";
import Navdropdown from "../../components/includes/Navbar/Dropdown";
import Icon from "../../components/text/Icon";
export default {
    name: "Managenav",
    components: {Icon, Navdropdown, Snowcontroller},
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
