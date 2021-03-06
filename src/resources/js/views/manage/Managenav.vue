<template>
    <Navbar brand="MAN.AGE" :brandlink="{'name':'manage'}">
        <Can permission="Manage.See">
            <router-link class="navbar-item" :to="{'name':'manage'}" exact-active-class="is-active">
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
                <Can permission="Project.See">
                    <router-link class="navbar-item" exact-active-class="is-active" :to="{'name':'mc-servers'}">
                        <Icon icon="fas fa-server" class="has-text-primary"/>
                        <span class="ml-1">MC Servers</span>
                    </router-link>
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
                    <router-link class="navbar-item" :to="{'name':'contactform'}" exact-active-class="is-active">
                        <Icon icon="fas fa-inbox" class="has-text-primary"/>
                        <span class="ml-1">Contact From Responses</span>
                    </router-link>
                </Can>
                <Can permission="Alerts.See">
                    <router-link class="navbar-item" :to="{'name':'alerts'}" exact-active-class="is-active">
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
        <Managelogin/>
    </Navbar>
</template>
<script>
import Snowcontroller from "../../components/includes/Navbar/Snowcontroller";
import Navdropdown from "../../components/includes/Navbar/Dropdown";
import Icon from "../../components/text/Icon";
import Can from "../../components/helpers/Can";
import Managelogin from "../../components/includes/Navbar/Managelogin";
import Navbar from "../../components/includes/Navbar/Navbar";

export default {
    name: "Managenav",
    components: {Navbar, Managelogin, Can, Icon, Navdropdown, Snowcontroller},
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
