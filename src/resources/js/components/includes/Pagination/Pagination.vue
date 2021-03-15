<template>
    <nav class="pagination" role="navigation" aria-label="pagination">
        <button class="button pagination-previous"  :class="{'is-loading':loading_page===page-1}" :disabled="page === 1 ? 'disabled' : null" @click="changePage($event, page-1)">
            <Icon icon="fas fa-arrow-left"/>
        </button>
        <button class="button pagination-previous"  :class="{'is-loading':loading_page===page}" @click="changePage($event, page), refresh($event,page)">
            <Icon icon="fas fa-sync"/>
        </button>
        <button class="button pagination-next" :class="{'is-loading':loading_page===page+1}" :disabled="page >= last_page ? 'disabled' :null "  @click="changePage($event, page+1)">
            <Icon icon="fas fa-arrow-right"/>
        </button>
        <ul class="pagination-list">
            <li v-for="index in last_page">
                <button @click="changePage($event, index)" class="button pagination-link" :class="{'is-current':index === page,'is-loading':loading_page===index}" :disabled="page === index ? 'disabled' :null ">{{ index }}</button>
            </li>
        </ul>
    </nav>
</template>
<script>
import Icon from "../../text/Icon";
export default {
    name: "Pagination",
    components: {Icon},
    emits:["pageChange","refresh"],
    props: {
        last_page: {
            required: true
        },
        page:{
            default:1,
        },
        loading_page:{
            default: null
        }
    },
    methods:{
        changePage(e, page){
            this.$emit("pageChange",page)
        },
        refresh(e,page){
            this.$emit("refresh",page)
        }
    }

}
</script>
