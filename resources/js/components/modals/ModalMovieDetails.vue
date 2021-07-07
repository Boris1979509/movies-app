<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <div v-html="movie.title" class="modal-title"></div>
                    <button
                        type="button"
                        class="btn-close"
                        @click="$emit('close')"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="movie-poster-wrap mb-3">
                                <div class="movie-poster" :style="posterStyle"></div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="movie-title">
                                <h3 v-html="movie.title"></h3>
                                <small>{{ movie.year + genres }}</small>
                            </div>
                            <div class="movie-rating-imdb">
                                <b>IMDB:</b>
                                <star-rating
                                    v-model:rating="rating"
                                    :increment="0.1"
                                    :max-rating="10"
                                    star-size="20"
                                    read-only="true"
                                    round-start-rating="false"
                                    text-class="rating-text"
                                ></star-rating>
                            </div>
                            <div class="movie-description my-3">
                                <p>{{ movie.description }}</p>
                            </div>
                            <div class="movie-actors">
                                <p><b>Актёры:</b> {{ actors }}</p>
                            </div>
                            <div class="movie-countries">
                                <p><b>Страна:</b> {{ countries }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        @click="$emit('close')"
                        type="button"
                        class="btn btn-secondary"
                    >Отмена
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'

    export default {
        name: "ModalMovieDetails",
        props: {
            movie: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                defaultPosterBg: "linear-gradient(45deg, rgb(0, 3, 38) 0%, rgb(82, 15, 117) 100%)",
                rating: this.movie.rating_imdb,
            }
        },
        computed: {
            posterStyle() {
                return {
                    backgroundImage: this.posterBg
                }
            },
            posterBg() {
                return this.movie ? `url(${this.movie.poster})` : this.defaultPosterBg;
            },
            genres() {
                return this.movie.genres.length ? ", " + this.movie.genres.join(", ") : "";
            },
            actors() {
                return this.movie.actors.length ? this.movie.actors.join(", ") : "";
            },
            countries() {
                return this.movie.countries.length ? this.movie.countries.join(", ") : "";
            }
        },
        components: {
            StarRating
        }
    }
</script>

<style scoped>
    .modal-container {
        max-width: 800px;
    }

    .movie-poster-wrap {
        border-radius: 5px;
        position: relative;
        overflow: hidden;
        transition: all .2s ease;
        padding-bottom: 150%;
    }

    .movie-poster {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-position: center center;
        background-size: cover;
    }
</style>
