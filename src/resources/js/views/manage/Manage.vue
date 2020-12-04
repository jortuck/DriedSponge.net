<template>
    <main v-if="load">
        <
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
export default {
    name: "Manage",
    components: {Denied, Icon},
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
                window.location = "/login"
            }
        }
    }
}
</script>
