<template>
    <main>
        <router-view v-if="load"></router-view>
        <section v-else class="section">
            <div class="level">
                <div class="level-item has-text-centered has-text-white">
                    <Icon class="is-large" icon="fas fa-sync fa-spin fa-4x"/>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
import session from "../../store/session";
import Icon from "../../components/text/Icon";

export default {
    name: "Manage",
    components: {Icon},
    data() {
        return {
            session: session.state
        }
    },
    computed:{
        load(){
            if(this.session.authenticated){
                if(session.can('Manage.See')){
                    return true;
                }else{
                    return false
                }
            }else{
                window.location="/login"
            }
        }
    }
}
</script>
