<template>
    <template v-if="messagePool">
        <div
            :class="messagePool.label"
            class="alert alert-dismissible fade show"
            role="alert">
            <strong>{{ messagePool.title }}</strong> {{ messagePool.msg }}
            <button type="button" class="btn-close" aria-label="Закрыть" @click="clearMessage"></button>
        </div>
    </template>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Notify",
        computed: {
            ...mapGetters("notification", ["messagePool"]),
        },
        methods: {
            ...mapActions("notification", ["clearMessagePool"]),
            clearMessage() {
                this.clearMessagePool();
            }
        }
    }
</script>

<style scoped>
    .alert-dismissible {
        right: 1rem;
        position: fixed;
        bottom: 0;
        z-index: 9999
    }
</style>
