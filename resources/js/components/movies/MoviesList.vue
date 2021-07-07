<template>
    <modal-confirmation
        v-if="modalConfirmation"
        @close="modalConfirmation = false"
        @confirmation="handleConfirmation"
        @removeMovie="onRemoveMovie"
    >
        <template v-slot:body>
            <div class="modal-title alert alert-info" v-html="modalConfirmationTitle">
            </div>
        </template>
    </modal-confirmation>
    <modal-movie-details
        v-if="isModalMovieDetails"
        @close="isModalMovieDetails = false"
        :movie="selectedMovie"
    />
    <div class="container movies-list">
        <div class="row">
            <h1 class="text-center">{{ moviesTitle }}</h1>
        </div>
        <div class="row justify-content-start">

            <template v-if="isExists">
                <div class="col-md-3 col-12" v-for="(movie, idx) in movies" :key="idx">
                    <movie-item
                        @mouseover.native="onMouseOver(movie.poster)"
                        :movie="movie"
                        @confirmation="handleConfirmation"
                        @showDetailMovieModal="showDetailMovieModal"
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
    import ModalConfirmation from "../modals/ModalConfirmation";
    import {mapActions, mapGetters} from "vuex";
    import ModalMovieDetails from "../modals/ModalMovieDetails";

    export default {
        name: "MoviesList",
        emits: ["changePoster"],
        data() {
            return {
                modalConfirmation: false,
                modalConfirmationTitle: "",
                isModalMovieDetails: false,
                selectedMovieId: ""
            }
        },
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
            },
            ...mapGetters("movies", ["deleteId", "searchTitle"]),
            moviesTitle() {
                return this.searchTitle ? `Результаты поиска: "${this.searchTitle}"` : this.$store.state.title
            },
            selectedMovie() {
                return this.selectedMovieId ? this.movies.find(movie => movie.id === this.selectedMovieId) : null;
            }
        },
        components: {
            MovieItem,
            ModalConfirmation,
            ModalMovieDetails
        },
        methods: {
            ...mapActions("movies", ["addDeleteId", "removeDeleteId", "removeMovie"]),
            onMouseOver(poster) {
                this.$emit('changePoster', poster);
            },
            handleConfirmation(confirm, data = {}) {
                this.modalConfirmation = confirm;
                if (Object.keys(data).length) {
                    this.modalConfirmationTitle = `Вы действительно хотите удалить фильм <strong>"${data.title}"</strong>?`;
                }
                confirm ? this.addDeleteId(data.id) : this.removeDeleteId();
            },
            onRemoveMovie() {
                this.removeMovie(this.deleteId);
                this.modalConfirmation = false;
            },
            showDetailMovieModal(id) {
                this.isModalMovieDetails = true;
                this.selectedMovieId = id
            }
        }
    }
</script>

<style scoped>
    .movies-list {
        padding: 70px 0 70px 0
    }

    .movies-list h1 {
        color: #fff;
    }
</style>
