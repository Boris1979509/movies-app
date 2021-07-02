import axios from "../../plugins/axios";
import mutations from "../mutations"

function serializeResponse(data) {
    return data.reduce((acc, movie) => acc[movie.id] = movie, {});
}

const {SET_MOVIES, SET_PAGINATE} = mutations; // Response data movies

export default {
    namespaced: true,
    state: {
        movies: [],
        pagination: {}
    },
    getters: {
        pagination(state) {
            return state.pagination;
        },
        movies(state) {
            return state.movies;
        }
    },
    mutations: {
        [SET_MOVIES](state, data) {
            state.movies = data
        },
        [SET_PAGINATE](state, data) {
            state.pagination = data;
        }
    },
    actions: {
        // Init movies app
        initMoviesStore: {
            handler(ctx) {
                ctx.dispatch('fetchMovies');
            },
            root: true,
        },
        async fetchMovies({commit, dispatch}, pageUrl) {
            pageUrl = pageUrl || "api/movies";
            dispatch("toggleLoader", true, {root: true});
            await axios.get(pageUrl)
                .then(response => { // serializeResponse(response.data)
                    commit('SET_MOVIES', response.data);
                    const paginate = {
                        current_page: response.current_page,
                        last_page: response.last_page,
                        per_page: response.per_page,
                        prev_page_url: response.prev_page_url,
                        next_page_url: response.next_page_url,
                        links: response.links,
                        total: response.total,
                        path: response.path
                    };
                    commit('SET_PAGINATE', paginate);
                })
                .catch(e => {
                    console.log(e);
                }).finally(() => {
                    dispatch("toggleLoader", false, {root: true});
                });
        }
    }
}
