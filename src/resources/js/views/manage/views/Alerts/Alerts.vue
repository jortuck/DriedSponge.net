<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Alerts
                </Managepagehead>
                <div class="tabs">
                    <ul>
                       <router-link :to="{'name':'alerts'}"  v-slot="{ href, route, navigate, isActive, isExactActive }">
                           <li :class="{'is-active':isExactActive}">
                                <a :href="href"  @click="navigate">Alerts</a>
                           </li>
                       </router-link>
                        <router-link :to="{'name':'alerts-create'}"  v-slot="{ href,navigate, isActive,isExactActive}">
                            <li :class="{'is-active':isExactActive}">
                                <a :href="href"  @click="navigate">Create New Alert</a>
                            </li>
                        </router-link>
                    </ul>
                </div>
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>
<script>
import Managepagehead from "../../../../components/text/Managepagehead";
import Tileancestor from "../../../../components/tiles/Tileancestor";
import axios from "axios";
export default {
    name: "Alerts",
    components: {Tileancestor, Managepagehead},
}
</script>
