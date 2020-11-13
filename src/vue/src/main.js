import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import '@/sass/app.scss'
import axios from 'axios'
axios.defaults.withCredentials = true;
createApp(App).use(store).use(router).mount('#app')
