<template>
    <section class="section">
        <div class="container">
            <div class="box" data-aos="fade-up">
                <Managepagehead>
                    Minecraft Servers
                </Managepagehead>
                <div class="tabs  is-medium">
                    <ul>
                       <router-link custom :to="{'name':'mc-servers'}"  v-slot="{ href, route, navigate, isActive, isExactActive }">
                           <li :class="{'is-active':isExactActive}">
                                <a :href="href"  @click="navigate">Servers</a>
                           </li>
                       </router-link>
                        <router-link custom :to="{'name':'mc-manage-players'}"  v-slot="{ href, route, navigate, isActive, isExactActive }">
                            <li :class="{'is-active':isExactActive}">
                                <a :href="href"  @click="navigate">Players</a>
                            </li>
                        </router-link>
                        <Can permission="Projects.Create">
                            <router-link custom :to="{'name':'mc-create'}"  v-slot="{ href,navigate, isActive,isExactActive}">
                                <li :class="{'is-active':isExactActive}">
                                    <a :href="href"  @click="navigate">Add Another Server</a>
                                </li>
                            </router-link>
                        </Can>
                    </ul>
                </div>
                <router-view></router-view>
            </div>
        </div>
    </section>
</template>
<script>
import Managepagehead from "../../../../components/text/Managepagehead";
import Can from "../../../../components/helpers/Can";
export default {
    name: "mc-servers",
    components: {Can, Managepagehead},
}
</script>
