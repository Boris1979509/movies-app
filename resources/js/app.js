import {createApp} from 'vue';
import 'bootstrap'
import axios from "axios";
import App from "./components/App";
import store from "./store";

createApp(App)
    .use(store, axios)
    .mount("#app");
