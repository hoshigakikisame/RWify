// import bootstrap
import './bootstrap';
// import Jquery
import jQuery from 'jquery';

// import Alpine
import Alpine from 'alpinejs';

// import function to register Swiper custom elements
import { register } from 'swiper/element/bundle';

// import loading.js
import * as Loading from './loading';

// import Utils
import * as Request from './utils/request';

// inject jQuery
window.$ = window.jQuery = jQuery;

// inject Alpine
window.Alpine = Alpine;

// inject Loading
window.Loading = Loading;

// Utilities
// inject Request
window.utils = {};
window.utils.Request = Request;


//start alpine
Alpine.start();

// register Swiper custom elements
register();

import.meta.glob(['../assets/**/*', '../assets/elements/*']);