import axios from "../../plugins/axios";
import mutations from "../mutations"

function serializeResponse(data) {
    return data.reduce((acc, movie) => acc[movie.id] = movie, {});
}

const {
    SET_MOVIES,
    SET_PAGINATE,
    REMOVE_MOVIE,
    ADD_ID_ON_DELETE,
    REMOVE_ID_ON_DELETE
} = mutations;

export default {
    namespaced: true,
    state: {
        movies: [],
        pagination: {},
        deleteId: ""
    },
    getters: {
        pagination(state) {
            return state.pagination;
        },
        movies(state) {
            return state.movies;
        },
        deleteId(state) {
            return state.deleteId;
        }
    },
    mutations: {
        [SET_MOVIES](state, data) {
            state.movies = data
        },
        [SET_PAGINATE](state, data) {
            state.pagination = data;
        },
        [REMOVE_MOVIE](state, idx) {
            state.movies.splice(idx, 1);
        },
        [ADD_ID_ON_DELETE](state, id) {
            state.deleteId = id;
        },
        [REMOVE_ID_ON_DELETE](state) {
            state.deleteId = "";
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
                    };
                    commit('SET_PAGINATE', paginate);
                })
                .catch(e => {
                    console.log(e);
                }).finally(() => {
                    dispatch("toggleLoader", false, {root: true});
                });
        },
        async removeMovie({commit, state, dispatch}, id) {
            try {
                const response = await axios.delete("api/movies/" + id);
                const index = state.movies.findIndex(item => item.id === id);
                if (index === -1) {
                    throw new Error("Index не найден.");
                }
                alert(response.message);
                commit("REMOVE_MOVIE", index);
                dispatch("fetchMovies");

            } catch (error) {
                console.log(error.message);
            }
        },
        addDeleteId({commit}, id) {
            commit('ADD_ID_ON_DELETE', id);
        },
        removeDeleteId({commit}) {
            commit('REMOVE_ID_ON_DELETE');
        }
    }
}
