import {createStore} from 'vuex'
import movies from "./modules/movies";
import loader from "./modules/loader"

const store = createStore({
    state: {
        title: "Кинопоиск API"
    },
    modules: {
        movies,
        loader
    }
});
store.dispatch('initMoviesStore').then(() => console.log('Init movies'));
export default store;
