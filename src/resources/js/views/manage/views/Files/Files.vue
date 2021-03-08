<template>
    <Managebox header="Files">
        <Tabs>
            <Tablink :to="{'name':'files'}">All Files</Tablink>
            <Tablink>Upload Files</Tablink>
            <Tablink>Danger Zone</Tablink>
        </Tabs>
        <router-view></router-view>
    </Managebox>
</template>
<script>
import Tabs from "../../../../components/includes/Tabs/Tabs";
import Managebox from "../../../../components/box/Managebox";
import Tablink from "../../../../components/includes/Tabs/Tablink";
export default {
    name: "Files",
    components: {Tablink, Managebox, Tabs}
}
</script>
