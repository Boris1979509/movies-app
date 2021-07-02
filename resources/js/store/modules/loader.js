import mutations from "../mutations"

const {TOGGLE_LOADER} = mutations;

export default {
    state: {
        isShowLoader: false
    },
    mutations: {
        [TOGGLE_LOADER](state, value) {
            state.isShowLoader = value;
        }
    },
    getters: {
        isShowLoader(state) {
            return state.isShowLoader;
        }
    },
    actions: {
        toggleLoader({commit}, value) {
            commit('TOGGLE_LOADER', value);
        }
    }
};
