import axios from 'axios';
import jsCookie from 'js-cookie';

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.headers.common.Authorization = 'Bearer ' + jsCookie.get('jwt_token') ?? '';

export default axios;