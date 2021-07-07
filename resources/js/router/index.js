import {createWebHistory, createRouter} from "vue-router";
import Home from "../views/Home.vue";
import MovieDetails from "../views/MovieDetails";
import {defineAsyncComponent} from "vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/movie/:id/:url',
        name: 'movie',
        component: {
            MovieDetails: defineAsyncComponent(() =>
                import('../views/MovieDetails')
            ),
        }
    },
];
export default createRouter({
    history: createWebHistory(),
    routes,
});
