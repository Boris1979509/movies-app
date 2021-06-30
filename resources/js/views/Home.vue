<template>
    <div class="container">
        <div class="row">
            <h1 class="title my-4 text-center text-white">{{ $store.state.title }}</h1>
        </div>
    </div>
    <Index/>
</template>

<script>
    import Index from "../components/movies/index";

    export default {
        name: "Home",
        components: {
            Index
        }
    }
</script>

<style scoped>

</style>
