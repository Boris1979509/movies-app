import mutations from "../mutations";

const {SHOW_NOTIFY, CLEAR_NOTIFY} = mutations;
export default {
    namespaced: true,
    state: {
        messagePool: [],
    },
    getters: {
        messagePool(state) {
            return state.messagePool[state.messagePool.length - 1];
        }
    },
    mutations: {
        [SHOW_NOTIFY](state, msg) {
            state.messagePool.push(msg);
        },
        [CLEAR_NOTIFY](state) {
            state.messagePool = [];
        }
    },
    actions: {
        showNotify({commit}, msg) {
            commit("SHOW_NOTIFY", msg);
        },
        clearMessagePool({commit}) {
            commit("CLEAR_NOTIFY");
        }
    }
}
