import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import AOS from 'aos';
AOS.init()
axios.defaults.withCredentials = true;
createApp(App).use(router).mount('#app')
