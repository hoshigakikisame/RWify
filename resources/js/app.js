// import bootstrap
import "./bootstrap";
// import Jquery
import jQuery from "jquery";

// import function to register Swiper custom elements
import { register } from "swiper/element/bundle";

// inject jQuery
window.$ = jQuery;

// register Swiper custom elements
register();
