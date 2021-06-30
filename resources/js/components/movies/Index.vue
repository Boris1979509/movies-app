<template>
    <poster-bg
        :poster="posterBg"
    />
    <movies-list
        :movies="movies"
        @changePoster="onChangePoster"
    />
    <template v-if="isPaginate">
        <movies-pagination :pagination="pagination"/>
    </template>
</template>

<script>
    import {mapGetters} from 'vuex';
    import PosterBg from "./PosterBg";
    import {defineAsyncComponent} from "vue";

    export default {
        name: "Index",
        data() {
            return {
                posterBg: ""
            }
        },
        computed: {
            // import name, getter name
            ...mapGetters("movies", ["pagination"]),
            ...mapGetters("movies", ["movies"]),
            isPaginate() {
                return this.pagination.total > this.pagination.per_page
            }
        },
        methods: {
            onChangePoster(poster) {
                this.posterBg = poster
            }
        },
        components: {
            // Async load page
            MoviesList: defineAsyncComponent(() =>
                import('./MoviesList')
            ),
            PosterBg,
            MoviesPagination: defineAsyncComponent(() =>
                import('./MoviesPagination')
            ),
        }
    }
</script>
