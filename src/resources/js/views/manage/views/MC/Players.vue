<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <div class="columns is-multiline is-centered">
            <div class="column is-4" v-for="item in state.currentData" :key="item.id">
                <div class="card" data-aos="fade-in">
                    <div class="loading-cover-light" v-if="state.del_loading === item.id" data-aos="fade-in">
                        <Icon class="is-large has-text-grey" icon="fas fa-spinner fa-spin fa-3x"/>
                    </div>
                    <header class="card-header">
                        <p class="card-header-title">
                            {{item.username}}
                        </p>
                        <p class="card-header-icon">
                            <Can permission="Project.Delete">
                                <Icon icon="fas fa-trash" class="has-text-danger" @click="del(item.id)" @vnode-mounted="tooltip($event,'danger','Delete Player')" />
                            </Can>
                        </p>
                    </header>
                    <Cardcontent class="has-text-centered-mobile">
                        <div class="columns is-multiline">
                            <div class="column is-12">
                                <p class="block">
                                    <span class="has-text-weight-bold">UUID:</span><br>
                                    <span>{{ item.uuid }}</span>
                                </p>
                            </div>
                            <div class="column is-12">
                                <p class="block">
                                    <span class="has-text-weight-bold">Date Created:</span><br>
                                    <span><Timestamp :timestamp="item.created_at" :diffForHumans="true"/></span>
                                </p>
                            </div>
                        </div>
                    </Cardcontent>
                    <footer class="card-footer">
                        <router-link :to="{name:'mc-player',params:{'slug':item.username}}" class="card-footer-item">Open Stats</router-link>
                    </footer>
                </div>
            </div>
        </div>
        <nav class="pagination" role="navigation" aria-label="pagination">
            <button @click="fetch(state.page-1)" class="button pagination-previous"
                    :disabled="state.prev_page_url != null ? null : 'disabled'">
                <Icon icon="fas fa-arrow-left"/>
            </button>
            <button @click="fetch(state.page)" class="button pagination-previous">
                <Icon icon="fas fa-sync"/>
            </button>
            <button @click="fetch(state.page+1)" class="button pagination-next"
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
import Can from "../../../../components/helpers/Can";
import Tileancestor from "../../../../components/tiles/Tileancestor";
import Timestamp from "../../../../components/text/Timestamp";
import {POSITION, useToast} from "vue-toastification";
import httpError from "../../../../components/helpers/httpError";
import Cardcontent from "../../../../components/cards/Cardcontent";
import tippy from "tippy.js";
export default {
    name: "Players",
    components: {Cardcontent, Timestamp, Tileancestor, Can, Icon},
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
            axios.get("/app/manage/mc-servers/players", {params: {"page": page}}).then(res => {
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
            axios.delete("/app/manage/mc-servers/players/" + id, {data: {page: this.state.page}})
                .then(res => {
                    this.state.del_loading = null
                    this.state.currentData = res.data.data;
                    this.state.next_page_url = res.data.next_page_url
                    this.state.prev_page_url = res.data.prev_page_url
                    this.state.last_page = res.data.last_page
                    useToast().success("The player has been removed!")
                })
                .catch(error => {
                    this.httpError(error)
                });
        },
        tooltip(e,theme,text) {
            tippy(e.el, {
                content: text,
                theme: theme,
                hideOnClick: false
            });
        }
    }
}
</script>
