<template>
    <div v-if="state.currentData.length === 0" class="has-text-centered">
        <h1 class="title mb-6">No Data Found</h1>
    </div>
    <div style="display: inherit" v-else>
        <table class="table is-fullwidth">
            <div class="loading-cover-dark" v-if="state.loading">
                <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x"/>
            </div>
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date Sent</th>
                <th class="has-text-centered">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in state.currentData" :key="item.id">
                <td>{{ item.Name }}</td>
                <td>{{ item.Email }}</td>
                <td>{{ truncate(item.Subject, 30) }}</td>
                <td>{{ format(item.created_at) }}</td>
                <td class="has-text-centered">
                    <button @click="viewMessage(item.id)" class="button is-primary is-small mx-1" :class="{'is-loading':state.modal.loading===item.id}"><Icon icon="fas fa-book-open"/></button>
                    <button @click="del(item.id)" class="button is-danger is-small mx-1" :class="{'is-loading':state.del_loading===item.id}"><Icon icon="fas fa-trash"/></button>
                </td>
            </tr>
            </tbody>
        </table>
        <nav class="pagination" role="navigation" aria-label="pagination">
            <button @click="fetch(state.page-1)" class="pagination-previous" title="This is the first page"
               :disabled="state.prev_page_url != null ? null : 'disabled'">
                <Icon icon="fas fa-arrow-left"/>
            </button>
            <button @click="fetch(state.page)" class="pagination-previous" title="This is the first page">
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
    <div class="modal" :class="{'is-active':state.modal.active}">
        <div class="modal-background" @click="state.modal.active = false"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Message from {{ state.modal.header }}</p>
                <button class="delete" aria-label="close" @click="state.modal.active = false"></button>
            </header>
            <section class="modal-card-body">
                <strong>{{ state.modal.subject }}</strong>
                <br>
                {{ state.modal.body }}
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" :href="'mailto:'+state.modal.email+'?subject=Re: '+state.modal.subject"
                   target="_blank">
                    Reply
                </a>
                <button class="button is-danger" @click="del(state.modal.messageid)" :class="{'is-loading':state.del_loading===state.modal.messageid}">
                    <Icon icon="fas fa-trash"/>
                </button>
                <button class="button" @click="state.modal.active = false">Close</button>
            </footer>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Icon from "../../../../components/text/Icon";

export default {
    name: "Responselist",
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
                currentData: {},
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
                modal: {
                    active: false,
                    body: "No message loaded",
                    header: "No message loaded",
                    messageid: null,
                    subject: null,
                    email: null,
                    loading: null
                }
            },
        }
    },
    methods: {
        fetch(page) {
            this.state.loading = true
            axios.get("/app/contact-form/get", {params: {"page": page}}).then(res => {
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
        viewMessage(id) {
            this.state.modal.loading = id
            axios.get("/app/contact-form/" + id).then(res => {
                this.state.modal.body = res.data.Message
                this.state.modal.header = res.data.Name
                this.state.modal.messageid = res.data.id
                this.state.modal.subject = res.data.Subject
                this.state.modal.email = res.data.Email
                this.state.modal.active = true
                this.state.modal.loading = null
            })
                .catch(error =>  {
                    this.httpError(error)
                });
        },
        del(id) {
            this.state.del_loading = id
            axios.delete("/app/contact-form/" + id,{data:{page:this.state.page}})
                .then(res => {
                    this.state.del_loading = null
                    this.state.modal.active = false
                    this.state.currentData = res.data.data.data;
                })
                .catch(error => {
                    this.httpError(error)
                });
        },
        httpError(error){
            this.state.loading = false
            this.state.del_loading = null
            if (error.response) {
                switch (error.response.status) {
                    case 404:
                        console.log("Not found")
                        break
                    case 401:
                        console.log("Unauthenticated")
                        break
                    case 403:
                        console.log("Unauthorized")

                }
            }
        }
    }
}
</script>
