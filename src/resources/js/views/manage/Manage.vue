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
import session from "../../store/session";
import Icon from "../../components/text/Icon";
import Denied from "../errors/Denied";
import Managenav from "./Managenav";
export default {
    name: "Manage",
    components: {Managenav, Denied, Icon},
    data() {
        return {
            session: session.state,
        }
    },
    computed: {
        load() {
            if (this.session.authenticated) {
                return !!(session.can(this.$route.meta.can) && session.can(this.$route.meta.can));
            } else {
                return false
            }
        }
    }
}
</script>
