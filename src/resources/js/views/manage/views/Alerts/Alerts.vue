<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Alerts
                </Managepagehead>
                <Tabs>
                    <Tablink :to="{'name':'alerts'}">Alerts</Tablink>
                    <Tablink :to="{'name':'alerts-create'}" permission="Alerts.Create">Create New Alert</Tablink>
                </Tabs>
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>
<script>
import Managepagehead from "../../../../components/text/Managepagehead";
import Can from "../../../../components/helpers/Can";
import Tabs from "../../../../components/includes/Tabs/Tabs";
import Tablink from "../../../../components/includes/Tabs/Tablink";
export default {
    name: "Alerts",
    components: {Tablink, Tabs, Can, Managepagehead},
}
</script>
