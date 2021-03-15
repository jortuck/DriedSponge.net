<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div class="table-container" v-else>
        <nav class="breadcrumb" aria-label="breadcrumbs" v-if="state.crumbs.length !== 0" data-aos="fade-in">
            <ul>
                <router-link custom :to="crumb.to"  v-slot="{ href,navigate, isActive,isExactActive}" v-for="crumb in state.crumbs">
                    <li :class="{'is-active':isExactActive}">
                        <a :href="href"  @click="navigate">{{crumb.name}}</a>
                    </li>
                </router-link>
            </ul>
        </nav>
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
                <tr class="is-clickable" v-for="folder in state.folders" @dblclick="this.$router.push({'name':'files',params:{'folder':folder.uuid}})">
                    <td><Icon icon="fas fa-folder" /> {{ folder.name }}</td>
                    <td><Timestamp :timestamp="folder.created_at" /></td>
                    <td>-</td>
                </tr>
                <tr class="is-clickable" v-for="file in state.files.data">
                    <td><Icon icon="fas fa-file" /> {{ file.name }}</td>
                    <td><Timestamp :timestamp="file.created_at" /></td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
    <Pagination v-if="state.files.length !== 0" :loading_page="state.loading_files_page" v-on:pageChange="fetch" :page="state.files.current_page" :last_page="state.files.last_page" />
</template>
<script>
import httpError from "../../../../components/helpers/httpError";
import axios from "axios";
import {useToast} from "vue-toastification";
import tippy from "tippy.js";
import Icon from "../../../../components/text/Icon";
import Timestamp from "../../../../components/text/Timestamp";
import Pagination from "../../../../components/includes/Pagination/Pagination";

export default {
    name: "Filelist",
    components: {Pagination, Timestamp, Icon},

    data(){
        return{
            state: {
                loading: false,
                del_loading: null,
                page: 1,
                currentData: {},
                crumbs:[],
                files:{},
                loading_files_page:null,
                folders:{},
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
        fetch(page) {
            const url = this.$route.params.folder ? "/app/manage/files/"+this.$route.params.folder :"/app/manage/files/"
            this.state.loading = !page
            this.state.loading_files_page = page ? page : null
            axios.get(url,{params:{page:page}}).then(res => {
                this.state.files = res.data.files
                this.state.folders = res.data.folders
                this.state.loading = false
                this.state.loading_files_page = null
                this.state.crumbs=[];
                if(res.data.parents[0]){
                    this.calcCrumbs(res.data.parents[0]);
                }
                if(res.data.folder){
                    this.state.crumbs.push({name:res.data.folder.name,to:{name:"files",params:{folder:res.data.folder.uuid}}})
                }
                this.state.crumbs.unshift({name:"root",to:{name:"files"}})
            })
            .catch(error => {
                this.httpError(error)
            });
        },
        calcCrumbs(parent){
            this.state.crumbs.unshift({name:parent.name,to:{'name':'files',params:{"folder":parent.uuid}}})
            if(parent.parents){
                this.calcCrumbs(parent.parents);
            }
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
