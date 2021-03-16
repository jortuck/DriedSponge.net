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
            <li v-for="item in paginationRange">
                <button v-if="item !=='...'"
                    @click="changePage($event, item)"
                    class="button pagination-link"
                    :class="{'is-current':item === page,'is-loading':loading_page===item}"
                    :disabled="page ===item ? 'disabled' :null ">{{ item }}</button>
                <span v-else class="pagination-ellipsis">&hellip;</span>
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
        },
        delta: {
            default: 2
        }
    },
    methods:{
        changePage(e, page){
            this.$emit("pageChange",page)
        },
        refresh(e,page){
            this.$emit("refresh",page)
        }
    },
    computed:{
        paginationRange(){
            // Thanks to this person https://gist.github.com/kottenator/9d936eb3e4e3c3e02598
            var current = this.page,
                last = this.last_page,
                delta = this.delta,
                left = current - delta,
                right = current + delta + 1,
                range = [],
                rangeWithDots = [],
                l;

            for (let i = 1; i <= last; i++) {
                if (i == 1 || i == last || i >= left && i < right) {
                    range.push(i);
                }
            }

            for (let i of range) {
                if (l) {
                    if (i - l === 2) {
                        rangeWithDots.push(l + 1);
                    } else if (i - l !== 1) {
                        rangeWithDots.push('...');
                    }
                }
                rangeWithDots.push(i);
                l = i;
            }

            return rangeWithDots;
        },
    }

}
</script>
