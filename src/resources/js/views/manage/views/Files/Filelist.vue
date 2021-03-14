<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div class="table-container" v-else>
        <table class="table is-fullwidth is-hoverable" >
            <div class="loading-cover-dark" v-if="state.loading">
                <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
            </div>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>File Size</th>
                </tr>
            </thead>
            <tbody>
                <tr class="is-clickable" v-for="folder in state.currentData.folders" @dblclick="this.$router.push({'name':'files',params:{'folder':folder.uuid}})">
                    <td><Icon icon="fas fa-folder" /> {{ folder.name }}</td>
                    <td><Timestamp :timestamp="folder.created_at" /></td>
                    <td>-</td>
                </tr>
                <tr class="is-clickable" v-for="file in state.currentData.files">
                    <td><Icon icon="fas fa-file" /> {{ file.name }}</td>
                    <td><Timestamp :timestamp="file.created_at" /></td>
                    <td>-</td>
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
import Timestamp from "../../../../components/text/Timestamp";

export default {
    name: "Filelist",
    components: {Timestamp, Icon},

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
    mounted() {
        this.fetch();
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
        fetch() {
            const url = this.$route.params.folder ? "/app/manage/files/"+this.$route.params.folder :"/app/manage/files/"
            this.state.loading = true
            axios.get(url).then(res => {
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
        },
    },
    created() {
        this.$watch(
            () => this.$route.params,
            (toParams, previousParams) => {
                this.fetch();
            }
        )
    },
}
</script>
