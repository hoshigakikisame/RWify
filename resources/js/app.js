// import bootstrap
import "./bootstrap";
// import Jquery
import jQuery from "jquery";

// import Alpine
import Alpine from 'alpinejs'
 
// import function to register Swiper custom elements
import { register } from "swiper/element/bundle";

// inject jQuery
window.$ = jQuery;

// inject Alpine
window.Alpine = Alpine

//start alpine
Alpine.start()

// register Swiper custom elements
register();
