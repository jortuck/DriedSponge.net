<template>
    <Managebox header="Alerts">
        <Tabs>
            <Tablink :to="{'name':'alerts'}">Alerts</Tablink>
            <Tablink :to="{'name':'alerts-create'}" permission="Alerts.Create">Create New Alert</Tablink>
        </Tabs>
        <router-view></router-view>
    </Managebox>
</template>
<script>
import Can from "../../../../components/helpers/Can";
import Tabs from "../../../../components/includes/Tabs/Tabs";
import Tablink from "../../../../components/includes/Tabs/Tablink";
import Managebox from "../../../../components/box/Managebox";
export default {
    name: "Alerts",
    components: {Managebox, Tablink, Tabs, Can},
}
</script>
