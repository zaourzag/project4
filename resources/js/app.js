import 'flowbite';
import { default as axios } from 'axios';

axios.defaults.baseURL = 'https://php.zakariao.nl'
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true
import './echo.js';
