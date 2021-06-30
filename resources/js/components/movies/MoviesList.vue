<template>
    <div class="container">
        <div class="row justify-content-start">
            <template v-if="isExists">
                <div class="col-md-3 col-12" v-for="(movie, idx) in movies" :key="idx">
                    <movie-item
                        @mouseover.native="onMouseOver(movie.poster)"
                        :movie="movie"
                    />
                </div>
            </template>
            <template v-else>
                <div class="alert alert-info">Список пуст.</div>
            </template>
        </div>
    </div>
</template>

<script>
    import MovieItem from "./MovieItem";

    export default {
        name: "MoviesList",
        props: {
            movies: {
                type: Array,
                default() {
                    return [];
                }
            }
        },
        computed: {
            isExists() {
                return Boolean(this.movies.length);
            }
        },
        components: {
            MovieItem
        },
        methods: {
            onMouseOver(poster) {
                this.$emit('changePoster', poster);
            }
        }
    }
</script>

<style scoped>

</style>
