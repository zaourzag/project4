import 'flowbite';
import { default as axios } from 'axios';

axios.defaults.baseURL = 'http://socks2.test'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true
import './echo.js';