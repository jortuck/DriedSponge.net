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
                            Alert {{item.id}}
                        </p>
                        <p class="card-header-icon has-text-grey" v-if="!item.onsite">
                            <Icon @vnode-mounted="tooltip($event, 'grey', 'Hidden From Site')" icon="fas fa-eye"/>
                        </p>
                        <p class="card-header-icon has-text-success" v-else>
                            <Icon @vnode-mounted="tooltip($event, 'success', 'Displayed On Site')" icon="fas fa-eye"/>
                        </p>
                    </header>
                    <Cardcontent class="has-text-centered-mobile">
                        <div class="columns">
                            <div class="column is-6">
                                <p class="block">
                                    <span class="has-text-weight-bold">Last Updated:</span><br>
                                    <span><Timestamp :timestamp="item.updated_at" :diffForHumans="true"/></span>
                                </p>
                            </div>
                            <div class="column is-6">
                                <p class="block">
                                    <span class="has-text-weight-bold">Date Added:</span><br>
                                    <span><Timestamp :timestamp="item.created_at" :diffForHumans="true"/></span>
                                </p>
                            </div>
                        </div>
                    </Cardcontent>
                    <footer class="card-footer">
                        <a v-if="item.tweetid" target="_blank" :href="'https://twitter.com/Dried_Sponge/status/'+item.tweetid" class="card-footer-item">Open Tweet</a>
                        <Can permission="Alerts.Edit">
                            <router-link :to="{'name':'alerts-edit','params':{'id':item.id}}" class="card-footer-item">
                                <span>Edit</span>
                            </router-link>
                        </Can>
                        <Can permission="Alerts.Delete">
                            <a @click="del(item.id)" class="card-footer-item has-text-danger">Delete</a>
                        </Can>
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
import Textarea from "../../../../components/form/Textarea";
import Timestamp from "../../../../components/text/Timestamp";
import {POSITION, useToast} from "vue-toastification";
import httpError from  "../../../../components/helpers/httpError"
import Cardcontent from "../../../../components/cards/Cardcontent";
import tippy from "tippy.js";
export default {
    name: "Alertslist",
    components: {Timestamp, Textarea, Can, Icon,Cardcontent},
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
            httpError(error)
        },
        fetch(page) {
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
        truncate(string, num) {
            if (string.length <= num) {
                return string
            }
            return string.slice(0, num) + '...'
        },
        del(id) {
            this.state.del_loading = id
            axios.delete("/app/manage/alerts/" + id, {data: {page: this.state.page}})
                .then(res => {
                    this.state.del_loading = null
                    this.state.currentData = res.data.data.data;
                    this.state.page = res.data.data.current_page
                    this.state.next_page_url = res.data.data.next_page_url
                    this.state.prev_page_url = res.data.data.prev_page_url
                    this.state.last_page = res.data.data.last_page
                    useToast().success("The alert has been deleted!")
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
