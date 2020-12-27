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
                    <Can permission="Manage.See">
                        <router-link class="navbar-item" :to="{'name':'manage'}">
                            Dashboard
                        </router-link>
                    </Can>
                    <Can permission="Manage.Content">
                        <Navdropdown text="CONTENT">
                            <Can permission="Project.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-project-diagram" class="has-text-primary"/>
                                    <span class="ml-1">Projects</span>
                                </a>
                            </Can>
                            <Can permission="File.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-images" class="has-text-primary"/>
                                    <span class="ml-1">Files</span>
                                </a>
                            </Can>
                        </Navdropdown>
                    </Can>
                    <Can permission="Manage.Communication">
                        <Navdropdown text="COMMUNICATION">
                            <Can permission="Contact.See">
                                <router-link class="navbar-item" :to="{'name':'contactform'}">
                                    <Icon icon="fas fa-inbox" class="has-text-primary"/>
                                    <span class="ml-1">Contact From Responses</span>
                                </router-link>
                            </Can>
                            <Can permission="Alerts.See">
                                <router-link class="navbar-item" :to="{'name':'alerts'}">
                                    <Icon icon="fas fa-comment-alt" class="has-text-primary"/>
                                    <span class="ml-1">Alerts</span>
                                </router-link>
                            </Can>
                        </Navdropdown>
                    </Can>
                    <Can permission="Manage.Administration">
                        <Navdropdown text="Administration">
                            <Can permission="Roles.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-users" class="has-text-primary"/>
                                    <span class="ml-1">Roles</span>
                                </a>
                            </Can>
                            <Can permission="Api.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-key" class="has-text-primary"/>
                                    <span class="ml-1">Api Keys</span>
                                </a>
                            </Can>
                        </Navdropdown>
                    </Can>
                    <Snowcontroller/>
                    <Managelogin />
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import Snowcontroller from "../../components/includes/Snowcontroller";
import Navdropdown from "../../components/includes/Navbar/Dropdown";
import Icon from "../../components/text/Icon";
import Can from "../../components/helpers/Can";
import Managelogin from "../../components/includes/Navbar/Managelogin";

export default {
    name: "Managenav",
    components: {Managelogin, Can, Icon, Navdropdown, Snowcontroller},
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
