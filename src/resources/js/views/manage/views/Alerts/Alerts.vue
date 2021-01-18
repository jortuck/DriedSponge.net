<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Alerts
                </Managepagehead>
                <div class="tabs  is-medium">
                    <ul>
                       <router-link custom :to="{'name':'alerts'}"  v-slot="{ href, route, navigate, isActive, isExactActive }">
                           <li :class="{'is-active':isExactActive}">
                                <a :href="href"  @click="navigate">Alerts</a>
                           </li>
                       </router-link>
                        <router-link custom :to="{'name':'alerts-create'}"  v-slot="{ href,navigate, isActive,isExactActive}">
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
export default {
    name: "Alerts",
    components: {Managepagehead},
}
</script>
