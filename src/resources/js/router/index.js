import {createRouter, createWebHashHistory} from 'vue-router'
const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../views/Home')
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
