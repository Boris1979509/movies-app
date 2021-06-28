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
    import {mapActions, mapGetters} from 'vuex';
    import MoviesList from "./movies/MoviesList";
    import PosterBg from "./movies/PosterBg";
    import MoviesPagination from "./movies/MoviesPagination";

    export default {
        name: "App",
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
            MoviesList,
            PosterBg,
            MoviesPagination
        }
    }
</script>
