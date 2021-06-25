import {createApp} from 'vue';
import App from "./components/App";
import store from "./store";

createApp(App)
    .use(store)
    .mount("#app");
