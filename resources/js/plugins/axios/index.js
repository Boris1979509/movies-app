import axios from 'axios';
import interceptors from "./interceptors";

/**
 * Settings opt Axios
 */
const instance = axios.create({
    baseURL: process.env.APP_URL
});
interceptors(instance);
export default instance;
