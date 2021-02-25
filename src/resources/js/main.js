import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import AOS from 'aos';
import Toast, {POSITION, TYPE} from "vue-toastification";


// AOS Settings
AOS.init({once:true})

// axios settings
axios.defaults.withCredentials = true;
// Snow Storm Settings
// require('./snowstorm-min');
// window.snowStorm.followMouse = false
// window.snowStorm.snowStick = false;
// snowStorm.vMaxX = 5;
// snowStorm.vMaxY = 5;
// snowStorm.flakesMaxActive = 35;
// Vue init
createApp(App).use(router).use(Toast,{
    timeout: 4000,
    position: POSITION.TOP_RIGHT,
    type: TYPE.INFO
}).mount('#app')
