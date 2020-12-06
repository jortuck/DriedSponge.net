<template>
        <table class="table is-fullwidth">
            <div class="loading-cover-dark" v-if="state.loading">
                <Icon class="has-text-white is-large" icon="fas fa-spinner fa-spin fa-3x" />
            </div>
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date Sent</th>
                <th>View Message</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in state.currentData" :key="item.id">
                <td>{{ item.Name }}</td>
                <td>{{ item.Email }}</td>
                <td>{{ item.Subject }}</td>
                <td>{{ item.created_at }}</td>
            </tr>
            </tbody>
        </table>
        <nav class="pagination" role="navigation" aria-label="pagination">
            <a @click="fetch(state.page-1)" class="pagination-previous" title="This is the first page" :disabled="state.prev_page_url != null ? null : 'disabled'">
                <Icon  icon="fas fa-arrow-left" />
            </a>
            <a @click="fetch(state.page+1)" class="pagination-next" :disabled="state.next_page_url != null ? null : 'disabled'">
                <Icon  icon="fas fa-arrow-right" />
            </a>
            <ul class="pagination-list">
                <li v-for="index in state.last_page">
                    <a class="pagination-link" :class="{'is-current':index === state.page}" @click="fetch(index)">{{index}}</a>
                </li>
            </ul>
        </nav>
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
                page: 1,
                currentData: {},
                next_page_url: null,
                prev_page_url: null,
                last_page: null,
            },
        }
    },
    methods: {
        fetch(page) {
            this.state.loading = true
            axios.get("/contact-form/get", {params: {"page": page}}).then(res => {
                this.state.currentData = res.data.data
                this.state.page = res.data.current_page
                this.state.next_page_url = res.data.next_page_url
                this.state.prev_page_url = res.data.prev_page_url
                this.state.last_page = res.data.last_page
                this.state.loading = false
            })
        }
    }
}
</script>

<style scoped>

</style>
