<template>
    <Managebox header="Minecraft Servers">
        <Tabs>
            <Tablink :to="{'name':'mc-servers'}">Servers</Tablink>
            <Tablink :to="{'name':'mc-manage-players'}">Players</Tablink>
            <Tablink :to="{'name':'mc-create'}" permission="Project.Create">Add Another Server</Tablink>
        </Tabs>
        <router-view></router-view>
    </Managebox>
</template>
<script>
import Can from "../../../../components/helpers/Can";
import Tablink from "../../../../components/includes/Tabs/Tablink";
import Tabs from "../../../../components/includes/Tabs/Tabs";
import Managebox from "../../../../components/box/Managebox";
export default {
    name: "mc-servers",
    components: {Managebox, Tabs, Tablink, Can},
}
</script>
