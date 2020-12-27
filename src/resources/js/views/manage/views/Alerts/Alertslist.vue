<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <table class="table is-fullwidth">
            <div class="loading-cover-dark" v-if="state.loading" data-aos="fade-in">
                <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
            </div>
            <thead>
            <tr>
                <th>Message</th>
                <th>TweetID</th>
                <th>Created</th>
                <th class="has-text-centered">Actions</th>
            </tr>
            </thead>
            <tbody>
<!--            <tr v-for="item in state.currentData" :key="item.id" data-aos="fade-in">-->
<!--                <td>{{ item.Name }}</td>-->
<!--                <td><a :href="'mailto:'+item.Email+'?subject=Re: '+item.Subject" target="_blank">{{ item.Email }}</a></td>-->
<!--                <td>{{ truncate(item.Subject, 30) }}</td>-->
<!--                <td>{{ format(item.created_at) }}</td>-->
<!--                <td class="has-text-centered">-->
<!--                    <button @click="viewMessage(item.id)" class="button is-primary is-small mx-1" :class="{'is-loading':state.modal.loading===item.id}"><Icon icon="fas fa-book-open"/></button>-->
<!--                    <button @click="del(item.id)" class="button is-danger is-small mx-1" :class="{'is-loading':state.del_loading===item.id}"><Icon icon="fas fa-trash"/></button>-->
<!--                </td>-->
<!--            </tr>-->
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
import Icon from "../../../../components/text/Icon";
import session from "../../../../store/session";

export default {
    name: "Alertslist",
    components: {Icon},
    beforeMount() {
        //this.fetch(this.state.page);
    },
    data() {
        return {
            state: {
                loading: false,
                del_loading: null,
                page: 1,
                currentData: 1,
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
            },
        }
    },
    methods: {
        httpError(error){
            this.state.loading = false
            this.state.del_loading = null
            if (error.response) {
                switch (error.response.status) {
                    case 404:
                        console.log("Not found")
                        break
                    case 401:
                        session.login();
                        break
                    case 403:
                        console.log("Unauthorized")

                }
            }
        }
    }
}
</script>
