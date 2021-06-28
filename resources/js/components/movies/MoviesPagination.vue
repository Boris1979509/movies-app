<template>
    <div class="container">
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"
                        v-for="(link, idx) in pagination.links"
                        :key="idx"
                        @click.prevent="fetchMovies(link.url)"
                        :class="{active: link.active}"
                    >
                        <a class="page-link" :href="link.url">
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
        methods: {
            // import name, action name
            ...mapActions("movies", ["fetchMovies"]),
        },
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
