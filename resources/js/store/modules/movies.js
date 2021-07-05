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
    REMOVE_ID_ON_DELETE,
    TOGGLE_SEARCH
} = mutations;

export default {
    namespaced: true,
    state: {
        movies: [],
        pagination: {},
        deleteId: "",
        searchTitle: ""
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
        },
        searchTitle(state) {
            return state.searchTitle;
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
        },
        [TOGGLE_SEARCH](state, searchQuery) {
            state.searchTitle = searchQuery;
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
        async fetchMovies({commit, dispatch}, data = {}) {
            const pageUrl = data.pageUrl || "api/movies";
            dispatch("toggleLoader", true, {root: true}); // start preloader
            await axios.get(pageUrl)
                .then(response => { // serializeResponse(response.data)
                    if (response.data.length) {
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
                        if ("searchQuery" in data) {
                            dispatch("toggleSearch", data.searchQuery);
                        }
                    }

                })
                .catch(error => {
                    dispatch("notification/showNotify", { // namespaced
                        msg: error.message,
                        title: "Error.",
                        label: "alert-danger"
                    }, {root: true});
                }).finally(() => {
                    dispatch("toggleLoader", false, {root: true}); // stop preloader
                });
        },
        async removeMovie({commit, state, dispatch}, id) {
            try {
                const response = await axios.delete("api/movies/" + id);
                const index = state.movies.findIndex(item => item.id === id);
                if (index === -1) {
                    throw Error("Index не найден.");
                }
                dispatch("notification/showNotify", { // namespaced
                    msg: response.message,
                    title: "Сообщение об удалении.",
                    label: "alert-success"
                }, {root: true});
                commit("REMOVE_MOVIE", index);
            } catch (error) {
                dispatch("notification/showNotify", { // namespaced
                    msg: error.message,
                    title: "Error.",
                    label: "alert-danger"
                }, {root: true});
            } finally {
                dispatch("fetchMovies");
                dispatch("toggleSearch", "");
            }
        },
        addDeleteId({commit}, id) {
            commit('ADD_ID_ON_DELETE', id);
        },
        removeDeleteId({commit}) {
            commit('REMOVE_ID_ON_DELETE');
        },
        async searchMovies(ctx, searchQuery) {
            ctx.dispatch("fetchMovies", {
                pageUrl: `api/movies?search=${searchQuery}`,
                searchQuery
            });
        },
        toggleSearch(ctx, searchQuery) {
            ctx.commit("TOGGLE_SEARCH", searchQuery);
        }
    }
}
