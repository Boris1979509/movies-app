import {createStore} from 'vuex'
import movies from "./modules/movies";

const store = createStore({
    state: {
        title: "Кинопоиск API"
    },
    modules: {
        movies
    }
});
store.dispatch('initMoviesStore').then(() => console.log('Init movies'));
export default store;
