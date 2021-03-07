<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Minecraft Servers
                </Managepagehead>
                <Tabs>
                    <Tablink :to="{'name':'mc-servers'}">Servers</Tablink>
                    <Tablink :to="{'name':'mc-manage-players'}">Players</Tablink>
                    <Tablink :to="{'name':'mc-create'}" permission="Project.Create">Add Another Server</Tablink>
                </Tabs>
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>
<script>
import Managepagehead from "../../../../components/text/Managepagehead";
import Can from "../../../../components/helpers/Can";
import Tablink from "../../../../components/includes/Tabs/Tablink";
import Tabs from "../../../../components/includes/Tabs/Tabs";
export default {
    name: "mc-servers",
    components: {Tabs, Tablink, Can, Managepagehead},
}
</script>
