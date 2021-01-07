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
                <th>Tweet</th>
                <th>Created</th>
                <th class="has-text-centered">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in state.currentData" :key="item.id" data-aos="fade-in">
                <td>{{ item.message }}</td>
                <td>
                    <a v-if="item.tweetid" target="_blank" :href="'https://twitter.com/driedsponge/status/'+item.tweetid">
                        {{item.tweetid}}
                    </a>
                    <span v-else>N/A</span>
                </td>
                <td>{{ format(item.created_at) }}</td>
                <td>

                </td>
            </tr>
            </tbody>
        </table>
        <nav class="pagination" role="navigation" aria-label="pagination">
            <button @click="fetch(state.page-1)" class="pagination-previous"
                    :disabled="state.prev_page_url != null ? null : 'disabled'">
                <Icon icon="fas fa-arrow-left"/>
            </button>
            <button @click="fetch(state.page)" class="pagination-previous">
                <Icon icon="fas fa-sync"/>
            </button>
            <button @click="fetch(state.page+1)" class="pagination-next"
                    :disabled="state.next_page_url != null ? null : 'disabled'">
                <Icon icon="fas fa-arrow-right"/>
            </button>
            <ul class="pagination-list">
                <li v-for="index in state.last_page">
                    <a class="pagination-link" :class="{'is-current':index === state.page}"
                       @click="fetch(index)">{{ index }}</a>
                </li>
            </ul>
        </nav>
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
        this.fetch(this.state.page);
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
        },
        fetch(page){
            this.state.loading = true
            axios.get("/app/manage/alerts", {params: {"page": page}}).then(res => {
                this.state.currentData = res.data.data
                this.state.page = res.data.current_page
                this.state.next_page_url = res.data.next_page_url
                this.state.prev_page_url = res.data.prev_page_url
                this.state.last_page = res.data.last_page
                this.state.loading = false
            })
                .catch(error => {
                    this.httpError(error)
                });
        },
        format(date) {
            const options = {year: "numeric", month: "long", day: "numeric", hour: "numeric", minute: "numeric"}
            return new Date(date).toLocaleDateString(undefined, options)
        },
        truncate(string, num) {
            if (string.length <= num) {
                return string
            }
            return string.slice(0, num) + '...'
        },
        del(id) {
            this.state.del_loading = id
            axios.delete("/app/manage/alerts/" + id,{data:{page:this.state.page}})
                .then(res => {
                    this.state.del_loading = null
                    this.state.modal.active = false
                    this.state.currentData = res.data.data.data;
                })
                .catch(error => {
                    this.httpError(error)
                });
        },
    }
}
</script>
