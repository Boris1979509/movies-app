<template>
    <Modal
        v-if="showModal"
        @close="showModal = false"
        @confirmation="handleConfirmation"
        @removeMovie="onRemoveMovie"
    >
        <template v-slot:body>
            <div class="modal-title alert alert-info" v-html="modalTitle">
            </div>
        </template>
    </Modal>
    <div class="container">
        <div class="row justify-content-start">
            <template v-if="isExists">
                <div class="col-md-3 col-12" v-for="(movie, idx) in movies" :key="idx">
                    <movie-item
                        @mouseover.native="onMouseOver(movie.poster)"
                        :movie="movie"
                        @confirmation="handleConfirmation"
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
    import Modal from "../modal/Modal";
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "MoviesList",
        emits: ["changePoster"],
        data() {
            return {
                showModal: false,
                modalTitle: ""
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
            ...mapGetters("movies", ["deleteId"])
        },
        components: {
            MovieItem,
            Modal
        },
        methods: {
            ...mapActions("movies", ["addDeleteId", "removeDeleteId", "removeMovie"]),
            onMouseOver(poster) {
                this.$emit('changePoster', poster);
            },
            handleConfirmation(confirm, data = {}) {
                this.showModal = confirm;
                if (Object.keys(data).length) {
                    this.modalTitle = `Вы действительно хотите удалить фильм <strong>"${data.title}"</strong>?`;
                }
                confirm ? this.addDeleteId(data.id) : this.removeDeleteId();
            },
            onRemoveMovie() {
                this.removeMovie(this.deleteId);
                this.showModal = false;
            }
        }
    }
</script>

<style scoped>

</style>
