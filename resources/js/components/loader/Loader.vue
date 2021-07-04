<template>
    <div class="loader-wrap d-flex justify-content-center align-items-center" v-if="isShowLoader">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "Loader",
        computed: {
            ...mapGetters(['isShowLoader'])
        }
    }
</script>

<style scoped>
    .loader-wrap {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9998
    }
</style>
