import axios from 'axios';

const api = axios.create({
  // link da api
  baseURL: 'http://dev.unicodono.com.br',
});

export default api;
