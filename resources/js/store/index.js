import {createStore} from 'vuex';
import movies from "./modules/movies";
import loader from "./modules/loader";
import notification from "./modules/notification";

const store = createStore({
    state: {
        title: "Кинопоиск API"
    },
    modules: {
        movies,
        loader,
        notification
    }
});
store.dispatch('initMoviesStore').then(() => console.log('Init movies'));
export default store;
