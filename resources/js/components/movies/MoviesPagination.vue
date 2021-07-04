<template>
    <div class="container">
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"
                        v-for="(link, idx) in pagination.links"
                        :key="idx"
                        @click.prevent="paginate(link.url)"
                        :class="{active: link.active}"
                    >
                        <a class="page-link" href="#">
                            {{ link.label }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "MoviesPagination",
        props: {
            pagination: {
                type: Object
            }
        },
        data() {
            return {
                flag: false
            }
        },
        methods: {
            // import name, action name
            ...mapActions("movies", ["fetchMovies"]),
            // onPageQueryChange({page}) {
            //     if (this.flag){
            //         const currentPage = `${this.pagination.path}?page=${page}`;
            //         this.fetchMovies(currentPage);
            //     }
            // },
            paginate(pageUrl) {
                this.fetchMovies({pageUrl});
            }
        },
        watch: {
            // "$route.query": {
            //     handler: "onPageQueryChange",
            //     immediate: true,
            //     deep: true
            // },
            // pagination() {
            //     if (this.flag)
            //         this.$router.push({query: {page: this.pagination.current_page}});
            // }
        }
    }
</script>

<style scoped>
    .pagination .page-item .page-link {
        background-color: transparent;
        font-size: 12px;
        color: #fff;
        box-shadow: none;
    }

    .pagination .page-item.active .page-link {
        border-color: #fff;
        background-color: #fff;
        color: #000;
    }

    .pagination .page-item.disabled .page-link {
        color: lightgray;
    }
</style>
