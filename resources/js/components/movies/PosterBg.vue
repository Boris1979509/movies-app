<template>
    <div class="poster-bg" :style="posterStyle"></div>
</template>

<script>
    export default {
        name: "PosterBg",
        props: {
            poster: {
                type: String,
                default: ""
            }
        },
        data() {
            return {
                defaultPosterBg: "linear-gradient(45deg, rgb(0, 3, 38) 0%, rgb(82, 15, 117) 100%)"
            }
        },
        computed: {
            posterStyle() {
                return {
                    backgroundImage: this.posterBg
                }
            },
            posterBg() {
                return this.poster ? `url(${this.poster})` : this.defaultPosterBg
            }
        }
    }
</script>

<style scoped lang="scss">
    @mixin posAbs {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .poster-bg {
        @include posAbs;
        z-index: -1;
        background-size: cover;
        background-position: center;
        transition: all .2s ease;

        &:before {
            content: "";
            @include posAbs;
            opacity: .7;
            background-image: linear-gradient(45deg, rgb(0, 3, 38) 0%, rgb(82, 15, 117) 100%);
        }
    }
</style>
