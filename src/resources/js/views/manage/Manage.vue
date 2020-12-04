<template>
    <main>
        <router-view v-if="load"></router-view>
        <Denied v-else />
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
                if (session.can(this.$route.meta.can) && session.can(this.$route.meta.can)){
                    return true;
                } else {
                    return false
                }
            } else {
                window.location = "/login"
            }
        }
    }
}
</script>
