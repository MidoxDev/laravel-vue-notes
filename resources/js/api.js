import axios from 'axios';



const api = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

// Attach token to every request
api.interceptors.request.use(
  (config) => {
      const token = localStorage.getItem('token');
      if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
  );

  axios.defaults.withCredentials = true;
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
export default api;
