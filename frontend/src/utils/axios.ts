import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers.common.Authorization = sessionStorage.getItem('jwt_token') ?? '';

export default axios;