<template>
        <table class="table is-fullwidth">
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
            <a @click="fetch(state.page-1)" class="pagination-previous" title="This is the first page" :disabled="state.prev_page_url != null ? null : 'disabled'">Previous</a>
            <a @click="fetch(state.page+1)" class="pagination-next" :disabled="state.next_page_url != null ? null : 'disabled'">Next page</a>
            <ul class="pagination-list">
                <li v-for="index in state.last_page">
                    <a class="pagination-link" :class="{'is-current':index === state.page}" @click="fetch(index)">{{index}}</a>
                </li>
            </ul>
        </nav>
</template>

<script>
import axios from "axios";

export default {
    name: "Responselist",
    beforeMount() {
        this.fetch(this.state.page);
    },
    data() {
        return {
            state: {
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
            axios.get("/contact-form/get", {params: {"page": page}}).then(res => {
                this.state.currentData = res.data.data
                this.state.page = res.data.current_page
                this.state.next_page_url = res.data.next_page_url
                this.state.prev_page_url = res.data.prev_page_url
                this.state.last_page = res.data.last_page
            })
        }
    }
}
</script>

<style scoped>

</style>
