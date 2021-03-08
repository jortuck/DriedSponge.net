<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div class="table-container" v-else>
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>File Size</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in state.currentData">
                    <td><Icon icon="fas fa-folder" /> {{ item.name }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>{{ item.size }}/A</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import httpError from "../../../../components/helpers/httpError";
import axios from "axios";
import {useToast} from "vue-toastification";
import tippy from "tippy.js";
import Icon from "../../../../components/text/Icon";

export default {
    name: "Filelist",
    components: {Icon},
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
            axios.get("/app/manage/files/folders", {params: {"page": page}}).then(res => {
                this.state.currentData = res.data
                this.state.page = res.data.current_page
                this.state.loading = false
            })
                .catch(error => {
                    this.httpError(error)
                });
        },
        del(id) {
            this.state.del_loading = id
            axios.delete("/app/manage/folders/" + id, {data: {page: this.state.page}})
                .then(res => {
                    this.state.del_loading = null
                    this.state.currentData = res.data;
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
