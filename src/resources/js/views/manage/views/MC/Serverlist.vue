<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <div class="columns is-multiline is-centered">
            <div class="column is-4" v-for="item in state.currentData" :key="item.id">
                <div class="card" data-aos="fade-in">
                    <header class="card-header">
                        <p class="card-header-title">
                            {{item.name}}
                        </p>
                        <p class="card-header-icon has-text-danger" v-if="item.private">
                          <Icon icon="fas fa-lock"/>
                        </p>
                        <p class="card-header-icon has-text-success" v-else>
                            <Icon icon="fas fa-unlock"/>
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris.
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a href="#" class="card-footer-item">Edit</a>
                        <a href="#" class="card-footer-item">Delete</a>
                    </footer>
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
import httpError from "../../../../components/helpers/httpError";

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
                    case 401:
                        session.login();
                        break
                    default:
                        httpError(error)
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
