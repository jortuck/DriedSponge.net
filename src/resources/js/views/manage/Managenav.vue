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
                    <Can permission="Manage.Content">
                        <Navdropdown text="CONTENT">
                            <Can permission="Project.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Projects</span>
                                </a>
                            </Can>
                            <Can permission="File.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Files</span>
                                </a>
                            </Can>
                        </Navdropdown>
                    </Can>
                    <Can permission="Manage.Communication">
                        <Navdropdown text="COMMUNICATION">
                            <Can permission="Contact.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Contact From Responses</span>
                                </a>
                            </Can>
                            <Can permission="Alerts.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Alerts</span>
                                </a>
                            </Can>
                        </Navdropdown>
                    </Can>
                    <Can permission="Manage.Administration">
                        <Navdropdown text="Administration">
                            <Can permission="Permissions.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Permissions</span>
                                </a>
                            </Can>
                            <Can permission="Roles.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Roles</span>
                                </a>
                            </Can>
                            <Can permission="Api.See">
                                <a class="navbar-item">
                                    <Icon icon="fas fa-snowflake" class="icon has-text-primary"/>
                                    <span class="ml-1">Api Keys</span>
                                </a>
                            </Can>
                        </Navdropdown>
                    </Can>
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
import Can from "../../components/helpers/Can";

export default {
    name: "Managenav",
    components: {Can, Icon, Navdropdown, Snowcontroller},
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
