<template>
    <Navbar brand="MAN.AGE" :brandlink="{'name':'manage'}">
        <Navlink permission="Manage.See" :to="{'name':'manage'}">Dashboard</Navlink>
        <Navdropdown :text="cat.name" :permission="cat.perm" v-for="cat in navlinks">
            <Navlink :permission="link.perm" v-for="link in cat.links" :to="link.to">
                <Icon :icon="link.icon" class="has-text-primary"/>
                <span class="ml-1">{{link.name}}</span>
            </Navlink>
        </Navdropdown>
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
import Navlink from "../../components/includes/Navbar/Navlink";

export default {
    name: "Managenav",
    components: {Navlink, Navbar, Managelogin, Can, Icon, Navdropdown, Snowcontroller},
    data() {
        return {
            navbarToggled: false,
            navlinks: [
                {
                    name: "Content", perm: "Manage.Communication", links: [
                        {name: "Projects", perm: "Project.See", icon: "fas fa-project-diagram"},
                        {name: "MC Servers", perm: "Project.See", icon: "fas fa-server",to:{'name':'mc-servers'}},
                        {name: "Files", perm: "File.See", icon: "fas fa-images", to:{"name":"files"}}
                    ]
                },
                {
                    name: "COMMUNICATION", perm: "Manage.Content", links: [
                        {name: "Contact Form Responses", perm: "Contact.See", icon: "fas fa-inbox",to:{'name':'contactform'}},
                        {name: "Alerts", perm: "Alerts.See", icon: "fas fa-comment-alt",to:{'name':'alerts'}}
                    ]
                },
                {
                    name: "Administration", perm: "Manage.Administration", links: [
                        {name: "Roles", perm: "Roles.See", icon: "fas fa-users"},
                        {name: "API Keys", perm: "Api.See", icon: "fas fa-key"}
                    ]
                }
            ]
        }
    },
    methods: {
        toggleNav() {
            this.navbarToggled = !this.navbarToggled;
        }
    }
}
</script>
