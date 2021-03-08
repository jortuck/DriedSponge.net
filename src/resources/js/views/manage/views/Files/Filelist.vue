<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <div class="columns is-multiline is-centered">
            <div class="column is-4" v-for="item in state.currentData" :key="item.uuid">
                <div class="card" :style="'background-image: url('+item.url+')'">
                    TEst
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import httpError from "../../../../components/helpers/httpError";
import axios from "axios";
import {useToast} from "vue-toastification";
import tippy from "tippy.js";

export default {
    name: "Filelist",
    data(){
        return{
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
    beforeMount() {
        this.fetch(this.state.page);
    },
    methods: {
        httpError(error) {
            this.state.loading = false
            this.state.del_loading = null
            if (error.response) {
                switch (error.response.status) {
                    case 401:
                        this.$store.commit("login")
                        break
                    default:
                        httpError(error)
                        break;

                }
            }
        },
        fetch(page) {
            this.state.loading = true
            axios.get("/app/manage/files/types", {params: {"page": page}}).then(res => {
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
