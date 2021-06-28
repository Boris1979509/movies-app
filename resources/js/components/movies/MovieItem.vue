<template>
    <div class="movie-item mb-3">
        <div class="movie-item__poster" :style="posterBg"></div>
        <div class="movie-item__wrapper">
            <div class="movie-item__info">
                <h3 class="movie-item__info-title">{{ movie.title }}</h3>
                <span class="movie-item__info-year">{{ movie.year }}</span>
            </div>
            <div class="movie-item__controls row no-gutters">
                <div class="col">
                    <button class="btn btn-sm btn-outline-light w-100">Edit</button>
                </div>
                <div class="col">
                    <button class="btn btn-sm btn-outline-danger w-100">Remove</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MovieItem",
        props: {
            movie: {
                type: Object,
                required: true
            }
        },
        computed: {
            posterBg() {
                return {
                    backgroundImage: `url(${this.movie.poster})`
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .movie-item {
        position: relative;
        cursor: pointer;
        border-radius: 5px;
        overflow: hidden;
        transition: all .2s ease;
        height: 400px;

        &__poster {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        &__wrapper {
            padding: 20px 10px;
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
            opacity: 0;
            transition: all .2s ease;
        }

        &:hover {
            box-shadow: 0 5px 30px rgba(0, 0, 0, .7);
            transform: scale(1.02);
        }

        &:hover &__wrapper {
            opacity: 1;
            background: rgba(0, 0, 0, .7);
        }

        &__info {
            &-title {
                font-size: 1.5rem;
                color: #fff;
            }

            &-year {
                font-size: 1rem;
                color: #fff;
            }
        }
    }
</style>
