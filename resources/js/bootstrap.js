import axios from 'axios';
window.axios = axios;

axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


axios.create({
    baseURL: 'http://127.0.0.1:8000/api', // Replace with your API base URL
});

axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token'); // Retrieve token from localStorage or Vuex
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
    );



