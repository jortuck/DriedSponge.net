import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import AOS from 'aos';
import {getCookie} from "./components/helpers/cookies";
// AOS Settings
AOS.init()

// axios settings
axios.defaults.withCredentials = true;

// Snow Storm Settings
require('./snowstorm-min');
window.snowStorm.followMouse = false
window.snowStorm.snowStick = false;



// Vue init
createApp(App).use(router).mount('#app')
