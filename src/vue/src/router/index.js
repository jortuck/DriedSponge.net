import {createRouter, createWebHashHistory} from 'vue-router'
import Home from '../views/Home.vue'
import Authenticate from '../views/Authenticate'
const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/projects',
        name: 'projects',
        component: () => import('../views/Projects.vue')
    },
    {
        path: '/auth/callback/steam',
        name: 'authenticate',
        component:Authenticate
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router
