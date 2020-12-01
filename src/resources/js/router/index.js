import {createRouter, createWebHashHistory} from 'vue-router'
import Home from '../views/Home.vue'
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
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router
