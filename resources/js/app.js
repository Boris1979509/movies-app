import {createApp} from 'vue';
import 'bootstrap'
import axios from "axios";
import App from "./components/App";
import store from "./store";
import router from "./router";

window.axios = axios;
const app = createApp(App);
app.use(store)
    .use(router);
window.vm = app.mount("#app");
