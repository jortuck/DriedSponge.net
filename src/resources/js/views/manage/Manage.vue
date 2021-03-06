<template>
    <main v-if="load">
        <Managenav />
        <router-view ></router-view>
    </main>
    <main v-else>
        <Denied />
    </main>
</template>
<script>
import Icon from "../../components/text/Icon";
import Denied from "../errors/Denied";
import Managenav from "./Managenav";
export default {
    name: "Manage",
    components: {Managenav, Denied, Icon},
    data() {
        return {
            session: this.$store.state,
        }
    },
    computed: {
        load() {
            return this.$store.state.authenticated && this.$store.dispatch("can",this.$route.meta.can);
        }
    }
}
</script>
