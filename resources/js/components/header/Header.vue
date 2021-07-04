<template>
    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">{{ $store.state.title }}</a>
            <form class="d-flex gap-2">
                <input v-model.trim="searchValue" class="form-control" type="search" placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">Искать</button>
            </form>
        </div>
    </nav>
</template>

<script>
    import _ from 'lodash';
    import {mapActions} from "vuex";

    const vm = this;
    export default {
        name: "Header",
        data() {
            return {
                searchValue: ""
            }
        },
        watch: {
            searchValue: "onSearchValueChanged"
        },
        methods: {
            ...mapActions("movies", ["searchMovies"]),
            onSearchValueChanged: _.debounce(function (query) { // delays
                this.searchMovies(query)
            }, 1000)
        }
    }
</script>

<style scoped>

</style>
