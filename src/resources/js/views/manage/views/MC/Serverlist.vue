<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <div class="columns is-multiline is-centered">
            <div class="column is-4" v-for="item in state.currentData" :key="item.id">
                <div class="box" :class="item.private ? 'is-danger' : 'is-success'" data-aos="fade-in">
                    <h1 class="title has-text-centered">{{ item.name }} - {{ item.id }}</h1>
                    <p class="block has-text-centered">
                        <span class="has-text-weight-bold">{{ item.ip }}:{{ item.port }}</span>
                        <br>
                        <Timestamp class="is-italic" :diff-for-humans="true" :timestamp="item.created_at"/>
                    </p>
                    <div class="buttons is-centered are-small">
                        <Can permission="Projects.Edit">
                            <router-link :to="{'name':'mc-edit','params':{'id':item.id}}" class="is-primary button">
                                <Icon icon="fas fa-edit"/>
                                <span>Edit</span>
                            </router-link>
                        </Can>
                        <Can permission="Projects.Delete" :class="{'is-loading':state.del_loading===item.id}">
                            <button @click="this.del(item.id)" class="is-danger button">
                                <Icon icon="fas fa-trash"/>
                                <span>Delete</span>
                            </button>
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
import Timestamp from "../../../../components/text/Timestamp";
import {POSITION, useToast} from "vue-toastification";

export default {
    name: "Serverlist",
    components: {Timestamp, Tileancestor, Can, Icon},
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
                        useToast().error("Resource not found!")
                        break
                    case 401:
                        session.login();
                        break
                    case 403:
                        useToast().error("Unauthorized!")
                        break;

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
        del(id) {
            this.state.del_loading = id
            axios.delete("/app/manage/mc-servers/" + id, {data: {page: this.state.page}})
                .then(res => {
                    console.log("teest")
                    this.state.del_loading = null
                    this.state.currentData = res.data.data;
                    this.state.next_page_url = res.data.next_page_url
                    this.state.prev_page_url = res.data.prev_page_url
                    this.state.last_page = res.data.last_page
                    useToast().success("The server has been removed!")
                })
                .catch(error => {
                    this.httpError(error)
                });
        },
    }
}
</script>
