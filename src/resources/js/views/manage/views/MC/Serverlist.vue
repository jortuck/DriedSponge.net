<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <div class="columns is-multiline is-centered">
            <div class="column is-4" v-for="item in state.currentData" :key="item.id">
                <div class="box">
                    <p class="title">{{ item.name }} - {{item.id}}</p>
                    <div class="tags has-addons">
                        <span class="tag">{{item.ip}}:{{item.port}}</span>
                        <span class="tag is-danger" v-if="item.private">Private</span>
                        <span class="tag is-success" v-else>Public</span>
                    </div>
                    <div class="buttons are-small">
                         <Can permission="Projects.Edit">
                             <router-link :to="{'name':'mc-edit','params':{'id':item.id}}"  class="is-primary button" ><Icon icon="fas fa-edit"/></router-link>
                         </Can>
                        <Can permission="Projects.Delete" :class="{'is-loading':state.del_loading===item.id}">
                            <button @click="this.del(item.id)" class="is-danger button"><Icon icon="fas fa-trash"/></button>
                        </Can>
                    </div>
                </div>
            </div>
        </div>
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
import Can from "../../../../components/helpers/Can";
import Tileancestor from "../../../../components/tiles/Tileancestor";
import {toast} from "../../../../components/helpers/toasts";
export default {
    name: "Serverlist",
    components: {Tileancestor, Can, Icon},
    beforeMount() {
        this.fetch(this.state.page);
    },
    data() {
        return {
            state: {
                loading: false,
                del_loading: null,
                page: 1,
                currentData: {},
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
            },
        }
    },
    methods: {
        httpError(error) {
            this.state.loading = false
            this.state.del_loading = null
            if (error.response) {
                switch (error.response.status) {
                    case 404:
                        toast("toast-is-danger","Resource not found!")
                        break
                    case 401:
                        session.login();
                        break
                    case 403:
                        toast("toast-is-danger","Unauthorized!")
                        console.log("Unauthorized")

                }
            }
        },
        fetch(page) {
            this.state.loading = true
            axios.get("/app/manage/mc-servers", {params: {"page": page}}).then(res => {
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
            axios.delete("/app/manage/mc-servers/" + id, {data: {page: this.state.page}})
                .then(res => {
                    this.state.del_loading = null
                    this.state.currentData = res.data.data.data;
                    console.log(res.data.data.data);
                    toast("toast-is-success","The server has been removed!")
                })
                .catch(error => {
                    this.httpError(error)
                });
        },
    }
}
</script>
