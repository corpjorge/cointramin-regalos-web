import axios from "axios";

const httpClient = axios.create();

httpClient.interceptors.request.use(function (config) {
    const token = sessionStorage.getItem('token');
    config.headers.Authorization =  token;
    return config;
});

export default httpClient
