/**
 * Пристыковка параметров к запросу
 * @param config
 */
function setParams(config) {
    //console.log(config);
    const params = config.params || {};
    config.params = Object.assign(params, { // merged objects
        token: process.env.MOVIE_APP_TOKEN,
        plot: "all"
    });
    return config;
}

function returnData(response) {
    return response.data;
}

export default function (axios) {
    //axios.interceptors.request.use(setParams);
    axios.interceptors.response.use(returnData);
}
